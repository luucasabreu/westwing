<?php

namespace App\Service;

use App\Repository\ClientRepository;

class ClientService
{

    protected $clientRepository;

    /**
     * ClientService constructor.
     *
     * @param ClientRepository $clientRepository
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Method to find client by email
     * @param $email
     * @return mixed
     */
    public function findByEmail($email)
    {
        return $this->clientRepository->findBy('email', $email);
    }
}