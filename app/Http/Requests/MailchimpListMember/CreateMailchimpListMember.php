<?php

namespace App\Http\Requests\MailchimpListMember;

use Illuminate\Foundation\Http\FormRequest;

class CreateMailchimpListMember extends FormRequest
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
            'email_address' => 'required|string',
            'email_type' => 'string',
            'status' => 'in:subscribed,unsubscribed,cleaned,pending',
            'merge_fields' => 'array',
            'interests' => 'array',
            'language' => 'string',
            'vip' => 'boolean',
            'location' => 'array',
            'ip_signup' => 'string',
            'timestamp_signup' => 'string',
            'ip_opt' => 'string',
            'timestamp_opt' => 'string',
        ];
    }
}
