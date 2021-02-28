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

class ContactController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addHome('Kontakt', null);
    }

    function getPageTitle (): ?string {
        return 'Kontakt';
    }

    function getTemplate (): string {
        return 'contact/index.html.twig';
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
