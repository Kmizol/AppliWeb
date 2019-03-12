<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LignefraishorsforfaitController extends AbstractController
{
    /**
     * @Route("/lignefraishorsforfait", name="lignefraishorsforfait")
     */
    public function index()
    {
        return $this->render('lignefraishorsforfait/index.html.twig', [
            'controller_name' => 'LignefraishorsforfaitController',
        ]);
    }
}
