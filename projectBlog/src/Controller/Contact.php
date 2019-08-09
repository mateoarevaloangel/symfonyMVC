<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class Contact extends AbstractController
{

    public function say()
    {
        $ms = "Bienvenido";

        return $this->render('contact.html.twig', [
            'mensaje' => $ms
        ]);
    }
}