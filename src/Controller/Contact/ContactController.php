<?php

namespace App\Controller\Contact;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer): Response
    {

        $form = $this->createFormBuilder()
            ->add('name', TextType::class, [
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'required' => false,
            ])
            ->add('message', TextareaType::class, [
                'required' => false,
            ])
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('send@example.com')
                ->setTo('recipient@example.com')
                ->setBody(
                    $this->renderView(
                        'email/contact-mail.html.twig',
                        ['name' => '$name']
                    ),
                    'text/html'
                );

                // you can remove the following code if you don't define a text version for your emails
                /*->addPart(
                    $this->renderView(
                    // templates/emails/registration.txt.twig
                        'emails/registration.txt.twig',
                        ['name' => $name]
                    ),
                    'text/plain'
                )
            ;*/

            $mailer->send($message);
            dd($data);
        }


        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
