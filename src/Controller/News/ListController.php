<?php

namespace App\Controller\News;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController {

    use  BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_CLUB;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addHome(null, null);
    }

    function getPageTitle (): ?string {
        return 'Neuigkeiten';
    }

    function getTemplate (): string {
        return 'news/list/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'News & Ankündigungen',
            'icon' => 'fence',
            'text' => 'Auf dieser Seite finden Sie die aktuellen Neuigkeiten rund um den Verein, die Anlage und Gärten, wie z. B. Termine. Besuchen Sie diese Seite regelmäßig um keine Neuigkeit zu verpassen!',
        ];
    }

    /**
     * @Route("/news", name="newsList")
     * @param Request $request
     * @param NewsRepository $newsRepository
     *
     * @return Response
     */
    function index (Request $request, NewsRepository $newsRepository): Response {
        $this->addNewsList($newsRepository);

        return $this->renderPageView();
    }

    private function addNewsList (NewsRepository $newsRepository) {
        $this->assign('newsList', $newsRepository->findForNewsPage());
    }
}
