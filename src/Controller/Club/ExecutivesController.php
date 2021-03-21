<?php

namespace App\Controller\Club;

use App\Helper\BreadCrumbsChain;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use App\Repository\ExecutiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExecutivesController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addAboutUs(null, $this->generateUrl('clubExecutives'));
    }

    function getPageTitle (): ?string {
        return 'Vorstand';
    }

    function getTemplate (): string {
        return 'club/executives/index.html.twig';
    }

    /**
     * @Route("/club/executives", name="clubExecutives")
     * @param Request $request
     * @param ExecutiveRepository $executiveRepository
     *
     * @return Response
     */
    function index (Request $request, ExecutiveRepository $executiveRepository): Response {
        $this->prepareTemplateData($executiveRepository);

        return $this->renderPageView();
    }

    private function prepareTemplateData (ExecutiveRepository $executiveRepository) {

        $executives = $executiveRepository->findAll();
        $this->assign('executives', $executives);
    }
}
