<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddProjectTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $trigger = "
            CREATE TRIGGER add_project_to_least_project_pm
            AFTER INSERT
            ON projects
            FOR EACH ROW
            BEGIN
                SELECT project_managers.id
                FROM project_managers
                LEFT JOIN project_manager_project 
                ON project_managers.id = project_manager_project.project_manager_id
                GROUP BY project_managers.id
                ORDER BY COUNT(project_manager_project.project_id) ASC
                LIMIT 1 INTO @pm_id;
                INSERT INTO project_manager_project
                (project_id, project_manager_id)
                VALUES (NEW.id, @pm_id);
            END
        ";

        DB::unprepared($trigger);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER IF EXISTS add_project_to_least_project_pm");
    }
}
