<?php

namespace App\Helper;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class KgvUrls {

    private $container = [];

    private UrlGeneratorInterface $urlGenerator;

    function __construct (UrlGeneratorInterface $urlGenerator) {
        $this->urlGenerator = $urlGenerator;
        $this->init();
    }

    private function init () {
        $this->container[Categories::CATEGORY_CLUB] = $this->initClub();
        $this->container[Categories::CATEGORY_AREA] = $this->initArea();
        $this->container[Categories::CATEGORY_ESSENTIALS] = $this->initEssentials();
    }

    private function initClub (): UrlContainer {
        $uc = new UrlContainer($this->urlGenerator);

        $uc->add('Ankündigungen', 'newsList');
        $uc->addSeparator();
        $uc->add('Vorstand', 'clubExecutives');
        $uc->add('Satzung', 'clubRules');
        $uc->add('Garten Ordnung', 'clubGardenRules');
        $uc->add('Geschichte', 'clubHistory');

        return $uc;
    }

    private function initArea (): UrlContainer {
        $uc = new UrlContainer($this->urlGenerator);

        $uc->add('Die Anlage in Zahlen', 'gardenAreaFacts');
        $uc->addSeparator();
        $uc->add('Übersichtsplan', 'gardenAreaMapOverview');
        $uc->add('Anfahrt', 'gardenAreaRouteDescription');
        $uc->addSeparator();
        $uc->add('Spielplatz', 'gardenAreaPlayground');

        $uc->add('Spaziergang durch die Anlage', 'gardenAreaWalkThrough');
        $uc->addSeparator();
        $uc->add('10 Gebote des Kleingärtners', 'gardenAreaCommandments');

        return $uc;
    }

    private function initEssentials (): UrlContainer {
        $uc = new UrlContainer($this->urlGenerator);

        $uc->add('Kontakt', 'contact');
        $uc->add('Impressum', 'imprint');

        return $uc;
    }

    function getEssentials (): UrlContainer {
        return $this->container[Categories::CATEGORY_ESSENTIALS];
    }

    function getArea (): UrlContainer {
        return $this->container[Categories::CATEGORY_AREA];
    }

    function getClub (): UrlContainer {
        return $this->container[Categories::CATEGORY_CLUB];
    }

    function exists (?string $category): bool {
        return isset($this->container[$category]);
    }

    function get (string $category): UrlContainer {
        if (!isset($this->container[$category])) {
            throw new \Exception("unknown category {$category}");
        }

        return $this->container[$category];
    }
}