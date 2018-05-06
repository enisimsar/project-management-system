<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotCompletedProjectsStoredProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
            CREATE PROCEDURE `not_completed_projects`(IN project_manager_id TEXT)
            BEGIN
                IF (project_manager_id = 'ALL') THEN 
                    SELECT * FROM projects WHERE projects.completed = FALSE;       
                ELSE 
                    SELECT * FROM projects WHERE
                    projects.id IN (
                        SELECT project_manager_project.project_id FROM project_manager_project 
                        WHERE project_manager_project.project_manager_id = CAST(project_manager_id AS UNSIGNED)
                    ) AND projects.completed = FALSE;
                END IF;
            END
        ";

        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP procedure IF EXISTS not_completed_projects");
    }
}
