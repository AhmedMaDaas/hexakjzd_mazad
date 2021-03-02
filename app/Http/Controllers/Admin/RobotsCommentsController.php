<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CommentForRobot;
use App\Models\RobotCommint;

use App\Rules\Timer;

use DB;

class RobotsCommentsController extends Controller
{
    private $columns = ['comment', 'timer'];

    public function comments(){
        $title = trans('admin.robots_comments');
        $robots = User::where('fake', 1)->with(['robotsCommints' => function($query){
            return $query->with('commint');
        }])->get();

        $robotsComments = CommentForRobot::with('robotsCommints')->when(request('s') != null && request('q') != null && in_array(request('s'), $this->columns), function($query){
            return $query->where(request('s'), 'LIKE', '%' . request('q') . '%');
        })->get();

        return view('admin.robots.comments.index', ['title' => $title, 'robots' => $robots, 'robotsComments' => $robotsComments]);
    }

    public function addComment(){
        $this->validate(request(), [
            'comment' => 'required|string',
            'timer' => ['sometimes', 'nullable', new Timer()],
            'users' => 'required|array|min:1',
            'users.*' => 'required|numeric',
        ]);

        $comment = CommentForRobot::create([
            'comment' => request('comment'),
            'timer' => request('timer'),
        ]);

        $this->storeRobotsComment(request('users'), $comment->id);

        if(request()->ajax()){
            return response()->json(['view' => view('admin.robots.comments.ajax.comment_row', ['robotComment' => $comment, 'hidden' => 'hidden'])->render(), 'users' => request('users')]);
        }

        return back();
    }

    public function updateComment(){
        $this->validate(request(), [
            'id' => 'required|numeric',
            'comment' => 'required|string',
            'timer' => ['sometimes', 'nullable', new Timer()],
            'users' => 'required|array',
            'users.*' => 'required|numeric',
        ]);

        $comment = CommentForRobot::find(request('id'));

        if(!isset($comment)) return back();

        $comment->update([
            'comment' => request('comment'),
            'timer' => request('timer'),
        ]);

        $this->deleteRobotsComment($comment->id);
        $this->storeRobotsComment(request('users'), $comment->id);

        if(request()->ajax()){
            return response()->json(['view' => view('admin.robots.comments.ajax.comment_row', ['robotComment' => $comment, 'hidden' => ''])->render(), 'users' => request('users')]);
        }

        return back();
    }

    public function deleteComment(){
        $this->validate(request(), [
            'id' => 'required|numeric',
        ]);

        $comment = CommentForRobot::find(request('id'));
        if(isset($comment)) $comment->delete();

        if(request()->ajax())
            return response()->json(['status' => trans('admin.record_deleted_successfully')]);

        return back();
    }

    private function storeRobotsComment($users, $commentId){
        $data = [];
        foreach ($users as $key => $user) {
            $data[] = [
                'user_id' => $user,
                'comment_for_robot_id' => $commentId,
                'created_at' => date_create(),
                'updated_at' => date_create(),
            ];
        }
        DB::table('robots_commints')->insert($data);
    }

    private function deleteRobotsComment($commentId){
        RobotCommint::where('comment_for_robot_id', $commentId)->delete();
    }
}
