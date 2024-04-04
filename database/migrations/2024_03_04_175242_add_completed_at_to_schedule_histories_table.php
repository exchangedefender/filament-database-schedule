<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\Config;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table((Config::get('filament-database-schedule.table.schedule_histories', 'schedule_histories')), function (Blueprint $table) {
            $table->timestamp('completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Config::get('filament-database-schedule.table.schedule_histories', 'schedule_histories'), function (Blueprint $table) {
            $table->dropColumn('completed_at');
        });
    }
};
