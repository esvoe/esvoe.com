<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials", "views" and "widgets"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these event can be override by package config.
    |
    */

    'events' => [

        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function ($theme) {
            // You can remove this line anytime.
            $theme->setTitle(Setting::get('site_name'));

            // Breadcrumb template.
            // $theme->breadcrumb()->setTemplate('
            //     <ul class="breadcrumb">
            //     @foreach ($crumbs as $i => $crumb)
            //         @if ($i != (count($crumbs) - 1))
            //         <li><a href="{{ $crumb["url"] }}">{{ $crumb["label"] }}</a><span class="divider">/</span></li>
            //         @else
            //         <li class="active">{{ $crumb["label"] }}</li>
            //         @endif
            //     @endforeach
            //     </ul>
            // ');
        },

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function ($theme) {
            $theme->asset()->add('style', mix('themes/default/assets/js/main.js', ''));
        },

        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => [

            'default' => function ($theme) {
                // $theme->asset()->usePath()->add('bootstrap', 'css/bootstrap.min.css');
                $theme->asset()->add('style', mix('themes/default/assets/css/style.css', ''));
            },

            'admin' => function ($theme) {
                // $theme->asset()->usePath()->add('bootstrap', 'css/bootstrap.min.css');
                $theme->asset()->add('style', mix('themes/default/assets/css/style.css', ''));
            },

            'guest' => function ($theme) {
                // $theme->asset()->usePath()->add('bootstrap', 'css/bootstrap.min.css');
                $theme->asset()->add('style', mix('themes/default/assets/css/style.css', ''));
            },

            'share' => function ($theme) {
                // $theme->asset()->usePath()->add('bootstrap', 'css/bootstrap.min.css');
                $theme->asset()->add('style', mix('themes/default/assets/css/style.css', ''));
            },

        ],

    ],

];
