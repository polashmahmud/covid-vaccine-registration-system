<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vaccine_center_id')->constrained()->onDelete('cascade');
            $table->date('scheduled_date')->nullable();
            $table->enum('status', ['not_scheduled', 'scheduled', 'vaccinated'])->default('not_scheduled');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registrations');
    }
};
