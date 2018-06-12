<?php

namespace App\Http\Requests\MailchimpListMember;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMailchimpListMember extends FormRequest
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
            'email_address' => 'string',
            'email_type' => 'string',
            'status' => 'in:subscribed,unsubscribed,cleaned,pending',
            'merge_fields' => 'string',
            'interests' => 'string',
            'language' => 'string',
            'vip' => 'boolean',
            'location' => 'string',
            'ip_signup' => 'string',
            'timestamp_signup' => 'string',
            'ip_opt' => 'string',
            'timestamp_opt' => 'string',
        ];
    }
}
