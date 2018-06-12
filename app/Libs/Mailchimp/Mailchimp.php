<?php

namespace App\Libs\Mailchimp;
use App\Models\MailchimpList;
use GuzzleHttp\Psr7;

/**
 * Custom class to work with Mailchimp v3.0 API
 */
class Mailchimp
{
    protected $apiKey;
    protected $client;

    public function __construct($apiKey)
    {
        $region = explode('-', $apiKey)[1];
        $this->apiKey = $apiKey;
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'https://' . $region . '.api.mailchimp.com/3.0/',
            'timeout' => 30000,
            'auth' => ['username', $apiKey],
        ]);
    }

    /**
     * Handle GuzzleHttp Exceptions
     * @param  Exception $e
     */
    public function handleException(\Exception $e)
    {
        if ($e->hasResponse()) {
            $res = json_decode($e->getResponse()->getBody(), true);
            throw new MailchimpHttpException($res['status'], $res['detail'], $res['errors'] ?? []);
        }
    }

    /**
     * Make a request to Mailchimp API
     * @param  string $method
     * @param  string $path
     * @param  array  $data
     * @return mixed
     */
    public function request(string $method, string $path, array $data = [])
    {
        try {
            if (count($data)) {
                $data = [
                    'json' => $data,
                ];
            }
            $response = $this->client->{$method}($path, $data);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Get all lists from Mailchimp
     * @return array Lists array
     */
    public function getLists(): array
    {
        return $this->request('get', 'lists');
    }

    /**
     * Create new list
     * @param  array  $data
     * @return array  New list data
     */
    public function createList(array $data): array
    {
        return $this->request('post', 'lists', $data);
    }

    /**
     * Update list
     * @param  string $id   Updating list id in mailchimp
     * @param  array  $data
     * @return array        Updated list data
     */
    public function updateList(string $id, array $data): array
    {
        return $this->request('patch', 'lists/' . $id, $data);
    }

    /**
     * Delete list
     * @param  string $id Deleteing list id in mailchimp
     */
    public function deleteList(string $id)
    {
        return $this->request('delete', 'lists/' . $id);
    }

    /**
     * Add new member to list
     * @param  string $listId List id mailchimp id
     * @param  array  $data
     * @return array          New member data
     */
    public function createMember(string $listId, array $data): array
    {
        return $this->request('post', 'lists/' . $listId . '/members', $data);
    }

    /**
     * Update member
     * @param  string $listId     Member mailchimp list id
     * @param  string $memberHash Member subscriber hash
     * @param  array  $data
     * @return array              New member data
     */
    public function updateMember(string $listId, string $memberHash, array $data): array
    {
        return $this->request('patch', 'lists/' . $listId . '/members/'. $memberHash, $data);
    }

    /**
     * [deleteMember description]
     * @param  string $listId     Member mailchimp list id
     * @param  string $memberHash Member subscriber hash
     */
    public function deleteMember(string $listId, string $memberHash)
    {
        return $this->request('delete', 'lists/' . $listId . '/members/'. $memberHash);
    }
}
