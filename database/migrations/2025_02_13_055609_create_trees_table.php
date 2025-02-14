<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('trees', function (Blueprint $table) {
            $table->id(); 
            $table->string('common_name', 30)->unique();
            $table->string('family_name', 30)->nullable(false);
            $table->string('species_name', 30)->nullable(false);
            $table->string('location', 30)->nullable(false);
            $table->text('tree_uses')->nullable(false);
            $table->text('distribution')->nullable(false);
            $table->text('other_information')->nullable(false);
            $table->string('tree_image', 200)->nullable(); 
            $table->string('qr_code', 200)->nullable();
            $table->string('slug')->unique()->after('tree_image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trees');
    }
};
