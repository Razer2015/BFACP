<?php

namespace BFACP\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use BFACP\Account\Permission;
use Illuminate\Support\Facades\Cache;

/**
 * Class ViewableChatlogs.
 */
class PermList
{
    /**
     * \Illuminate\Contracts\Foundation\Application.
     * @var object
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @internal param Request $request
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $adminPermsList = Cache::remember('admin.perm.list', 60 * 24, function () {
            $temp = [];
            $permissions = Permission::all();
            $permissions->each(function ($permission) use (&$temp) {
                $permName = (string) $permission->name;
                if (preg_match('/^admin\\.([a-z]+)/A', $permName, $matches)) {
                    $temp[$matches[1]][] = $permName;
                    $temp['_admin'][] = $permName;
                }
            });

            return $temp;
        });

        return $next($request);
    }
}