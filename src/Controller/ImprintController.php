<?php

namespace App\Controller;

use App\Helper\BreadCrumbsChain;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
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

    function getTemplate (): string {
        return 'imprint/index.html.twig';
    }

    /**
     * @Route("/imprint", name="imprint")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
