<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MailchimpList;
use App\Http\Requests\MailchimpList\CreateMailchimpList;
use App\Http\Requests\MailchimpList\UpdateMailchimpList;
use App\Libs\Mailchimp\Mailchimp;

class MailchimpListController extends Controller
{
    /**
     * Get all lists
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = MailchimpList::all();
        return response([
            'lists' => $lists,
        ]);
    }

    /**
     * Create a new list
     * @param  CreateMailchimpList $request
     * @param  Mailchimp           $mailchimp
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMailchimpList $request, Mailchimp $mailchimp)
    {
        // Create list on mailchimp
        $data = $mailchimp->createList($request->all());
        // Change id-key to avoid conflict
        $data['mailchimp_id'] = $data['id'];
        unset($data['id']);
        // Save list data to our database
        $list = new MailchimpList($data);
        $list->save();
        return response([
            'list' => $list,
        ], 201);
    }

    /**
     * Get a single list
     * @param  MailchimpList $list
     * @return \Illuminate\Http\Response
     */
    public function show(MailchimpList $list)
    {
        return response([
            'list' => $list,
        ]);
    }

    /**
     * Update existing list
     * @param  MailchimpList       $list
     * @param  UpdateMailchimpList $request
     * @param  Mailchimp           $mailchimp
     * @return \Illuminate\Http\Response
     */
    public function update(MailchimpList $list, UpdateMailchimpList $request, Mailchimp $mailchimp)
    {
        // Update list on mailchimp
        $data = $mailchimp->updateList($list->mailchimp_id, $request->all());
        // Remove id-key to avoid conflict
        unset($data['id']);
        // Save list data to our database
        $list->fill($data);
        $list->save();
        return response([
            'list' => $list->fresh(),
        ], 201);
    }

    /**
     * Delete list
     * @param  MailchimpList $list
     * @param  Mailchimp     $mailchimp
     * @return \Illuminate\Http\Response
     */
    public function destroy(MailchimpList $list, Mailchimp $mailchimp)
    {
        // Delete list from mailchimp
        $mailchimp->deleteList($list->mailchimp_id);
        // Delete list from database
        $list->delete();
        return response(null, 204);
    }
}
