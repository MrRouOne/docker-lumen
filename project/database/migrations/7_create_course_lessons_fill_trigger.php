<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION course_lessons_fill()
            RETURNS TRIGGER AS
            $$
                BEGIN
                    INSERT INTO lesson_users (user_id, lesson_id, is_passed)
                    SELECT NEW.user_id, id, false
                    FROM lessons WHERE course_id = NEW.course_id;
                    RETURN NULL;
                END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER course_lessons_fill
            AFTER INSERT on course_users
                FOR EACH ROW EXECUTE FUNCTION course_lessons_fill();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS course_lessons_fill ON course_users");
    }
};
