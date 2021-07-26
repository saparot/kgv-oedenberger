<?php

namespace App\Mixin;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Helper\UrlContainer;
use Exception;
use Symfony\Component\HttpFoundation\Response;

trait PageviewMixin {

    private array $templateData = [];

    abstract protected function getIntroData (): ?array;

    abstract function getBreadCrumbChain (): ?BreadCrumbsChain;

    abstract function getPageTitle (): ?string;

    abstract function getTemplate (): string;

    abstract function getKgvUrls (): ?KgvUrls;

    function getCategory (): ?string {
        return null;
    }

    abstract function render (string $view, array $parameters = [], Response $response = null): Response;

    private function assign (string $name, $value = null): self {
        $this->templateData[$name] = $value;

        return $this;
    }

    private function renderPageView (Response $response = null): Response {
        $tpData = $this->getTemplateData();

        return $this->render($this->getTemplate(), $tpData, $response);
    }

    private function getTemplateData (): array {
        $breadCrumbChain = $this->getBreadCrumbChain();
        $extended = [
            'pageIdent' => $this->getPageIdentifier(),
            'pageIdentifierClasses' => $this->getPageIdentifierClasses(),
            'title' => $this->getPageTitle(),
            'breadCrumbs' => $breadCrumbChain ? $breadCrumbChain->export() : [],
            'sidebarUrlList' => $this->generateSidebarUrlList(),
            'teaserVariant' => $this->getTeaserVariant(),
            'introData' => $this->getIntroData(),
        ];

        return $this->templateData + $extended;
    }

    private function getPageIdentifier (): string {
        $pageIdent = str_replace('\\', '-', mb_strtolower(get_class($this)));
        $pageIdent = preg_replace('/controller$/', '', $pageIdent);

        return str_replace('app-controller-', '', $pageIdent);
    }

    private function getPageIdentifierClasses (): string {
        $pageIdent = $this->getPageIdentifier();
        $groups = explode('-', str_replace('app-controller-', '', $pageIdent));
        $categoryIdent = sprintf('kgv-content-%s', $groups[0] ?? 'default');

        return implode(' ', array_unique(['kgv-content', $categoryIdent, sprintf('kgv-content-%s', $pageIdent)]));
    }

    private function getTeaserVariant (): string {
        switch ($this->getCategory()) {
            case Categories::CATEGORY_AREA:
                return 'header__teaser--variant2';
            case Categories::CATEGORY_GARDEN;
                return 'header__teaser--variant4';
            case Categories::CATEGORY_ESSENTIALS;
                return 'header__teaser--variant3';
            case Categories::CATEGORY_CLUB:
            default:
                return 'header__teaser--variant1';
        }
    }

    private function generateSidebarUrlList (): ?UrlContainer {
        $kgUrls = $this->getKgvUrls();
        if ($kgUrls && $kgUrls->exists($this->getCategory())) {
            try {
                return $this->getKgvUrls()->get($this->getCategory());
            } catch (Exception $e) {
                //todo: add logging
            }
        }

        return null;
    }
}