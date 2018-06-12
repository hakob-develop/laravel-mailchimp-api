<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailchimpListMember extends Model
{
    protected $fillable = [
        'mailchimp_id',
        'mailchimp_list_id',
        'unique_email_id',
        'stats',
        'email_address',
        'email_type',
        'status',
        'merge_fields',
        'interests',
        'language',
        'vip',
        'location',
        'ip_signup',
        'timestamp_signup',
        'ip_opt',
        'timestamp_opt',
        'member_rating',
        'last_changed',
    ];

    protected $casts = [
        'merge_fields' => 'array',
        'interests' => 'array',
        'location' => 'array',
        'stats' => 'array',
        'vip' => 'boolean',
    ];

    public function members()
    {
        return $this->belongsTo(MailchimpList::class, 'list_id');
    }

    public function getSubscriberHashAttribute(): string
    {
        return md5(strtolower($this->email_address));
    }
}
