<?php

namespace App\Model;

use App\Scopes\CommentStatusAtScope;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public const STATUS_UNAUDITED = 0;
    public const STATUS_PASS = 1;
    public const STATUS_FAIL = 2;

    protected $table = 'comments';
    protected $fillable = ['user_id', 'post_id', 'content'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CommentStatusAtScope());
//        static::addGlobalScope('comment_status_at_scope', function (Builder $builder) {
//          return $builder->where('status','=', Comments::STATUS_PASS);
//        });
    }
}
