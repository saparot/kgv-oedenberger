<?php

namespace App\Mixin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;

trait LinkListMixin {

    private function getLinkList (Request $request): array {
        $controller = $request->attributes->get('_controller');

        return $this->filterRoutes($controller);
    }

    /**
     * @param string $currentController
     *
     * @return Route[]
     */
    private function filterRoutes (string $currentController): array {
        $routes = [];
        foreach ($this->getRoutes() as $route) {
            if (preg_match("#/admin|/_#", $route->getPath())) {
                continue;
            }
            //group by first folder, group those together  which are in root
            $path = explode('/', $route->getPath());
            if ($path[0] === '/') {
                continue;
            }
            $group = count($path) == 2 ? '/' : $path[1];

            $routes[$group][] = [
                'url' => $route->getPath(),
                'isCurrent' => $route->getOption('compiler_class') == $currentController,
            ];
        }

        return $routes;
    }

    /**
     * @return Route[]
     */
    private function getRoutes (): array {
        return $this->get('router')->getRouteCollection()->all();
    }
}