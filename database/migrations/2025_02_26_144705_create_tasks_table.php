
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emp_id')->constrained('employees')->cascadeOnDelete();
            $table->text('title');
            $table->longText('content');
            $table->string('date');
            $table->string('deadline');
            $table->integer('status')->default(0); // 0 for 'Pending', 1 for 'Complete'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
