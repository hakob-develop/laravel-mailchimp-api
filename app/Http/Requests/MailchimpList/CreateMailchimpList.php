<?php

namespace App\Http\Requests\MailchimpList;

use Illuminate\Foundation\Http\FormRequest;

class CreateMailchimpList extends FormRequest
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
            'name' => 'string|required',
            'contact' => 'array|required',
            'contact.company' => 'string|required',
            'contact.address1' => 'string|required',
            'contact.address2' => 'string',
            'contact.city' => 'string|required',
            'contact.state' => 'string|required',
            'contact.zip' => 'string|required',
            'contact.country' => 'string|required',
            'contact.phone' => 'string',
            'permission_reminder' => 'string|required',
            'use_archive_bar' => 'boolean',
            'campaign_defaults' => 'array|required',
            'campaign_defaults.from_name' => 'string|required',
            'campaign_defaults.from_email' => 'string|required',
            'campaign_defaults.subject' => 'string|required',
            'campaign_defaults.language' => 'string|required',
            'notify_on_subscribe' => 'string',
            'notify_on_unsubscribe' => 'string',
            'email_type_option' => 'boolean|required',
            'visibility' => 'in:prv,pub',
        ];
    }
}
