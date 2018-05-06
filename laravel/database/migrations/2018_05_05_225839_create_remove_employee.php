<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemoveEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $trigger = "
            CREATE TRIGGER remove_free_employee
            AFTER DELETE
            ON employee_task
            FOR EACH ROW
            BEGIN
                DELETE FROM employees 
                WHERE employees.id = OLD.employee_id AND NOT EXISTS (
                    SELECT * 
                    FROM employee_task
                    WHERE employee_task.employee_id = OLD.employee_id
                );
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
        DB::unprepared("DROP TRIGGER IF EXISTS remove_free_employee");
    }
}
