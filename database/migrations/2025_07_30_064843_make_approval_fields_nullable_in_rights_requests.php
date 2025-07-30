<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::table('rights_requests', function (Blueprint $table) {
    //         //
    //     });
    // }
    public function up(): void
{
    Schema::table('rights_requests', function (Blueprint $table) {
        $table->string('hod_signature')->nullable()->change();
        $table->string('hod_name')->nullable()->change();
        $table->string('hod_job_title')->nullable()->change();
        $table->date('hod_date')->nullable()->change();

        $table->string('finance_head_signature')->nullable()->change();
        $table->string('finance_head_name')->nullable()->change();
        $table->string('finance_head_job_title')->nullable()->change();
        $table->date('finance_head_date')->nullable()->change();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rights_requests', function (Blueprint $table) {
            //
        });
    }
};
