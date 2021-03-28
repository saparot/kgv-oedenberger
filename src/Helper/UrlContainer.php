<?php

namespace App\Helper;

use Generator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UrlContainer {

    private $urls = [];

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function __construct (UrlGeneratorInterface $urlGenerator) {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @return Generator|Url[]
     */
    function iterate (): Generator {
        foreach ($this->urls as $url) {
            yield $url;
        }
    }

    function add (string $nameDisplay, string $urlIdentifier, array $parameters = [], int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): UrlContainer {
        $this->addUrl(new Url($nameDisplay, $this->urlGenerator->generate($urlIdentifier, $parameters, $referenceType)));

        return $this;
    }

    function addUrl (Url $url): UrlContainer {
        $this->urls[] = $url;

        return $this;
    }

    function addSeparator (): UrlContainer {
        $this->urls[] = new Url('', '', true);

        return $this;
    }
}