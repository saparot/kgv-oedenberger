<?php

namespace App\Controller\WaitingList;

use App\Helper\BreadCrumbsChain;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ClosedController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    /**
     * @Route("/waiting-list/closed", name="waitingListClosed")
     */
    function index (): Response {
        return $this->renderPageView();
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGardenArea('Warteliste geschlossen', null);
    }

    function getPageTitle (): ?string {
        return 'Warteliste geschlossen';
    }

    function getTemplate (): string {
        return 'waiting_list/closed/index.html.twig';
    }
}
