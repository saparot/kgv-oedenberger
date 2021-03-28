<?php

namespace App\Mixin;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Helper\UrlContainer;
use Exception;
use Psr\Log\NullLogger;
use Symfony\Component\HttpFoundation\Response;

trait PageviewMixin {

    private array $templateData = [];

    abstract function getBreadCrumbChain (): ?BreadCrumbsChain;

    abstract function getPageTitle (): ?string;

    abstract function getTemplate (): string;

    function getCategory (): ?string {
        return null;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls ?? null;
    }

    abstract function render (string $view, array $parameters = [], Response $response = null): Response;

    private function assign (string $name, $value = null): self {
        $this->templateData[$name] = $value;

        return $this;
    }

    private function renderPageView (Response $response = null) {
        $tpData = $this->getTemplateData();

        return $this->render($this->getTemplate(), $tpData, $response);
    }

    private function getTemplateData (): array {
        $extended = [
            'title' =>  $this->getPageTitle(),
            'breadCrumbs' => $this->getBreadCrumbChain() ? $this->getBreadCrumbChain()->export() : [],
            'sidebarUrlList' => $this->generateSidebarUrlList(),
            'teaserVariant' => $this->getTeaserVariant(),
        ];

        return array_merge($this->templateData, $extended);
    }

    private function getTeaserVariant (): string {
        switch ($this->getCategory()) {
            case Categories::CATEGORY_AREA:
                return 'header__teaser--variant2';
            case Categories::CATEGORY_ESSENTIALS;
                return 'header__teaser--variant3';
            case Categories::CATEGORY_CLUB:
            default:
                return 'header__teaser--variant1';
        }
    }

    private function generateSidebarUrlList (): ?UrlContainer {
        if ($this->getKgvUrls() && $this->getKgvUrls()->exists($this->getCategory())) {
            try {
                return $this->getKgvUrls()->get($this->getCategory());
            } catch (Exception $e) {
                //todo: add logging
            }
        }

        return null;
    }
}