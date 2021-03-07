<?php

namespace App\Controller\Administration;

use App\Entity\Executive;
use App\Form\ExecutiveType;
use App\Repository\ExecutiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/executives")
 */
class ExecutiveController extends AbstractController {

    /**
     * @Route("/", name="administrationExecutive", methods={"GET"})
     * @param ExecutiveRepository $executiveRepository
     *
     * @return Response
     */
    public function index (ExecutiveRepository $executiveRepository): Response {
        return $this->render('administration/executive/index.html.twig', [
            'executives' => $executiveRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="administrationExecutiveNew", methods={"GET","POST"})
     * @param Request $request
     *
     * @return Response
     */
    public function new (Request $request): Response {
        return $this->redirectToRoute('administrationExecutive');
        //$executive = new Executive();
        //$form = $this->createForm(ExecutiveType::class, $executive);
        //$form->handleRequest($request);
        //
        //if ($form->isSubmitted() && $form->isValid()) {
        //    $entityManager = $this->getDoctrine()->getManager();
        //    $entityManager->persist($executive);
        //    $entityManager->flush();
        //
        //    return $this->redirectToRoute('administrationExecutive');
        //}
        //
        //return $this->render('administration/executive/new.html.twig', [
        //    'executive' => $executive,
        //    'form' => $form->createView(),
        //]);
    }

    /**
     * @Route("/{id}", name="administrationExecutiveShow", methods={"GET"})
     * @param Executive $executive
     *
     * @return Response
     */
    public function show (Executive $executive): Response {
        return $this->render('administration/executive/show.html.twig', [
            'executive' => $executive,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="administrationExecutiveEdit", methods={"GET","POST"})
     * @param Request $request
     * @param Executive $executive
     *
     * @return Response
     */
    public function edit (Request $request, Executive $executive): Response {
        $form = $this->createForm(ExecutiveType::class, $executive);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administrationExecutive');
        }

        return $this->render('administration/executive/edit.html.twig', [
            'executive' => $executive,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="administrationExecutiveDelete", methods={"DELETE"})
     */
    public function delete (Request $request, Executive $executive): Response {
        if ($this->isCsrfTokenValid('delete' . $executive->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($executive);
            $entityManager->flush();
        }

        return $this->redirectToRoute('administrationExecutive');
    }
}
