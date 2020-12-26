<?php

namespace App\Model;


/**
 * Interface EmailSenderInterface
 * @package App\Model
 * sends email
 */
interface EmailSenderInterface{
    /**
     * @param $name
     * @param $email
     * @param $message
     * @return mixed
     */
    public function send($name, $email, $message );
}