<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Rules\PhoneNumber;

use App\Models\User;
use App\Models\Live;

use App\Events\ChooseWinner;
use App\Events\ConfirmWinner;

use DB;

class UsersController extends Controller
{
    private $paginateUsers = 5;
    private $columns = ['name', 'email', 'phone', 'location', 'fake', 'attention', 'approval', 'blocked'];

    public function certified(){
        $title = trans('admin.all_certified');

        $usersCertified = User::where([['approval', 1], ['admin_id', null], ['fake', 0]])->orderBy('id', 'desc')->when(request('s') != null && request('q') != null && in_array(request('s'), $this->columns), function($query){
            return $query->where(request('s'), 'LIKE', '%' . request('q') . '%');
        })->paginate($this->paginateUsers);

        $pagesNumber = ceil($usersCertified->total()/$this->paginateUsers);
        $page = request('page') == null ? 1 : request('page');

        return view('admin.users.certified', ['title' => $title, 'users' => $usersCertified, 'pagesNumber' => $pagesNumber, 'page' => $page]);
    }

    public function uncertified(){
        $title = trans('admin.all_uncertified');
        $usersUncertified = User::where([['approval', 0], ['admin_id', null], ['fake', 0]])->orderBy('id', 'desc')->when(request('s') != null && request('q') != null && in_array(request('s'), $this->columns), function($query){
            return $query->where(request('s'), 'LIKE', '%' . request('q') . '%');
        })->paginate($this->paginateUsers);

        $pagesNumber = ceil($usersUncertified->total()/$this->paginateUsers);
        $page = request('page') == null ? 1 : request('page');

        return view('admin.users.uncertified', ['title' => $title, 'users' => $usersUncertified, 'pagesNumber' => $pagesNumber, 'page' => $page]);
    }

    public function shared(){
        $title = trans('admin.users_who_shared');
        $live = Live::where('live_status', 'started')->first();
        $liveId = isset($live)  ? $live->id : 0;
        $usersWhoShared = User::where([['admin_id', null], ['fake', 0]])->orderBy('id', 'desc')->when(request('s') != null && request('q') != null && in_array(request('s'), $this->columns), function($query){
            return $query->where(request('s'), 'LIKE', '%' . request('q') . '%');
        })->whereExists(function ($query) use ($liveId) {
                $query->select(DB::raw(1))
                ->from('lives_shares')
                ->whereRaw('users.id = lives_shares.user_id')
                ->whereRaw('lives_shares.live_id = ' . $liveId);
            })
        ->get();

        $winner = User::where([['admin_id', null], ['fake', 0], ['shared_winner', 1]])->first();

        return view('admin.users.shared', ['title' => $title, 'winner' => $winner, 'users' => $usersWhoShared]);
    }

    public function signed(){
        $title = trans('admin.all_signed');
        $usersSinged = User::where([['fake', 0], ['admin_id', null]])->orderBy('id', 'desc')->when(request('s') != null && request('q') != null && in_array(request('s'), $this->columns), function($query){
            return $query->where(request('s'), 'LIKE', '%' . request('q') . '%');
        })->paginate($this->paginateUsers);

        $pagesNumber = ceil($usersSinged->total()/$this->paginateUsers);
        $page = request('page') == null ? 1 : request('page');

        return view('admin.users.signed', ['title' => $title, 'users' => $usersSinged, 'pagesNumber' => $pagesNumber, 'page' => $page]);
    }

    public function updateLocation(){
        $data = $this->validate(request(), [
            'id' => 'required|numeric',
            'location' => 'required|string',
        ]);

        $user = User::find(request('id'));
        if(isset($user)){
            $user->update(['location' => request('location')]);
        }

        if(request()->ajax()){
            return response()->json(['location' => $user->location]);
        }

        return back();
    }

    public function updatePhone(){
        $data = $this->validate(request(), [
            'id' => 'required|numeric',
            'phone' => ['required', new PhoneNumber()],
        ]);

        $user = User::find(request('id'));
        if(isset($user)){
            $user->update(['phone' => request('phone')]);
        }

        if(request()->ajax()){
            return response()->json(['phone' => $user->phone]);
        }

        return back();
    }

    public function approval(){
        $data = $this->validate(request(), [
            'id' => 'required|numeric',
            'approval' => 'required|numeric|in:0,1',
        ]);

        $user = User::find(request('id'));
        if(isset($user)){
            $user->update(['approval' => request('approval')]);
        }

        if(request()->ajax()){
            return response()->json(['approval' => $user->approval]);
        }

        return back();
    }

    public function blocking(){
        $data = $this->validate(request(), [
            'id' => 'required|numeric',
            'blocked' => 'required|numeric|in:0,1',
        ]);

        $user = User::find(request('id'));
        if(isset($user)){
            $user->update(['blocked' => request('blocked')]);
        }

        if(request()->ajax()){
            return response()->json(['blocked' => $user->blocked]);
        }

        return back();
    }

    public function attention(){
        $data = $this->validate(request(), [
            'id' => 'required|numeric',
            'attention' => 'required|string|in:attention1,attention2',
        ]);

        $user = User::find(request('id'));
        if(isset($user)){
            $attention = request('attention');
            if(request('attention') == $user->attention && request('attention') == 'attention2') $attention = 'attention1';
            elseif(request('attention') == $user->attention && request('attention') == 'attention1') $attention = null;

            $user->update(['attention' => $attention]);
        }

        if(request()->ajax()){
            return view('admin.users.ajax.user_row', ['user' => $user])->render();
        }

        return back();
    }

    public function chooseWinner(){
        $live = Live::where('live_status', 'started')->first();
        $liveId = isset($live)  ? $live->id : 0;
        $winner = User::where([['fake', 0], ['admin_id', null]])->whereExists(function ($query) use ($liveId) {
            $query->select(DB::raw(1))
            ->from('lives_shares')
            ->whereRaw('users.id = lives_shares.user_id')
            ->whereRaw('lives_shares.live_id = ' . $liveId);
        })->inRandomOrder()->first();

        if(isset($winner)){
            event(new ChooseWinner());
        }

        if(request()->ajax()){
            return isset($winner) ? response()->json(['id' => $winner->id ,'name' => $winner->name, 'number' => $winner->phone]) : 
            response()->json(['id' => 0 ,'name' => 'NoN', 'number' => 'NoN']);
        }

        return back();
    }

    public function confirmWinner(){
        $this->validate(request(), [
            'id' => 'required|numeric',
        ]);

        $winner = User::find(request('id'));

        if(!isset($winner)) {
            return null;
        }

        User::where('shared_winner', 1)->update(['shared_winner' => 0]);
        event(new ConfirmWinner($winner->name, $winner->phone));
        $winner->update(['shared_winner' => 1]);

        if(request()->ajax()){
            return response()->json(['name' => $winner->name, 'number' => $winner->phone]);
        }

        return back();
    }

}
