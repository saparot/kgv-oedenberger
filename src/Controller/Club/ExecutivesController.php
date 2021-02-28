<?php

namespace App\Controller\Club;

use App\Helper\BreadCrumbsChain;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExecutivesController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addAboutUs(null, $this->generateUrl('clubExecutives'));
    }

    function getPageTitle (): ?string {
        return 'Vorstand';
    }

    function getTemplate (): string {
        return 'club/executives/index.html.twig';
    }

    /**
     * @Route("/club/executives", name="clubExecutives")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        $this->prepareTemplateData();

        return $this->renderPageView();
    }

    private function prepareTemplateData () {
        //todo shift to database and provide by easy-admin
        $executes = [
            [
                'position' => '1. Vorsitzende',
                'name' => 'Heike Ulrich',
                'phone' => null,
                'email' => 'ulrich@kleingartenverein-oedenberger-Strasse.de',
            ],
            [
                'position' => '2. Vorsitzende',
                'name' => 'Position nicht besetzt',
                'phone' => null,
                'email' => null,
            ],
            [
                'position' => 'Kassier',
                'name' => 'Frank Richter',
                'phone' => null,
                'email' => 'richter@kleingartenverein-oedenberger-strasse.de',
            ],
            [
                'position' => 'Schriftführerin',
                'name' => 'Vera Krause',
                'phone' => null,
                'email' => 'krause@kleingartenverein-oedenberger-strasse.de',
            ],
            [
                'position' => 'Oberwasserwart',
                'name' => 'Martin Lauterbach',
                'phone' => '0177 - 74 22 40 9',
                'email' => 'wasser@kleingartenverein-oedenberger-strasse.de',
            ],
        ];
        $this->assign('executives', $executes);
    }
}
