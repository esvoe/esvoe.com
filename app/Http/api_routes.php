<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/





Route::resource('timelines', 'TimelineAPIController');

Route::resource('users', 'UserAPIController');
