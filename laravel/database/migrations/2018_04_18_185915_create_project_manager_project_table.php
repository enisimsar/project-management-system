<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectManagerProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_manager_project', function (Blueprint $table) {
            $table->integer('project_manager_id')->unsigned()->nullable();
            $table->foreign('project_manager_id')->references('id')
                ->on('project_managers')->onDelete('cascade');
            $table->integer('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')
                ->on('projects')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_manager_project');
    }
}
