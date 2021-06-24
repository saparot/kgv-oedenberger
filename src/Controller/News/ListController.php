<?php

namespace App\Controller\News;

use App\Entity\News;
use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    /**
     * @var KgvUrls
     */
    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
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
        return 'news/list/index.html.twig';
    }

    /**
     * @Route("/news", name="newsList")
     * @param Request $request
     * @param NewsRepository $newsRepository
     *
     * @return Response
     */
    function index (Request $request, NewsRepository $newsRepository): Response {
        ;
        $this->addNewsList($newsRepository);

        return $this->renderPageView();
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'News & Ankündigungen',
            'icon' => 'fence',
            'text' => 'Auf dieser Seite finden Sie die aktuellen Neuigkeiten rund um den Verein, die Anlage und Gärten, wie z. B. Termine für das An- und Abstellen des Wassers. Besuchen Sie diese Seite regelmäßig um keine Neuigkeit zu verpassen!',
        ];
    }

    private function addNewsList (NewsRepository $newsRepository) {
        $this->assign('newsList', $newsRepository->findForNewsPage());
    }
}
