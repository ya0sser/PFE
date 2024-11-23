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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->nullable();
            }
            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email')->unique(); 
            }
            if (!Schema::hasColumn('users', 'password')) {
                $table->string('password');
            }
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('users', 'email')) {
                $table->dropUnique(['email']);
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('users', 'password')) {
                $table->dropColumn('password');
            }
        });
    }
    
};
