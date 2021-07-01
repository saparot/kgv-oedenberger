<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class KgvUrls {

    private array $container = [];

    private UrlGeneratorInterface $urlGenerator;

    /**
     * @var Request|null
     */
    private ?Request $request;

    private bool $initDone = false;

    function __construct (UrlGeneratorInterface $urlGenerator, RequestStack $requestStack) {
        $this->urlGenerator = $urlGenerator;
        $this->request = $requestStack->getCurrentRequest();
    }

    private function init () {
        if ($this->initDone) {
            return;
        }
        $this->container[Categories::CATEGORY_CLUB] = $this->initClub();
        $this->container[Categories::CATEGORY_AREA] = $this->initArea();
        $this->container[Categories::CATEGORY_GARDEN] = $this->initGarden();
        $this->container[Categories::CATEGORY_ESSENTIALS] = $this->initEssentials();
    }

    private function initGarden () {
        $uc = new UrlContainer($this->urlGenerator, $this->request);
        $uc->add('Gartengestaltung', 'gardenGardenDesign');
        $uc->addSeparator();
        $uc->add('Was nicht in den Garten darf', 'gardenGardenDesignNotAllowed');
        $uc->addSeparator();
        $uc->add('10 Gebote des Kleingärtners', 'gardenCommandments');
        $uc->addSeparator();
        $uc->add('Gartenauflösung', 'gardenTermination');

        return $uc;
    }

    private function initClub (): UrlContainer {
        $uc = new UrlContainer($this->urlGenerator, $this->request);

        $uc->add('Ankündigungen', 'newsList');
        $uc->addSeparator();
        $uc->add('Vorstand', 'clubExecutives');
        $uc->add('Satzung', 'clubRules');
        $uc->add('Garten Ordnung', 'clubGardenRules');
        $uc->add('Geschichte', 'clubHistory');
        $uc->add('Formulare + Downloads', 'clubDownloads');

        return $uc;
    }

    private function initArea (): UrlContainer {
        return (new UrlContainer($this->urlGenerator, $this->request))->add('Übersicht + Geländeplan', 'gardenAreaOverview')
            ->addSeparator()
            ->add('freie Gärten', 'gardenAreaFreeGarden')
            ->addSeparator()
            ->add('Anfahrt', 'gardenAreaRouteDescription')
            ->addSeparator()
            ->add('Spielplatz', 'gardenAreaPlayground')
            ->add('Spaziergang durch die Anlage', 'gardenAreaWalkThrough');
    }

    private function initEssentials (): UrlContainer {
        $uc = new UrlContainer($this->urlGenerator, $this->request);

        $uc->add('Kontakt', 'contact');
        $uc->add('Impressum', 'imprint');

        return $uc;
    }

    function getEssentials (): UrlContainer {
        return $this->get(Categories::CATEGORY_ESSENTIALS);
    }

    function getArea (): UrlContainer {
        return $this->get(Categories::CATEGORY_AREA);
    }

    function getClub (): UrlContainer {
        return $this->get(Categories::CATEGORY_CLUB);
    }

    function getGarden (): UrlContainer {
        return $this->get(Categories::CATEGORY_GARDEN);
    }

    function exists (?string $category): bool {
        $this->init();

        return isset($this->container[$category]);
    }

    function get (string $category): UrlContainer {
        $this->init();
        if (!isset($this->container[$category])) {
            throw new \Exception("unknown category {$category}");
        }

        return $this->container[$category];
    }
}