<?php

namespace App\Controller;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrivacyController extends AbstractController {

    use  BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addHome('Datenschutzerklärung', null);
    }

    function getPageTitle (): ?string {
        return 'Datenschutzerklärung';
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_ESSENTIALS;
    }

    function getTemplate (): string {
        return 'privacy/index.twig';
    }

    function getIntroData (): ?array {
        return null;
    }

    /**
     * @Route("/datenschutz", name="privacy")
     * @return Response
     */
    function index (): Response {
        return $this->renderPageView();
    }
}
