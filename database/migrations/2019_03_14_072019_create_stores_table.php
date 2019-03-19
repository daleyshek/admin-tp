<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<sql
        create table if not exists `stores` (
            `id` int not null auto_increment,
            `manager_user_id` int null comment '店长用户ID',
            `store_name` varchar(255) not null comment '店铺名称',
            `store_branch_name` varchar(255) null comment '分店名称',
            `store_logo` varchar(255) null comment '店铺logo',
            `store_pic` varchar(255) null comment '店铺照片',
            
            `province_id` int null comment '省份ID',
            `city_id` int null comment '城市ID',
            `county_id` int null comment '地区ID',
            `areas` varchar(255) null comment '省市区',
            `address` varchar(255) null comment '详细地址',

            `service_tel` varchar(20) null comment '服务热线',
            `status` tinyint not null default 0 comment '',
            `created_at` timestamp null,
            `updated_at` timestamp null,
            `deleted_at` timestamp null,
            primary key (`id`)
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
        Schema::dropIfExists('stores');
    }
}
