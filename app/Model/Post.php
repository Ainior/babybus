<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'posts';
    protected $primaryKey = 'id';

    protected static function booted()
    {
        static::deleted(function ($post) {
            // 删除帖子后删除对应的点赞和评论
            $post->likes()->delete();
            $post->comments()->delete();
        });
    }

    public function getCommentNumberAttribute()
    {
        return $this->comments()->count();
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function likes(){
        return $this->hasMany(Like::class, 'post_id', 'id');
    }

    public function like_user_list(){
        return $this->belongsToMany(User::class,'likes','post_id','user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comment')->statusPass();
    }

}
