<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<sql
        create table if not exists `users` (
            `id` int not null auto_increment,
            `name` varchar(255) null comment '用户名',
            `mobile` char(11) null comment '手机号',
            `password` varchar(255) null,
            `avatar` varchar(255) comment '用户头像',
            `gender` tinyint not null default 0 comment '性别(1男，2女)', 
            `email` varchar(255) null comment '邮箱',
            `remember_token` varchar(255),
            `status` tinyint not null default 0 comment '状态(0未激活，1已激活，-1已禁用，-9已删除)',
            `created_at` timestamp null,
            `updated_at` timestamp null,
            `deleted_at` timestamp null,
            primary key (`id`),
            unique key (`mobile`),
            unique key (`email`),
            unique key (`remember_token`)
        ) auto_increment=1000;
sql;
        \Illuminate\Support\Facades\DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
