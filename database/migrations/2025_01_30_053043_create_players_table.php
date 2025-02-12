<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("position");
            $table->string("age");
            $table->date("dob");
            $table->string("height");
            $table->string("weight");
            $table->string("nationality");
            $table->string("passport");
            $table->string("highlight")->nullable();
            $table->string("image");
            $table->foreignId("user_id")
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });

        // Schema::table('users', function (Blueprint $table) {
        //     $table->string('role')->default('player'); // 'player' または 'club' など
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
