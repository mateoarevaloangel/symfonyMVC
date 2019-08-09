<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class Home extends AbstractController
{

    public function say()
    {
        $ms = "Bienvenido";

        return $this->render('home.html.twig', [
            'mensaje' => $ms
        ]);
    }
}