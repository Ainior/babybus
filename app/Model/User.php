<?php

namespace App\Model;

use App\Scopes\CommentStatusAtScope;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'id';

    public function comments()
    {
        return $this->hasMany('App\Model\Comments');// withoutGlobalScope(CommentStatusAtScope::class)->
    }

}
