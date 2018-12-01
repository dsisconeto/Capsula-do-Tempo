<?php

  
    Route::get('/', "HomeController@index")->name("home");
    Route::get('pesquisar', "HomeController@pesquisar")->name("pesquisar");
    Route::post('/faleconosco', "FaleConosco@sendEmail")->name("faleconosco.send");
    Route::get('/email-enviado', "FaleConosco@confirmado")->name("faleconosco.enviado");

    Route::get('/estatuto', "EstatutoController@index")->name("estatuto");
    Route::get('/eventos', "EventoController@index")->name("eventos");
    Route::get('/evento/{slug}/{id}', "EventoController@show")->name("evento");


// ADMIN

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => "Admin"], function () {

    Route::get('/', 'HomeController@index');

    Route::group(["prefix" => "informacoe",], function () {
        Route::get('/', 'InformacoeController@index')->name('admin.informacoes');
        Route::put('sobre', 'InformacoeController@sobre')->name('admin.informacoes.sobre');
    });

    Route::group(["prefix" => "slides"], function () {

        Route::get("/", "SlideController@index")->name("admin.slides.index");
        Route::post("/", "SlideController@store")->name("admin.slides.store");
        Route::delete("/{id}", "SlideController@destroy")->name("admin.slides.destroy");
    });

    Route::group(['prefix' => 'estatutos'], function () {

        Route::get('/', 'EstatutoController@index')->name('admin.estatuto.index');
        Route::post('/', 'EstatutoController@store')->name('admin.estatuto.store');
        Route::delete('/', 'EstatutoController@destroy')->name('admin.estatuto.destroy');

    });


    // EVENTO
    Route::group(['prefix' => 'evento', 'namespace' => 'Evento'], function () {

        Route::get('/', 'EventoController@index')->name('admin.evento.index');
        Route::get('/novo', 'EventoController@create')->name('admin.evento.create');
        Route::post('/', 'EventoController@store')->name('admin.evento.store');

        Route::get('/{id}/edit', 'EventoController@edit')->name('admin.evento.edit');
        Route::put('/{id}', 'EventoController@update')->name('admin.evento.update');
        Route::put('/{id}/status', 'EventoController@updateStatus')->name('admin.evento.status');
        Route::delete('/{id}', 'EventoController@destroy')->name('admin.evento.destroy');


        Route::group(['prefix' => 'capa'], function () {

            Route::get('/{id}', 'CapaController@edit')->name('admin.evento.capa.edit')->where('id', '[0-9]+');
            Route::put('/{id}', 'CapaController@update')->name('admin.evento.capa.update')->where('id', '[0-9]+');


        });

        Route::group(['prefix' => 'galerias'], function () {

            Route::get('/{id}/edit', 'GaleriaController@edit')->name('admin.evento.galeria.edit')->where('id', '[0-9]+');
            Route::put('/{id}', 'GaleriaController@update')->name('admin.evento.galeria.update')->where('id', '[0-9]+');
            Route::delete('/{id}', 'GaleriaController@destroy')->name('admin.evento.galeria.destroy')->where('id', '[0-9]+');
        });


    });

});

Auth::routes();
