<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Model\Comments;
use App\Model\Like;
use App\Model\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // 点赞帖子
    public function like()
    {
        $like = Like::firstOrNew(['user_id' => 5, 'post_id' => 1]);
        if (isset($like->id)) {
            return false;
        } else {
            $like->save();
            $res = Post::increment('like_num');
            return $res;
        }
    }

    // 帖子的点赞用户列表
    public function like_list()
    {
        $post_id = 1;
        $post = Post::findOrFail($post_id);
        return $post->likes;
    }

    // 帖子的评论列表
    public function comment_list()
    {
        $post_id = 1;
        $post = Post::findOrFail($post_id);
        return $post->comments;
    }

    public function list()
    {
        $posts = Post::all();
        return $posts;
    }

    public function info($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return $post;
    }

    public function create()
    {
        $info = request()->post();
        $post = new Post();
        $post->title = $info['title'];
        $post->content = $info['content'];
        $post->user_id = $info['user_id'];
        return $post->save();
    }

    public function update(PostRequest $request, $id)
    {
        $info = request()->query();
        $post = Post::findOrFail($id);
        $post->title = $info['title'];
        $post->content = $info['content'];
        $post->user_id = $info['user_id'];
        return $post->save();
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        return $post->delete();
    }

    public static function comment($data)
    {
        $validator = Validator::make($data, [
            'post_id' => 'required|exists:App\Model\Post,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            echo $errors->first();
        } else {
            $comment = new Comments();
            $comment->fill($data);
            if ($comment->save()) {
                echo 'success:' . $data['content'];
            } else {
                echo 'comments fail!';
            }
        }
    }
}
