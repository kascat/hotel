<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/reservation', 'ReservationController@index')->name('reservation');
Route::post('/new_reservation', 'ReservationController@new')->name('new_reservation');

Route::resources([
    'hotels' => 'HotelController',
    'rooms' => 'RoomController'
]);

//  ____________________________________________________________________
// | Verb         | URI                    | Action    | Route Name     |
// |--------------|------------------------|-----------|----------------|
// | GET          | /photos                | index     | photos.index   |
// | GET          | /photos/create         | create    | photos.create  |
// | POST         | /photos                | store     | photos.store   |
// | GET          | /photos/{photo}        | show      | photos.show    |
// | GET          | /photos/{photo}/edit   | edit      | photos.edit    |
// | PUT/PATCH    | /photos/{photo}        | update    | photos.update  |
// | DELETE       | /photos/{photo}        | destroy   | photos.destroy |
// '--------------------------------------------------------------------'
