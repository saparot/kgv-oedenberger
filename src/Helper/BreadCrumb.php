<?php

namespace App\Helper;

class BreadCrumb {

    private ?string $url;

    private string $title;

    /**
     * BreadCrumb constructor.
     *
     * @param string $title
     * @param string|null $url
     */
    function __construct (string $title, ?string $url) {
        $this->title = $title;
        $this->url = $url;
    }

    function setTitle (string $title): self {
        $this->title = $title;

        return $this;
    }

    function setUrl (string $url): self {
        $this->url = $url;

        return $this;
    }

    function getTitle (): string {
        return $this->title;
    }

    function getUrl (): ?string {
        return $this->url;
    }
}