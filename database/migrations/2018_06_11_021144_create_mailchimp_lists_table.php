<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailchimpListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailchimp_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mailchimp_id');
            $table->integer('web_id');
            $table->string('name');
            $table->string('contact');
            $table->string('permission_reminder');
            $table->boolean('use_archive_bar')->default(false);
            $table->string('campaign_defaults');
            $table->string('notify_on_subscribe')->default('');
            $table->string('notify_on_unsubscribe')->default('');
            $table->boolean('email_type_option');
            $table->string('date_created');
            $table->string('subscribe_url_short');
            $table->string('subscribe_url_long');
            $table->string('beamer_address');
            $table->boolean('double_optin');
            $table->enum('visibility', ['pub', 'prv'])->default('pub');
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
        Schema::dropIfExists('mailchimp_lists');
    }
}
