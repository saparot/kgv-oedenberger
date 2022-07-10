<?php

namespace App\Controller;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use App\Repository\ExecutiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImprintController extends AbstractController {

    use  BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

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
        return 'imprint/index.twig';
    }

    function getIntroData (): ?array {
        return null;
    }

    /**
     * @Route("/impressum", name="imprint")
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
