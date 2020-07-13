<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';
    protected $primaryKey = 'id';

    /**
     * 当前部门所有评论
     */
    public function comments()
    {
        return $this->hasManyThrough(
            'App\Model\Comments',
            'App\Model\User',
            'dept_id', // 部门表外键...
            'user_id', // 用户表外键...
            'id', // 部门表本地键...
            'id' // 用户表本地键...
        );
    }
}
