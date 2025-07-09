<?php

if (!function_exists('isMenuActive')) {
    function isMenuActive($menu) {
        if (!count($menu->subitems)) {
            return request()->is($menu->ruta) ? 'active' : '';
        }

        foreach ($menu->subitems as $sub) {
            if (request()->is($sub->ruta)) {
                return 'active pcoded-trigger';
            }
        }

        return '';
    }
}

if (!function_exists('img64')) {
    function img64($image)
    {
        return str_starts_with($image, 'data:') ? $image : asset($image);
    }
}
