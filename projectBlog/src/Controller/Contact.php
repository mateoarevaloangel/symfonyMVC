<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
class Contact extends AbstractController
{

    public function say()
    {
        $ms = "Bienvenido";

        return $this->render('contact.html.twig', [
            'mensaje' => $ms
        ]);
    }
    public function new(Request $request)
{
    // just setup a fresh $task object (remove the dummy data)
    $Message = new Message();

    $form = $this->createFormBuilder($Message,'text',array('mapped'=>false))
        ->add('nombre', TextType::class, [
            
            'label'  => 'nombre',
        ])
        ->add('email', TextType::class, [
            
            'label'  => 'email',
        ])
        ->add('mensage', TextareaType::class, [
            
            'label'  => 'nombre',
        ])
        ->add('save', SubmitType::class, ['label' => 'enviar'])
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
  
        $Message = $form->getData();

        return $this->redirectToRoute('/contact');
    }

    return $this->render('contact.html.twig', [
        'form' => $form->createView(),
    ]);
}
}