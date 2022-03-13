<?php


namespace App\Interfaces;


use App\DTO\GetContactData;

interface ContactInterface
{
    /**
     * @param array $contactData
     * @return mixed
     */
    public  function send(array $contactData);


    /**
     * @param GetContactData $contactData
     * @return mixed
     */
    public function store(GetContactData $contactData);


}
