<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::prefix('users')->name('admin.users.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\UserController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\UserController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\UserController@store']);
            Route::get('{user}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\UserController@show']);
            Route::get('{user}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\UserController@edit']);
            Route::put('{user}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\UserController@update']);
            Route::delete('{user}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\UserController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\UserController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\UserController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\UserController@purge']);
        });

        Route::prefix('tipo_users')->name('admin.tipo_users.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\TipoUserController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\TipoUserController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\TipoUserController@store']);
            Route::get('{tipo_user}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\TipoUserController@show']);
            Route::get('{tipo_user}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\TipoUserController@edit']);
            Route::put('{tipo_user}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\TipoUserController@update']);
            Route::delete('{tipo_user}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\TipoUserController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\TipoUserController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\TipoUserController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\TipoUserController@purge']);
        });

        Route::prefix('workplaces')->name('admin.workplaces.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\WorkplaceController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\WorkplaceController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\WorkplaceController@store']);
            Route::get('{workplace}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\WorkplaceController@show']);
            Route::get('{workplace}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\WorkplaceController@edit']);
            Route::put('{workplace}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\WorkplaceController@update']);
            Route::delete('{workplace}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\WorkplaceController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\WorkplaceController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\WorkplaceController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\WorkplaceController@purge']);
        });

        Route::prefix('quadros')->name('admin.quadros.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\QuadroController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\QuadroController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\QuadroController@store']);
            Route::get('{quadro}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\QuadroController@show']);
            Route::get('{quadro}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\QuadroController@edit']);
            Route::put('{quadro}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\QuadroController@update']);
            Route::delete('{quadro}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\QuadroController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\QuadroController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\QuadroController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\QuadroController@purge']);
        });

        Route::prefix('cartaos')->name('admin.cartaos.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\CartaoController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\CartaoController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\CartaoController@store']);
            Route::get('{cartao}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\CartaoController@show']);
            Route::get('{cartao}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\CartaoController@edit']);
            Route::put('{cartao}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\CartaoController@update']);
            Route::delete('{cartao}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\CartaoController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\CartaoController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\CartaoController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\CartaoController@purge']);
        });

        Route::prefix('anexos')->name('admin.anexos.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\AnexoController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\AnexoController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\AnexoController@store']);
            Route::get('{anexo}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\AnexoController@show']);
            Route::get('{anexo}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\AnexoController@edit']);
            Route::put('{anexo}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\AnexoController@update']);
            Route::delete('{anexo}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\AnexoController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\AnexoController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\AnexoController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\AnexoController@purge']);
        });

        Route::prefix('comentarios')->name('admin.comentarios.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\ComentarioController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\ComentarioController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\ComentarioController@store']);
            Route::get('{comentario}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\ComentarioController@show']);
            Route::get('{comentario}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\ComentarioController@edit']);
            Route::put('{comentario}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\ComentarioController@update']);
            Route::delete('{comentario}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\ComentarioController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\ComentarioController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\ComentarioController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\ComentarioController@purge']);
        });

        Route::prefix('membro_quadros')->name('admin.membro_quadros.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroController@store']);
            Route::get('{membro_quadro}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroController@show']);
            Route::get('{membro_quadro}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroController@edit']);
            Route::put('{membro_quadro}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroController@update']);
            Route::delete('{membro_quadro}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroController@purge']);
        });

        Route::prefix('chat_mensagens')->name('admin.chat_mensagens.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\ChatMensagemController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\ChatMensagemController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\ChatMensagemController@store']);
            Route::get('{chat_mensagem}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\ChatMensagemController@show']);
            Route::get('{chat_mensagem}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\ChatMensagemController@edit']);
            Route::put('{chat_mensagem}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\ChatMensagemController@update']);
            Route::delete('{chat_mensagem}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\ChatMensagemController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\ChatMensagemController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\ChatMensagemController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\ChatMensagemController@purge']);
        });

        Route::prefix('chat_anexos')->name('admin.chat_anexos.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\ChatAnexoController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\ChatAnexoController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\ChatAnexoController@store']);
            Route::get('{chat_anexo}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\ChatAnexoController@show']);
            Route::get('{chat_anexo}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\ChatAnexoController@edit']);
            Route::put('{chat_anexo}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\ChatAnexoController@update']);
            Route::delete('{chat_anexo}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\ChatAnexoController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\ChatAnexoController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\ChatAnexoController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\ChatAnexoController@purge']);
        });

        Route::prefix('membro_cartaos')->name('admin.membro_cartaos.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\MembroCartaoController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\MembroCartaoController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\MembroCartaoController@store']);
            Route::get('{membro_cartao}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\MembroCartaoController@show']);
            Route::get('{membro_cartao}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\MembroCartaoController@edit']);
            Route::put('{membro_cartao}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\MembroCartaoController@update']);
            Route::delete('{membro_cartao}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\MembroCartaoController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\MembroCartaoController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\MembroCartaoController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\MembroCartaoController@purge']);
        });

        Route::prefix('membro_workplaces')->name('admin.membro_workplaces.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceController@store']);
            Route::get('{membro_workplace}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceController@show']);
            Route::get('{membro_workplace}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceController@edit']);
            Route::put('{membro_workplace}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceController@update']);
            Route::delete('{membro_workplace}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceController@purge']);
        });

        Route::prefix('membro_quadro_convites')->name('admin.membro_quadro_convites.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroConviteController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroConviteController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroConviteController@store']);
            Route::get('{membro_quadro_convite}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroConviteController@show']);
            Route::get('{membro_quadro_convite}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroConviteController@edit']);
            Route::put('{membro_quadro_convite}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroConviteController@update']);
            Route::delete('{membro_quadro_convite}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroConviteController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroConviteController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroConviteController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\MembroQuadroConviteController@purge']);
        });

        Route::prefix('membro_workplace_convites')->name('admin.membro_workplace_convites.')->group(function () {
            Route::get('/', ['as' => 'index', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceConviteController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceConviteController@create']);
            Route::post('/', ['as' => 'store', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceConviteController@store']);
            Route::get('{membro_workplace_convite}', ['as' => 'show', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceConviteController@show']);
            Route::get('{membro_workplace_convite}/edit', ['as' => 'edit', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceConviteController@edit']);
            Route::put('{membro_workplace_convite}', ['as' => 'update', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceConviteController@update']);
            Route::delete('{membro_workplace_convite}', ['as' => 'destroy', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceConviteController@destroy']);
            Route::get('trash/list', ['as' => 'trash', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceConviteController@trash']);
            Route::post('{id}/restore', ['as' => 'restore', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceConviteController@restore']);
            Route::delete('{id}/purge', ['as' => 'purge', 'uses' => 'App\Http\Controllers\Admin\MembroWorkplaceConviteController@purge']);
        });

        Route::get('reports/users-pdf', [App\Http\Controllers\Admin\PdfController::class, 'usersPdf'])->name('admin.reports.users-pdf');
            Route::get('reports/workplaces-pdf', [App\Http\Controllers\Admin\PdfController::class, 'workplacesPdf'])->name('admin.reports.workplaces-pdf');
            Route::get('reports/quadros-pdf', [App\Http\Controllers\Admin\PdfController::class, 'quadrosPdf'])->name('admin.reports.quadros-pdf');
            Route::get('reports', function () {
                $tipos_user = App\Models\TipoUser::all();
                $workplaces = App\Models\Workplace::all();
                return Inertia::render('Admin/Reports/Index', [
                    'tipos_user' => $tipos_user,
                    'workplaces' => $workplaces,
                ]);
            })->name('admin.reports.index');
    });
});