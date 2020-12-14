<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_calls', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->decimal('duration')->nullable();
            $table->string('agent')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('country_from')->nullable();
            $table->string('country_to')->nullable();
            $table->string('direction')->nullable();
            $table->string('CallSid')->nullable();
            $table->string('status')->nullable();
            $table->integer('call_count')->default(0);
            $table->boolean('followup')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incoming_calls');
    }
}
