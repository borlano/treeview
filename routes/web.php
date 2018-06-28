<?php




Route::get('/', 'IndexController@index')->name('workersTree');
Route::post('/brunch', 'IndexController@getBrunch')->name('getBrunch');

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/workers', function() {
        return view('admin.workers');
    })->name('listWorkers');
    Route::post('/', 'AdminController@index')->name('getWorkers');
    Route::get('/create', 'AdminController@create')->name('formCreateWorker');
    Route::post('/get_bosses', 'AdminController@getBosses')->name('getBosses');
    Route::post('/store', 'AdminController@store')->name('storeWorker');
    Route::post('/show', 'AdminController@show')->name('showWorker');
    Route::get('/{id}/edit', 'AdminController@edit')->name('formEditWorker');
    Route::put('/{id}/update', 'AdminController@update')->name('updateWorker');
    Route::get('/{id}/destroy', 'AdminController@destroy')->name('destroyWorker');

});