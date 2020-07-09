<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //在table 中增加一個slugs的欄位
        Schema::table('posts', function ($table) {
            $table->string('slug')->unique()->after('body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //在table 中刪除slugs的欄位
        Schema::table('posts', function ($table) {
            $table->dropColumn('slug');
        });
    }
}
