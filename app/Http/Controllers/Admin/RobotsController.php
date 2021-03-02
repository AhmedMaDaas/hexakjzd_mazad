<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;

use Storage;
use Up;

class RobotsController extends Controller
{
    public function users(){
        $title = trans('admin.robots');
        $robots = User::where('fake', 1)->orderBy('id','desc')->get();

        return view('admin.robots.users.index', ['title' => $title, 'robots' => $robots]);
    }

    public function create(){
        $data = $this->validate(request(), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'fake' => 'sometimes|nullable|numeric|in:1',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);

        $data['photo'] = Up::upload([
            'file' => 'photo',
            'path' => 'users',
            'deleteFile' => '',
        ]);

        $data['fake'] = 1;
        $data['name'] = $data['fname'] . ' ' . $data['lname'];
        unset($data['fname']);
        unset($data['lname']);

        User::create($data);

        session()->flash('success', trans('admin.record_added_successfully'));
        return redirect('admin/robots');
    }

    public function update(){
        $data = $this->validate(request(), [
            'id' => 'required|numeric',
            'photo' => 'sometimes|nullable|image|mimes:jpg,png,gif,jpeg',
            'name' => 'sometimes|nullable|string',
        ]);

        $robot = User::find(request('id'));

        if(request()->hasFile('photo')){
            $data['photo'] = Up::upload([
                'file' => 'photo',
                'path' => 'users',
                'deleteFile' => $robot->photo,
            ]);
        }

        $data = $this->filterData($data);

        $robot->update($data);

        if(request()->ajax()){
            return view('admin.plugins.robot', ['robot' => $robot, 'hidden' => ''])->render();
        }

        session()->flash('success', trans('admin.record_updated_successfully'));
        return redirect('admin/robots');
    }

    public function delete(){
        $this->validate(request(), [
            'id' => 'required|numeric',
        ]);

        $user = User::find(request('id'));

        if(isset($user)) {
            Storage::delete($user->photo);
            $user->delete();
        }

        if(request()->ajax()){
            return response()->json(['data' => trans('admin.deleted')]);
        }

        return back();
    }

    private function filterData($data){
        foreach ($data as $key => $value) {
            if($value == null ) unset($data[$key]);
        }
        return $data;
    }
}
