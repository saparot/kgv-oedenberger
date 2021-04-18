<?php

namespace App\Mixin;

use App\Helper\BreadCrumb;
use App\Helper\BreadCrumbsChain;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

trait BreadCrumbMixin {

    private ?BreadCrumbsChain $breadCrumbsChain;

    abstract function generateUrl (string $route, array $parameters = [], int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): string;

    private function addAdministration (?string $text, ?string $url): BreadCrumbsChain {
        $breadChain = $this->getBreadCrumbsChain()->add('Administration', null);

        return $text ? $breadChain->add($text, $url) : $breadChain;
    }


    private function addMembers (?string $text, ?string $url): BreadCrumbsChain {
        $breadChain = $this->getBreadCrumbsChain()->add('Vereinsmitglieder', null);

        return $text ? $breadChain->add($text, $url) : $breadChain;
    }

    private function addHome (?string $text, ?string $url): BreadCrumbsChain {
        $breadChain = $this->getBreadCrumbsChain();

        return $text ? $breadChain->add($text, $url) : $breadChain;
    }

    private function addAboutUs (?string $text, ?string $url): BreadCrumbsChain {
        $breadChain = $this->getBreadCrumbsChain()->add('Verein', null);

        return $text ? $breadChain->add($text, $url) : $breadChain;
    }

    private function addGardenArea (?string $text, ?string $url): BreadCrumbsChain {
        $breadChain = $this->getBreadCrumbsChain()->add('die Anlage', null);

        return $text ? $breadChain->add($text, $url) : $breadChain;
    }

    private function addGarden (?string $text, ?string $url): BreadCrumbsChain {
        $breadChain = $this->getBreadCrumbsChain()->add('Gärten', null);

        return $text ? $breadChain->add($text, $url) : $breadChain;
    }

    private function getBreadCrumbsChain (): BreadCrumbsChain {
        $this->breadCrumbsChain ??= $this->getDefaultBreadCrumbsChain();

        return $this->breadCrumbsChain;
    }

    private function getDefaultBreadCrumbsChain (): BreadCrumbsChain {
        return (new BreadCrumbsChain())->addBreadCrumb(new BreadCrumb('Start', $this->generateUrl('landingPage')));
    }
}