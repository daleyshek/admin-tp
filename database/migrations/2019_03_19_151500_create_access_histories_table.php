<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<mark
    CREATE TABLE IF NOT EXISTS `access_histories` (
      `id` INT NOT NULL AUTO_INCREMENT,
      `platform` tinyint not null comment '1 App,2 后台系统',
      `user_id` INT NOT NULL,
      `target` VARCHAR(20) NOT NULL,
      `target_id` INT NULL,
      `payload` VARCHAR(255) NULL,
      `created_at` TIMESTAMP NULL,
      `updated_at` TIMESTAMP NULL,
      `deleted_at` TIMESTAMP NULL,
      PRIMARY KEY (`id`),
      KEY(`user_id`,`target`),
      KEY(`target`,`target_id`)
    )
mark;
        \Illuminate\Support\Facades\DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_histories');
    }
}
