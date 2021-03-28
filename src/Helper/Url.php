<?php

namespace App\Helper;

class Url {

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $nameDisplay;

    /**
     * @var false
     */
    private $isSeparator;

    function __construct (string $nameDisplay, string $url, bool $isSeparator = false) {
        $this->url = $url;
        $this->nameDisplay = $nameDisplay;
        $this->isSeparator = $isSeparator;
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
}