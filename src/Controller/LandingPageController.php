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

class LandingPageController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addHome(null, null);
    }

    function getPageTitle (): ?string {
        return 'Willkommen!';
    }

    function getTemplate (): string {
        return 'landing_page/index.html.twig';
    }

    /**
     * @Route("/", name="landingPage")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
//
//
//ewz_recaptcha:
//#https://packagist.org/packages/excelwebzone/recaptcha-bundle
//version: 3
//  public_key: 6Lcz3ZIaAAAAAIFwaqo56KQxP0O-a-k4umjArbsB
//  private_key: 6Lcz3ZIaAAAAAA0tpdZPQZNG8BRsE1kdMJUJ9LLN
//  hide_badge: false
//  score_threshold: 0.5
