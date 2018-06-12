<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MailchimpList;
use App\Models\MailchimpListMember;
use App\Http\Requests\MailchimpListMember\CreateMailchimpListMember;
use App\Http\Requests\MailchimpListMember\UpdateMailchimpListMember;
use App\Libs\Mailchimp\Mailchimp;

class MailchimpListMemberController extends Controller
{
    /**
     * Get all list members
     * @param  int    $listId List id
     * @return \Illuminate\Http\Response
     */
    public function index(int $listId)
    {
        $list = MailchimpList::with('members')->find($listId);
        return response([
            'list' => $list,
        ]);
    }

    /**
     * Add member to list
     * @param  MailchimpList             $list
     * @param  CreateMailchimpListMember $request
     * @param  Mailchimp                 $mailchimp
     * @return \Illuminate\Http\Response
     */
    public function store(MailchimpList $list, CreateMailchimpListMember $request, Mailchimp $mailchimp)
    {
        // Add member to mailchimp
        $data = $mailchimp->createMember($list->mailchimp_id, $request->all());
        // Add member to database
        $data['mailchimp_id'] = $data['id'];
        $data['mailchimp_list_id'] = $data['list_id'];
        unset($data['id']);
        unset($data['list_id']);
        $member = $list->addMember($data);
        return response([
            'member' => $member,
        ], 201);
    }

    /**
     * Get a single list member
     * @param  MailchimpListMember $member
     * @return \Illuminate\Http\Response
     */
    public function show(MailchimpListMember $member)
    {
        return response([
            'member' => $member,
        ]);
    }

    /**
     * Update member
     * @param  MailchimpListMember       $member
     * @param  UpdateMailchimpListMember $request
     * @param  Mailchimp                 $mailchimp
     * @return \Illuminate\Http\Response
     */
    public function update(MailchimpListMember $member, UpdateMailchimpListMember $request, Mailchimp $mailchimp)
    {
        // Add member to mailchimp
        $data = $mailchimp->updateMember(
            $member->mailchimp_list_id, $member->subscriberHash, $request->all()
        );
        // Add member to database
        unset($data['id']);
        unset($data['list_id']);
        $member->fill($data);
        return response([
            'member' => $member->fresh(),
        ]);
    }

    /**
     * Delete member
     * @param  MailchimpListMember $member
     * @param  Mailchimp           $mailchimp
     * @return \Illuminate\Http\Response
     */
    public function destroy(MailchimpListMember $member, Mailchimp $mailchimp)
    {
        $mailchimp->deleteMember(
            $member->mailchimp_list_id, $member->subscriberHash
        );
        $member->delete();
        return response(null, 204);
    }
}
