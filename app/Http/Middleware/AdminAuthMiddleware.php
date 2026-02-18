<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('admin_user_id')) {
            return redirect()->route('admin.login')
                             ->with('error', 'Please login to access the admin panel.');
        }

        // Inject admin user into view
        $adminUser = \App\Models\AdminUser::find(Session::get('admin_user_id'));
        if (!$adminUser || !$adminUser->is_active) {
            Session::forget(['admin_user_id', 'admin_user_name', 'admin_user_role']);
            return redirect()->route('admin.login')
                             ->with('error', 'Your account has been deactivated.');
        }

        // Share with all admin views
        view()->share('authAdmin', $adminUser);

        return $next($request);
    }
}
