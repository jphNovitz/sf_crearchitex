<?php

namespace App\Controller\Contact;

use App\Model\EmailSenderInterface;
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
    public function index(Request $request, EmailSenderInterface $emailSender): Response
    {

        $form = $this->makeForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            if ($emailSender->send($data['name'], $data['email'], $data['message'])) {
                $this->addFlash('success', 'Message envoyé');
                $form = $this->makeForm();
            } else {
                $this->addFlash('danger', 'Il y a eu une erreur');
                return $this->render('contact/index.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }


        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    protected function makeForm()
    {
        return $this->createFormBuilder()
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
    }
}
