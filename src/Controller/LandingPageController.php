<?php

namespace App\Controller;

use App\Helper\BreadCrumbsChain;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageController extends AbstractController {

    use  BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addHome(null, null);
    }

    function getPageTitle (): ?string {
        return 'Willkommen!';
    }

    function getTemplate (): string {
        return 'landing_page/index.twig';
    }

    function getIntroData (): ?array {
        return null;
    }

    /**
     * @Route("/", name="landingPage")
     * @param NewsRepository $newsRepository
     *
     * @return Response
     */
    function index (NewsRepository $newsRepository): Response {
        $this->assign('newsEntityLatest', $newsRepository->findForLandingPage());

        return $this->renderPageView();
    }
}
