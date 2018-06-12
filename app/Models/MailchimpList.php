<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MailchimpList;
use App\Models\MailchimpListMember;

class MailchimpList extends Model
{
    protected $fillable = [
        'mailchimp_id',
        'web_id',
        'name',
        'contact',
        'permission_reminder',
        'use_archive_bar',
        'campaign_defaults',
        'notify_on_subscribe',
        'notify_on_unsubscribe',
        'email_type_option',
        'visibility',
        'date_created',
        'subscribe_url_short',
        'subscribe_url_long',
        'beamer_address',
        'double_optin',
    ];

    protected $casts = [
        'contact' => 'array',
        'campaign_defaults' => 'array',
        'email_type_option' => 'boolean',
        'double_optin' => 'boolean',
        'use_archive_bar' => 'boolean',
    ];

    public function members()
    {
        return $this->hasMany(MailchimpListMember::class, 'list_id', 'id');
    }

    public function addMember(array $data): MailchimpListMember
    {
        $member = new MailchimpListMember($data);
        $this->members()->save($member);
        return $member;
    }
}
