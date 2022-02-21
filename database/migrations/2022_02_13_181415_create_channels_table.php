<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique()->comment('A unique identifier to properly identify the channel');
            $table->string('title')->default('Unnamed Channel');
            $table->string('description')->default('');
            $table->string("opc")->default("opc.tcp://127.0.0.1:12345/MilebitsSimulator/SFP-OPC-UA");
            $table->integer("clock")->default(1);
            $table->boolean('active')->default(true)->comment('Is this channel activated for collection');
            $table->float('3d_x')->default(0)->comment('X coordinates of the object in the 3D map');
            $table->float('3d_y')->default(0)->comment('Y coordinates of the object in the 3D map');
            $table->float('3d_z')->default(0)->comment('Z coordinates of the object in the 3D map');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('channels');
    }
};
