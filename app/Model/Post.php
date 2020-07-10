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

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function likes(){
        return $this->belongsToMany(User::class,'likes','post_id','user_id');
    }

}
