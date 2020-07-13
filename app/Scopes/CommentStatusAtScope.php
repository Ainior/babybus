<?php
namespace App\Scopes;

use App\Model\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CommentStatusAtScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        return $builder->where('status','=', Comment::STATUS_PASS);
    }
}