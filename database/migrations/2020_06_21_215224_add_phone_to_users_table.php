<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
			
			$table->timestamp('phone_verified_at')->nullable()->after('phone');;
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		
		 if (Schema::hasColumn('users', 'phone'))
        {
         Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone']);
         });
		 }
		 
		 
		 		 if (Schema::hasColumn('users', 'phone_verified_at'))
        {
         Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone_verified_at']);
         });
		 }
		 
    }
}
