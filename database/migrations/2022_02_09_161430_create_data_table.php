<?php

use App\Models\Variable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Variable::class)->constrained()->cascadeOnDelete();
            $table->boolean("value")->nullable();
            $table->timestamp("collected_at");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data');
    }
};
