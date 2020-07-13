<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // 评论审核
    public function audit($comment_id, $status)
    {
        $comment = Comment::findOrFail($comment_id);
        if ($comment->status == Comment::STATUS_UNAUDITED && in_array($status, [Comment::STATUS_PASS, Comment::STATUS_FAIL])) {
            $comment->status = $status;
            $comment->save();
        } else {
            return false;
        }
    }
}
