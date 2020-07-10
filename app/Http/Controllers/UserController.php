<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Model\Comments;
use App\Model\Post;
use App\Model\User;
use App\Scopes\CommentStatusAtScope;

class UserController extends BaseController
{
    // 用户的帖子列表
    public function post_list()
    {
        $user_id = 1;
        $posts = Post::with('user')->where('user_id', $user_id)->get();
        return $posts;
    }

    // 用户的评论列表
    public function comment_list()
    {
        $user_id = 1;
        $user = User::findOrFail($user_id);
        return $user->comments;
    }

    public function info($id)
    {
        $user = User::findOrFail($id);
//        return $this->error()->generalErr();
        return $this->response($user);

    }

    public function create()
    {
        $info = request()->post();
        $user = new User();
        $user->name = $info['name'];
        $user->sex = $info['sex'];
        $user->age = $info['age'];
        return $user->save();
    }

    public function update(UserRequest $request, $id)
    {
        $info = request()->query();
        $user = User::findOrFail($id);
        $user->name = $info['name'];
        $user->sex = $info['sex'];
        $user->age = $info['age'];
        return $user->save();
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}
