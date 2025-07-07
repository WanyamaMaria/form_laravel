<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{

    Schema::create('rights_requests', function (Blueprint $table) {
        $table->id();
        $table->string('staff_name');
        $table->string('department');
        $table->string('section');
        $table->string('job_title');
        $table->boolean('initiate_payments')->default(false);
        $table->boolean('review_payments')->default(false);
        $table->boolean('approve_payments')->default(false);
        $table->enum('urgency', ['high', 'medium', 'low'])->default('low');

        // Approvals
        $table->string('section_manager_name')->nullable();
        $table->string('section_manager_job_title')->nullable();

        $table->string('hod_name')->nullable();
        $table->string('hod_job_title')->nullable();

        $table->string('finance_head_name')->nullable();
        $table->string('finance_head_job_title')->nullable();
        
        $table->string('hod_signature');
        
        $table->string('section_manager_signature');
        
        $table->string('finance_head_signature');


        $table->timestamps();
    });
}




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rights_requests', function(Blueprint $table){
       
    });
}

};
