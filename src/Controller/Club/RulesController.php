<?php

namespace App\Controller\Club;

use App\Helper\BreadCrumbsChain;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RulesController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addAboutUs(null, $this->generateUrl('clubRules'));
    }

    function getPageTitle (): ?string {
        return 'Satzung';
    }

    function getTemplate (): string {
        return 'club/rules/index.html.twig';
    }

    /**
     * @Route("/club/rules", name="clubRules")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
