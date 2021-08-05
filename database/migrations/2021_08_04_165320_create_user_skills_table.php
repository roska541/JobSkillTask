<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')
                  ->index();

            $table->unsignedInteger('skill_id')
                  ->index();

            $table->smallInteger('rating')
                  ->index()
                  ->nullable()
                  ->comment('Scale 1 to 5 for the user to rate their skill');

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
        Schema::dropIfExists('user_skills');
    }
}
