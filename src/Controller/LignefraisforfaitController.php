<?php

namespace App\Controller;

use App\Entity\Lignefraisforfait;
use App\Form\Lignefraisforfait1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lignefraisforfait")
 */
class LignefraisforfaitController extends AbstractController
{
    /**
     * @Route("/", name="lignefraisforfait_index", methods="GET")
     */
    public function index(): Response
    {
        $lignefraisforfaits = $this->getDoctrine()
            ->getRepository(Lignefraisforfait::class)
            ->findAll();

        return $this->render('lignefraisforfait/index.html.twig', ['lignefraisforfaits' => $lignefraisforfaits]);
    }

    /**
     * @Route("/new", name="lignefraisforfait_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $lignefraisforfait = new Lignefraisforfait();
        $form = $this->createForm(Lignefraisforfait1Type::class, $lignefraisforfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lignefraisforfait);
            $em->flush();

            return $this->redirectToRoute('lignefraisforfait_index');
        }

        return $this->render('lignefraisforfait/new.html.twig', [
            'lignefraisforfait' => $lignefraisforfait,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lignefraisforfait_show", methods="GET")
     */
    public function show(Lignefraisforfait $lignefraisforfait): Response
    {
        return $this->render('lignefraisforfait/show.html.twig', ['lignefraisforfait' => $lignefraisforfait]);
    }

    /**
     * @Route("/{id}/edit", name="lignefraisforfait_edit", methods="GET|POST")
     */
    public function edit(Request $request, Lignefraisforfait $lignefraisforfait): Response
    {
        $form = $this->createForm(Lignefraisforfait1Type::class, $lignefraisforfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lignefraisforfait_index', ['id' => $lignefraisforfait->getId()]);
        }

        return $this->render('lignefraisforfait/edit.html.twig', [
            'lignefraisforfait' => $lignefraisforfait,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lignefraisforfait_delete", methods="DELETE")
     */
    public function delete(Request $request, Lignefraisforfait $lignefraisforfait): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lignefraisforfait->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lignefraisforfait);
            $em->flush();
        }

        return $this->redirectToRoute('lignefraisforfait_index');
    }
}
