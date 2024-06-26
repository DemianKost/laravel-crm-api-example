<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    public const HOME = '/home';

    /**
     * @return void
     */
    public function boot(): void
    {
        RateLimiter::for('api', fn (Request $request) => 
            /** @phpstan-ignore-next-line */
            Limit::perMinute(60)->by($request->user()?->id ?: $request->ip())
        );

        $this->routes(function () {
            foreach ( $this->centralDomains() as $domain ) {
                Route::prefix('api')
                    ->domain($domain)
                    ->middleware([
                        'api',
                        // InitializeTenancyByDomain::class,
                        // PreventAccessFromCentralDomains::class,
                    ])
                    ->as('api:')
                    ->group(base_path('routes/api.php'));

                Route::middleware('web')
                    ->domain($domain)
                    ->group(base_path('routes/web.php'));
            }
        });
    }

    /**
     * @return array
     */
    protected function centralDomains(): array
    {
        return config(key: 'tenancy.central_domains');
    }
}
