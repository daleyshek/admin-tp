<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<sql
        create table if not exists `store_members` (
            `id` int not null auto_increment,
            `store_id` int not null,
            `user_id` int not null,
            `status` tinyint not null comment '状态(0待确认,1成员)',
            `role` int not null comment '角色(1店长，2店员，3其他)',
            `created_at` timestamp null,
            `updated_at` timestamp null,
            `deleted_at` timestamp null,
            primary key (`id`),
            foreign key (`user_id`) references `users`(`id`),
            foreign key (`store_id`) references `stores`(`id`)
        )
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
        Schema::dropIfExists('store_members');
    }
}
