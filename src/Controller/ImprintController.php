<?php

namespace App\Controller;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use App\Repository\ExecutiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImprintController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addHome('Impressum', null);
    }

    function getPageTitle (): ?string {
        return 'Impressum';
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_ESSENTIALS;
    }

    function getTemplate (): string {
        return 'imprint/index.html.twig';
    }

    /**
     * @Route("/imprint", name="imprint")
     * @param Request $request
     * @param ExecutiveRepository $executiveRepository
     *
     * @return Response
     */
    function index (Request $request, ExecutiveRepository $executiveRepository): Response {

        $executives = $executiveRepository->findForImprint();
        $this->assign('executives', $executives);
        return $this->renderPageView();
    }
}
