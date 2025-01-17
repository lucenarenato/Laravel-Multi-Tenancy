<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\PedidoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['domain' => '{user:domain}.' . config('app.short_url'), 'as' => 'tenant.'], function () {
    Route::get('/', 'TenantController@show')->name('show');
});

Route::redirect('/', '/home');

Route::get('/clear-fix', function () {
    $this->middleware('auth');
    $exitCode = Artisan::call('key:generate');
    $exitCode = $exitCode == 0 ? Artisan::call('config:clear') : $exitCode;
    $exitCode = $exitCode == 0 ? Artisan::call('config:cache') : $exitCode;
    return $exitCode;
});

route::fallback(function () {
    echo 'A rota acessada nao existe. <a href="' . route('home') . '">cliqui aqui</a> para ir para pagina inicial';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/invitation/{user}', 'TenantController@invitation')->name('invitation');

Route::get('/password', 'Auth\PasswordController@create')->name('password.create');

Route::post('/password', 'Auth\PasswordController@store')->name('password.store');

Route::group(['as' => 'admin.', 'namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('tenants/{tenant}/suspend', 'TenantController@suspend')->name('tenants.suspend');

    Route::resource('tenants', 'TenantController');

    Route::resource('users', 'UserController');

    Route::resource('roles', 'RoleController');

    Route::resource('asset-groups', 'AssetGroupController');

    Route::resource('assets', 'AssetController');

    Route::post('images/media', 'ImageController@storeMedia')->name('images.storeMedia');

    Route::resource('images', 'ImageController');

    Route::post('documents/media', 'DocumentController@storeMedia')->name('documents.storeMedia');

    Route::resource('documents', 'DocumentController');

    Route::resource('notes', 'NoteController');

    Route::get('profile', 'ProfileController@edit')->name('profile.edit');

    Route::put('profile', 'ProfileController@update')->name('profile.update');

    Route::get('/emitir', function () {
        return view('emitir/index');
    });
    //Route::get('pedidos', [PedidoController::class, 'index']);
});
