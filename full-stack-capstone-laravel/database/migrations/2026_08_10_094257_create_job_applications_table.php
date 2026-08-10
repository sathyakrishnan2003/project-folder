<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_id')
                ->constrained('jobs')
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->text('cover_letter')->nullable();
            $table->string('status')->default('Applied');

            $table->timestamps();

            $table->unique(['job_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
};