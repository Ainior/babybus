<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'likes';
    protected $fillable = ['user_id', 'post_id'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function post(){
        return $this->belongsTo('App\Post','post_id','id');
    }

}
