<?php

use App\Http\Controllers\EditProfile;
use App\Http\Controllers\Users\Add;
use App\Http\Controllers\Users\addProfile;
use App\Http\Controllers\Users\editUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

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

Route::match(['get', 'post'], '/', function (Request $request) {
    if ($request->ip) {
        $ip = $request->ip;
        session(['ip' => $ip]);
    } else {
        return redirect('http://auth.thetechglitch.net');
    }

    return view('auth.login');
});

Route::match('get', '/login', function (Request $request) {
    if ($request->ip) {
        $ip = $request->ip;
        session(['ip' => $ip]);
    } else {
        return redirect('http://auth.thetechglitch.net');
    }

    return view('auth.login');
})->name('login');

Route::middleware(['auth:sanctum', 'verified', 'movie'])->get('/movie/play', [\App\Http\Controllers\MovieController::class, 'playMovie'])
    ->name('player');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [\App\Http\Controllers\Admin::class, 'index'])
    ->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/movie/packages', [\App\Http\Controllers\MovieController::class, 'showPackages'])
    ->name('movie-packages');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/users', [\App\Http\Controllers\Users::class, 'index'])
    ->name('Users');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/payments/clicks', function () {
    return view('payments.payment-clicks');
})->name('payment.clicks');

Route::middleware(['auth:sanctum', 'verified'])->get('/movies', [\App\Http\Controllers\MovieController::class, 'index'])
    ->name('movies');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/hotspot/users', [\App\Http\Controllers\Users::class, 'HotspotUsers'])
    ->name('hotspot-users');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/hotspot/user/edit/{username}', [\App\Http\Controllers\Users::class, 'EditHotspotUser'])
    ->name('hotspot-user-edit');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/hotspot/user/add', [\App\Http\Controllers\Users::class, 'AddHotspotUser'])
    ->name('hotspot-user-add');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/hotspot/user/activate/{username}', [\App\Http\Controllers\Users::class, 'ActivateHotspotUser'])
    ->name('hotspot-user-activate');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/hotspot/user/deactivate/{username}', [\App\Http\Controllers\Users::class, 'DeactivateHotspotUser'])
    ->name('hotspot-user-deactivate');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/hotspot/user/active', [\App\Http\Controllers\Users::class, 'HotspotActive'])
    ->name('hotspot-active');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/hotspot/user/active/remove/{id}', [\App\Http\Controllers\Controller::class, 'RemoveActive'])
    ->name('hotspot-remove-active');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/profiles', [\App\Http\Controllers\Profiles::class, 'index'])
    ->name('profiles');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/payments', [\App\Http\Controllers\Payment::class, 'index'])
    ->name('payments');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/marketing', [\App\Http\Controllers\Marketing::class, 'index'])
    ->name('marketing');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/active', [\App\Http\Controllers\activeUsers::class, 'index'])
    ->name('active');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/payment/record', function () {
    return view('payments.record-payment');
})->name('record-payment');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/user/active/remove/{id}', function ($id) {
    try {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);
    } catch (ConfigException $e) {
        dd('configuration error');
    }
    try {
        $client = new Client($config);
    } catch (ClientException $e) {
        dd($e);
    } catch (ConfigException $e) {
    } catch (QueryException $e) {
    }

    $query = (new Query('/ppp/active/remove'))
        ->equal('.id', $id);

    $client->q($query)->read();

    return redirect('/active');
});

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/profile/remove/{id}', function ($id) {
    try {
        $config = new Config([
            'host' => env('MIKROTIK_HOST'),
            'user' => env('MIKROTIK_USERNAME'),
            'pass' => env('MIKROTIK_PASSWORD'),
            'port' => (int)env('MIKROTIK_PORT'),
        ]);
    } catch (ConfigException $e) {
        dd('configuration error');
    }
    try {
        $client = new Client($config);
    } catch (ClientException $e) {
        dd($e);
    } catch (ConfigException $e) {
    } catch (QueryException $e) {
    }

    $query = (new Query('/ppp/profile/remove'))
        ->equal('.id', $id);

    $client->q($query)->read();

    return redirect('/profiles');
});

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/user/add', [Add::class, 'index'])
    ->name('add-user');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/profile/add', [AddProfile::class, 'index'])
    ->name('add-profile');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/profile/edit/{name}', [EditProfile::class, 'index'])
    ->name('edit-profile');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/user/edit/{name}', [EditUser::class, 'index'])
    ->name('edit-user');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/user/deactivate/{name}', [\App\Http\Controllers\Users\deactivate::class, 'index'])
    ->name('deactivate-user');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/user/activate/{name}', [\App\Http\Controllers\Users\activate::class, 'index'])
    ->name('activate-user');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/packages', [\App\Http\Controllers\Controller::class, 'ShowPackages'])
    ->name('packages');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/packages/add', [\App\Http\Controllers\Controller::class, 'AddPPPOEPackage'])
    ->name('packages-add');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/packages/edit/{id}', [\App\Http\Controllers\Controller::class, 'EditPPPOEPackage'])
    ->name('packages-edit');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/packages/delete/{id}', [\App\Http\Controllers\Controller::class, 'deletePPPOEPackage'])
    ->name('packages-delete');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/packages/hotspot', [\App\Http\Controllers\Controller::class, 'ShowHotspotPackages'])
    ->name('hotspot-packages');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/profiles/hotspot', [\App\Http\Controllers\Profiles::class, 'ShowHotspotProfiles'])
    ->name('hotspot-profiles');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/packages/hotspot/add', [\App\Http\Controllers\Controller::class, 'AddHotspotPackage'])
    ->name('packages-hotspot-add');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/packages/hotspot/edit/{id}', [\App\Http\Controllers\Controller::class, 'EditHotspotPackage'])
    ->name('packages-hotspot-edit');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/packages/hotspot/delete/{id}', [\App\Http\Controllers\Controller::class, 'DeleteHotspotPackage'])
    ->name('packages-hotspot-delete');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/hotspot/profile/add', [\App\Http\Controllers\Profiles::class, 'HotspotProfileAdd'])
    ->name('hotspot-profile-add');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/hotspot/profile/edit/{id}', [\App\Http\Controllers\Profiles::class, 'HotspotProfileEdit'])
    ->name('hotspot-profile-edit');

Route::middleware(['auth:sanctum', 'verified', 'admin'])->get('/hotspot/profile/remove/{id}', [\App\Http\Controllers\Profiles::class, 'HotspotProfileDelete'])
    ->name('hotspot-profile-delete');
