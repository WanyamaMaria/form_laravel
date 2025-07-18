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
    if (!Schema::hasColumn('rights_requests', 'section_manager_date')) {
        Schema::table('rights_requests', function (Blueprint $table) {
            $table->date('section_manager_date')->nullable();
        });
    }
}


public function down(): void
{
    Schema::table('rights_requests', function (Blueprint $table) {
        $table->dropColumn('section_manager_date');
    });
}

};
