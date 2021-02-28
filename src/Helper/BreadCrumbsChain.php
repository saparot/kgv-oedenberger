<?php

namespace App\Helper;

class BreadCrumbsChain {

    /** @var BreadCrumb[] */
    private array $breadCrumbs;

    function add (string $text, ?string $url): BreadCrumbsChain {
        return $this->addBreadCrumb(new BreadCrumb($text, $url));
    }

    function addBreadCrumb (BreadCrumb $breadCrumb): BreadCrumbsChain {
        $this->breadCrumbs[] = $breadCrumb;

        return $this;
    }

    function export (): array {
        $export = [];
        foreach ($this->breadCrumbs as $breadCrumb) {
            $export[] = ['text' => $breadCrumb->getTitle(), 'url' => $breadCrumb->getUrl()];
        }

        return $export;
    }
}