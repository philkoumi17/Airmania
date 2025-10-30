<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function home()
    {
        $prenoms = ['Phil' => 33, 'Bob' => 10, 'Anne' => 5];

        return $this->render('home.html.twig', [
            'title' => 'Hello World !',
            'age' => 20,
            'tableau' => $prenoms
        ]);
    }
}

?>