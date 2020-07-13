<?php

namespace App\Http\Controllers;

use App\Model\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // 评论审核
    public function audit($comment_id, $status)
    {
        $comment = Comments::findOrFail($comment_id);
        if ($comment->status == Comments::STATUS_UNAUDITED && in_array($status, [Comments::STATUS_PASS, Comments::STATUS_FAIL])) {
            $comment->status = $status;
            $comment->save();
        } else {
            return false;
        }
    }
}
