<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueToPMPTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_manager_project', function (Blueprint $table) {
            $table->unique(["project_id", "project_manager_id"], 'pmp_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_manager_project', function (Blueprint $table) {
            $table->dropColumn('pmp_id');
        });
    }
}
