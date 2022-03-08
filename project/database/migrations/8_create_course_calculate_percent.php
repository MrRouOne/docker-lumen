<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
       CREATE OR REPLACE FUNCTION course_calculate_percent()
        RETURNS TRIGGER AS
        $$
            DECLARE
            course integer;
            all_lessons integer;
            completed_lessons integer;

            BEGIN
               course = (SELECT course_id FROM lessons WHERE id = NEW.lesson_id);
               all_lessons = (SELECT COUNT(id) FROM lessons WHERE course_id = course);
               completed_lessons = (SELECT COUNT(id) FROM lesson_users WHERE lesson_id in
               (SELECT id FROM lessons WHERE course_id = course) and user_id = NEW.user_id and is_passed = true);

               UPDATE course_users SET percentage_passing = (SELECT CEILING(100*completed_lessons/all_lessons))
               WHERE user_id = NEW.user_id and course_id = course;
               RETURN NULL;
            END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER course_calculate_percent
        AFTER UPDATE on lesson_users
            FOR EACH ROW EXECUTE FUNCTION course_calculate_percent();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS course_calculate_percent ON lesson_users");
    }
};
