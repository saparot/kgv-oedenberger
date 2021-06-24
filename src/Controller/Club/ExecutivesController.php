<?php

namespace App\Controller\Club;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use App\Repository\ExecutiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExecutivesController extends AbstractController {

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
        return $this->addAboutUs(null, $this->generateUrl('clubExecutives'));
    }

    function getPageTitle (): ?string {
        return 'Der Vorstand';
    }

    function getTemplate (): string {
        return 'club/executives/index.html.twig';
    }

    /**
     * @Route("/verein/vorstand", name="clubExecutives")
     * @param Request $request
     * @param ExecutiveRepository $executiveRepository
     *
     * @return Response
     */
    function index (Request $request, ExecutiveRepository $executiveRepository): Response {
        $this->prepareTemplateData($executiveRepository);

        return $this->renderPageView();
    }

    private function getIntroData (): ?array {
        return [
            'title' => 'Der Vorstand',
            'icon' => 'watercan',
            'text' => 'Damit unser Verein funktioniert, brauchen wir natürlich einen Vorstand. Dieser wird ordentlich einmal im Jahr auf unser Mitgliederversammlung gewählt.  Unser  Vorstand übernimmt auch of gutwillig Aufgaben, die die Vereinsarbeit so mit sich bringt, zum Beispiel die Organisation von Veranstaltungen, den Einkauf von Wasseruhren für günstige Preise und viele andere Kleinigkeiten.',
        ];
    }

    private function prepareTemplateData (ExecutiveRepository $executiveRepository) {
        $executives = $executiveRepository->findAll();
        $this->assign('executives', $executives);
    }
}
