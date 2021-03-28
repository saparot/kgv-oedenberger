<?php

namespace App\Helper;

class Url {

    private string $url;

    private string $nameDisplay;

    private bool $isSeparator;

    /**
     * @var bool
     */
    private bool $isActive;

    function __construct (string $nameDisplay, string $url, bool $isSeparator = false, bool $isActive = false) {
        $this->url = $url;
        $this->nameDisplay = $nameDisplay;
        $this->isSeparator = $isSeparator;
        $this->isActive = $isActive;
    }

    function getUrl (): string {
        return $this->url;
    }

    function getNameDisplay (): string {
        return $this->nameDisplay;
    }

    function isSeparator (): bool {
        return $this->isSeparator;
    }

    function isActive (): bool {
        return $this->isActive;
    }
}