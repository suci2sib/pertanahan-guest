<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('auth.index')
                ->with('error', 'Silakan login terlebih dahulu!');
        }

        $userRole = Auth::user()->role;
        
        // SUPER ADMIN bisa akses SEMUA
        if ($userRole === 'Super Admin') {
            return $next($request);
        }
        
        // ADMIN bisa akses semua KECUALI 'Super Admin' routes
        if ($userRole === 'Admin') {
            // Admin TIDAK bisa akses route yang khusus Super Admin
            if ($role === 'Super Admin') {
                return redirect()->route('dashboard.index')
                    ->with('error', 'Akses ditolak! Hanya Super Admin yang bisa mengakses.');
            }
            return $next($request);
        }
        
        // USER hanya bisa akses dashboard/profile
        if ($userRole === 'User') {
            // User hanya bisa akses route 'User' (dashboard, profile)
            if ($role === 'User') {
                return $next($request);
            }
            
            // Jika coba akses admin/super admin routes
            return redirect()->route('dashboard.index')
                ->with('error', 'Akses ditolak! Anda hanya memiliki akses terbatas.');
        }
        
        // Untuk backward compatibility dengan role 'Pengunjung'
        if ($userRole === 'Pengunjung') {
            if ($role === 'Pengunjung') {
                return $next($request);
            }
            return redirect()->route('dashboard.index')
                ->with('error', 'Akses ditolak!');
        }
        
        return abort(403, 'Akses ditolak! Role Anda: ' . $userRole);
    }
}