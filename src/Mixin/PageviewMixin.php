<?php

namespace App\Mixin;

use App\Helper\BreadCrumbsChain;
use App\Helper\KgvUrls;
use App\Helper\UrlContainer;
use Exception;
use Symfony\Component\HttpFoundation\Response;

trait PageviewMixin {

    private array $templateData = [];

    abstract function getBreadCrumbChain (): ?BreadCrumbsChain;

    abstract function getPageTitle (): ?string;

    abstract function getTemplate (): string;

    function getSidebarCategory (): ?string {
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
        $title = $this->getPageTitle();
        $extended = $title ? ['title' => $title] : [];
        $extended['breadCrumbs'] = $this->getBreadCrumbChain() ? $this->getBreadCrumbChain()->export() : [];

        $extended['sidebarUrlList'] = $this->generateSidebarUrlList();

        return array_merge($this->templateData, $extended);
    }

    private function generateSidebarUrlList (): ?UrlContainer {
        if ($this->getKgvUrls() && $this->getKgvUrls()->exists($this->getSidebarCategory())) {
            try {
                return $this->getKgvUrls()->get($this->getSidebarCategory());
            } catch (Exception $e) {
                //todo: add logging
            }
        }

        return null;
    }
}