<?php

namespace App\Controller;

use App\Entity\Fichefrais;
use App\Form\FichefraisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
/**
 * @Route("/fichefrais")
 */
class FichefraisController extends AbstractController
{
    /**
     * @Route("/", name="fichefrais_index", methods="GET")
     */
    public function index( SessionInterface $session): Response
    {
        $visiteur= $session->get('visiteur');
        dump($visiteur) ;
        $fichefrais = $this->getDoctrine()
            ->getRepository(Fichefrais::class)
            ->findBy(['idvisiteur' => $visiteur->getId()]);
                dump($fichefrais) ; 
        return $this->render('fichefrais/index.html.twig', ['fichefrais' => $fichefrais]);
    }

    /**
     * @Route("/new", name="fichefrais_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $fichefrai = new Fichefrais();
        $form = $this->createForm(FichefraisType::class, $fichefrai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fichefrai);
            $em->flush();

            return $this->redirectToRoute('fichefrais_index');
        }

        return $this->render('fichefrais/new.html.twig', [
            'fichefrai' => $fichefrai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{mois}", name="fichefrais_show", methods="GET")
     */
    public function show(Fichefrais $fichefrai): Response
    {
        return $this->render('fichefrais/show.html.twig', ['fichefrai' => $fichefrai]);
    }

    /**
     * @Route("/{mois}/edit", name="fichefrais_edit", methods="GET|POST")
     */
    public function edit(Request $request, Fichefrais $fichefrai): Response
    {
        $form = $this->createForm(FichefraisType::class, $fichefrai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fichefrais_index', ['mois' => $fichefrai->getMois()]);
        }

        return $this->render('fichefrais/edit.html.twig', [
            'fichefrai' => $fichefrai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{mois}", name="fichefrais_delete", methods="DELETE")
     */
    public function delete(Request $request, Fichefrais $fichefrai): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fichefrai->getMois(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fichefrai);
            $em->flush();
        }

        return $this->redirectToRoute('fichefrais_index');
    }
  
}
