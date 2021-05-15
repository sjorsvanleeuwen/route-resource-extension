<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\RouteResourceExtension;

use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;
use Illuminate\Routing\Route;

class ResourceRegistrar extends BaseResourceRegistrar
{
    protected $resourceSoftDeleteDefaults = ['index', 'trash', 'create', 'store', 'show', 'restore', 'edit', 'update', 'destroy'];

    protected $softDeletes = false;

    public function withSoftDeletes(): void
    {
        $this->softDeletes = true;
    }

    public function register($name, $controller, array $options = [])
    {
        if ($this->softDeletes) {
            $this->resourceDefaults = $this->resourceSoftDeleteDefaults;
        }

        return parent::register($name, $controller, $options);
    }

    protected function addResourceTrash($name, $base, $controller, $options): Route
    {
        $uri = $this->getResourceUri($name) . '/trash';

        $action = $this->getResourceAction($name, $controller, 'trash', $options);

        return $this->router->get($uri, $action);
    }

    protected function addResourceRestore($name, $base, $controller, $options): Route
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name).'/{'.$base.'}/restore';

        $action = $this->getResourceAction($name, $controller, 'restore', $options);

        return $this->router->patch($uri, $action);
    }
}
