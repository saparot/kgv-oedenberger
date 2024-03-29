<?php

namespace App\Controller\Administration;

use App\Entity\Executive;
use App\Form\ExecutiveType;
use App\Helper\BreadCrumbsChain;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use App\Repository\ExecutiveRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/executives")
 */
class ExecutiveController extends AbstractController {

    use  BreadCrumbMixin, PageviewMixin;

    public function __construct (private KgvUrls $kgvUrls, private ManagerRegistry $doctrine) {}

    public function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    public function getBreadCrumbChain (): ?BreadCrumbsChain {
        return $this->addAdministration(null, null)->add('Vorstand', $this->generateUrl('administrationExecutive'));
    }

    public function getPageTitle (): ?string {
        return 'Administration Vorstand';
    }

    public function getTemplate (): string {
        return 'administration/executive/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Administration Vorstand',
            'icon' => 'flower-with-pot-colored',
            'text' => 'Hier können die Namen der Vorstände und anderer Funktionäre bearbeitet werden. Neue Positionen können aktuell nicht hinzugefügt werden. ',
        ];
    }

    /**
     * @Route("/", name="administrationExecutive", methods={"GET"})
     * @param ExecutiveRepository $executiveRepository
     *
     * @return Response
     */
    public function index (ExecutiveRepository $executiveRepository): Response {
        $this->assign('executives', $executiveRepository->findAll());

        return $this->renderPageView();
    }

    /**
     * @Route("/{id}", name="administrationExecutiveShow", methods={"GET"})
     * @param Executive $executive
     *
     * @return Response
     */
    public function show (Executive $executive): Response {
        return $this->render('administration/executive/show.twig', [
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
            $this->doctrine->getManager()->flush();
            $this->addFlash('success', 'Änderung erfolgreich gespeichert');

            return $this->redirectToRoute('administrationExecutive');
        }

        return $this->render('administration/executive/edit.twig', [
            'executive' => $executive,
            'form' => $form->createView(),
        ]);
    }
}
