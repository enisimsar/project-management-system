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
                    SELECT * 
                    FROM projects 
                    LEFT JOIN (SELECT project_id, MAX(DATE_ADD(tasks.started_at, INTERVAL tasks.duration DAY)) as ended_at
                        FROM tasks
                        GROUP BY project_id) as agg_project 
                    ON projects.id = agg_project.project_id
                    WHERE agg_project.ended_at >= CURDATE() OR agg_project.ended_at IS NULL;       
                ELSE 
                    SELECT * 
                    FROM projects 
                    LEFT JOIN (SELECT project_id, MAX(DATE_ADD(tasks.started_at, INTERVAL tasks.duration DAY)) as ended_at
                        FROM tasks
                        GROUP BY project_id) as agg_project 
                    ON projects.id = agg_project.project_id
                    WHERE (agg_project.ended_at >= CURDATE() 
                    OR agg_project.ended_at IS NULL) 
                    AND projects.id IN (
                        SELECT project_manager_project.project_id FROM project_manager_project 
                        WHERE project_manager_project.project_manager_id = CAST(project_manager_id AS UNSIGNED)
                    );
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
