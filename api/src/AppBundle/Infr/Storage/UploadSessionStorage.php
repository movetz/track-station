<?php

namespace AppBundle\Infr\Storage;

use Predis\Client;

/**
 * Class UploadSessionStorage
 * @package AppBundle\Infr\Storage
 */
class UploadSessionStorage
{
    /**
     * @var
     */
    private $client;

    private const PREFIX = 'up_session:';

    /**
     * UploadSessionStorage constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function save(UploadTransaction $transaction)
    {
        $this->client->set(self::PREFIX.$transaction->getId(), serialize($transaction));
    }

    public function get(string $transactionId): UploadTransaction
    {
        $data = $this->client->get(self::PREFIX.$transactionId);
        return unserialize($data);
    }
}