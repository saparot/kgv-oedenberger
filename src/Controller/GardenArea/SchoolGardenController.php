<?php

namespace App\Controller\GardenArea;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SchoolGardenController extends AbstractController {

    use BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_AREA;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGardenArea('Anfahrt', $this->generateUrl('gardenAreaRouteDescription'));
    }

    function getPageTitle (): ?string {
        return 'Schul Garten Bismarckschule';
    }

    function getTemplate (): string {
        return 'garden_area/school_garden/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Schulgarten Bismarckschule',
            'icon' => 'lady-bug',
            'text' => "Seit Mai 2016 gibt es in unserer Anlage einen <strong>Schulgarten!</strong> Der Förderverein der <strong>Bismarckschule</strong> hat einen Kleingarten bei uns gepachtet. Der Stadtverbandsvorstand und der Vereinsvorstand freuen sich sehr, daß das Projekt hier bei uns verwirklicht werden konnte!",
        ];
    }

    /**
     * @Route("/anlage/schul-garten", name="gardenAreaSchoolGarden")
     */
    public function index (): Response {
        return $this->renderPageView();
    }
}
