<?php

namespace App\Helper;

use Generator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;

class UrlContainer {

    private $urls = [];

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var Request
     */
    private Request $request;

    public function __construct (UrlGeneratorInterface $urlGenerator, Request $request) {
        $this->urlGenerator = $urlGenerator;
        $this->request = $request;
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
        $isActive = $this->request->attributes->get('_route') == $urlIdentifier;
        $this->addUrl(new Url($nameDisplay, $this->urlGenerator->generate($urlIdentifier, $parameters, $referenceType), false, $isActive));

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