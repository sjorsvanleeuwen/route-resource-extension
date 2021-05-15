<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\RouteResourceExtension;

use Illuminate\Routing\PendingResourceRegistration;
use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BaseResourceRegistrar::class, ResourceRegistrar::class);
    }

    public function boot(): void
    {
        PendingResourceRegistration::macro('withSoftDeletes', function (): void {
            $this->registrar->withSoftDeletes();
        });
    }
}
