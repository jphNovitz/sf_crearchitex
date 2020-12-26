<?php

namespace App\Service;

use App\Model\EmailSenderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailSender implements EmailSenderInterface{

    private $emailTo;
    private $mailer;

    public function __construct(ContainerInterface $container, MailerInterface $mailer){
        $this->emailTo = $container->getParameter('email_to');
        $this->mailer = $mailer;
    }

    public function send($name, $email, $message)
    {
        try {
            $email = (new Email())
                ->from($email)
                ->to($this->emailTo)
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                ->replyTo($email)
                //->priority(Email::PRIORITY_HIGH)
                ->subject('*** message sur Crearchitex ***')
                ->text($message)
                ->html('<p>' . $message . '</p>');

            $this->mailer->send($email);
            return true;

        } catch (\Exception $e) {
            return false;
        }
    }
}