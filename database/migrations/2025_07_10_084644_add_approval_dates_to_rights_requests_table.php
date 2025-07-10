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
        Schema::table('rights_requests', function (Blueprint $table) {
        $table->date('section_manager_date')->nullable();
        $table->date('hod_date')->nullable();
        $table->date('finance_head_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rights_requests', function (Blueprint $table) {
        $table->dropColumn('section_manager_date');
        $table->dropColumn('hod_date');
        $table->dropColumn('finance_head_date');
        });
    }
};
