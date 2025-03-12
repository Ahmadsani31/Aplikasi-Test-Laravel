<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class SidebarProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $user = Auth::user();
            $sidebarLinks = [
                [
                    'title' => 'Dashboard',
                    'route' => 'dashboard',
                    'icon' => 'fa-gauge',
                    'roles' => ['admin', 'staf'], // Hanya admin & user yang bisa melihat ini
                ],
                [
                    'title' => 'Master Data',
                    'is_caption' => true,
                    'icon' => 'line-chart',
                    'roles' => ['admin'],
                ],

                [
                    'title' => 'Master',
                    'icon' => 'fa-arrow-right-arrow-left',
                    'roles' => ['admin', 'staf'],
                    'submenu' => [
                        ['title' => 'Kategori', 'route' => 'kategori', 'roles' => ['admin', 'staf']],
                        ['title' => 'Sub Kategori', 'route' => 'sub-kategori', 'roles' => ['admin', 'staf']],
                    ],
                ],
                [
                    'title' => 'Comparison',
                    'is_caption' => true,
                    'icon' => 'line-chart',
                    'roles' => ['admin', 'staf'],
                ],
                [
                    'title' => 'Text Comparison',
                    'route' => 'text-comparisons',
                    'icon' => 'fa-font',
                    'roles' => ['admin', 'staf'],
                ],
                [
                    'title' => 'BMI Calculator',
                    'is_caption' => true,
                    'icon' => 'line-chart',
                    'roles' => ['admin', 'staf'],
                ],
                [
                    'title' => 'BMI',
                    'route' => 'bmi',
                    'icon' => 'fa-calculator',
                    'roles' => ['admin', 'staf'],
                ],
                [
                    'title' => 'User',
                    'is_caption' => true,
                    'icon' => 'line-chart',
                    'roles' => ['admin'],
                ],
                [
                    'title' => 'Users',
                    'route' => 'user',
                    'icon' => 'fa-user',
                    'roles' => ['admin'],
                ],
                [
                    'title' => 'Role',
                    'route' => 'role',
                    'icon' => 'fa-gear',
                    'roles' => ['admin'],
                ],
                [
                    'title' => 'Permission',
                    'route' => 'permission',
                    'icon' => 'fa-gear',
                    'roles' => ['admin'],
                ],
            ];

            if ($user) {

                $sidebarLinks = array_filter($sidebarLinks, function ($link) use ($user) {
                    return isset($link['roles']) && $user->hasAnyRole($link['roles']);
                });


                // Filter submenu juga
                foreach ($sidebarLinks as &$link) {
                    if (isset($link['submenu'])) {
                        $link['submenu'] = array_filter($link['submenu'], function ($submenu) use ($user) {
                            return isset($submenu['roles']) && $user->hasAnyRole($submenu['roles']);
                        });

                        // Jika submenu kosong setelah filter, hapus item utama
                        if (empty($link['submenu'])) {
                            unset($link['submenu']);
                        }
                    }
                }
            }
            $view->with('sidebarLinks', $sidebarLinks);
        });
    }
}
