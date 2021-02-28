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

class GardenRulesController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addAboutUs(null, $this->generateUrl('clubGardenRules'));
    }

    function getPageTitle (): ?string {
        return 'Vorstand';
    }

    function getTemplate (): string {
        return 'club/garden_rules/index.html.twig';
    }

    /**
     * @Route("/club/garden/rules", name="clubGardenRules")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
