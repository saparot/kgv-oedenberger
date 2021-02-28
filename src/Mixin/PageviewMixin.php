<?php

namespace App\Mixin;

use App\Helper\BreadCrumbsChain;
use Symfony\Component\HttpFoundation\Response;

trait PageviewMixin {

    private array $templateData = [];

    abstract function getBreadCrumbChain (): BreadCrumbsChain;

    abstract function getPageTitle (): ?string;

    abstract function getTemplate (): string;

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
        $extended['breadCrumbs'] = $this->getBreadCrumbChain()->export();

        return array_merge($this->templateData, $extended);
    }
}