<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("slug")->unique();
            $table->string("description")->nullable();
            $table->boolean("enable")->default(false);
            $table->json("permissions")->default("[]");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('role_user', function(Blueprint $table){
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Role::class)->constrained()->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');
    }
};
