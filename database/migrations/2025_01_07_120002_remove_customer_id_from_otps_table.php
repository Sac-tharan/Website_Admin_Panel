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
        Schema::table('otps', function (Blueprint $table) {
            $table->dropForeign(['customer_id']); // Drop foreign key
            $table->dropColumn('customer_id'); // Drop the column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('otps', function (Blueprint $table) {
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); // Re-add the column and foreign key
        });
    }
};
