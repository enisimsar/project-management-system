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
            CREATE TRIGGER remove_free_relations
            BEFORE DELETE
            ON employees
            FOR EACH ROW
            BEGIN
                DELETE FROM employee_task 
                WHERE employee_task.employee_id = OLD.id;
            END;
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
        DB::unprepared("DROP TRIGGER IF EXISTS remove_free_relations");
    }
}
