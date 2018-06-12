<?php

namespace App\Http\Requests\MailchimpList;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMailchimpList extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'contact' => 'array',
            'contact.company' => 'string',
            'contact.address1' => 'string',
            'contact.address2' => 'string',
            'contact.city' => 'string',
            'contact.state' => 'string',
            'contact.zip' => 'string',
            'contact.country' => 'string',
            'contact.phone' => 'string',
            'permission_reminder' => 'string',
            'use_archive_bar' => 'boolean',
            'campaign_defaults' => 'array',
            'campaign_defaults.from_name' => 'string',
            'campaign_defaults.from_email' => 'string',
            'campaign_defaults.subject' => 'string',
            'campaign_defaults.language' => 'string',
            'notify_on_subscribe' => 'string',
            'notify_on_unsubscribe' => 'string',
            'email_type_option' => 'boolean',
            'visibility' => 'in:prv,pub',
        ];
    }
}
