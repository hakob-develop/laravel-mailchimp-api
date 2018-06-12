<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailchimpListMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailchimp_list_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('list_id');
            $table->string('mailchimp_id');
            $table->string('mailchimp_list_id');
            $table->string('unique_email_id');
            $table->string('stats');
            $table->integer('member_rating');
            $table->string('last_changed');
            $table->string('email_address');
            $table->string('email_type');
            $table->enum('status', [
                'subscribed', 'unsubscribed', 'cleaned', 'pending',
            ]);
            $table->string('merge_fields')->default('');
            $table->string('interests')->default('');
            $table->string('language')->default('');
            $table->boolean('vip')->default(false);
            $table->string('location')->default('');
            $table->string('ip_signup')->default('');
            $table->string('timestamp_signup')->default('');
            $table->string('ip_opt')->default('');
            $table->string('timestamp_opt')->default('');
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
        Schema::dropIfExists('mailchimp_list_members');
    }
}
