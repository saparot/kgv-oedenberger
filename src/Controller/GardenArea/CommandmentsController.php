<?php

namespace App\Controller\GardenArea;

use App\Helper\BreadCrumbsChain;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandmentsController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGardenArea('10 Gebote des Kleingärtners', null);
    }

    function getPageTitle (): ?string {
        return '10 Gebote des Kleingärtners';
    }

    function getTemplate (): string {
        return 'garden_area/commandments/index.html.twig';
    }

    /**
     * @Route("/gardenArea/commandments", name="gardenAreaCommandments")
     */
    public function index (): Response {
        return $this->renderPageView();
    }
}
