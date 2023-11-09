<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\FabricanteController;
use App\Http\Controllers\UnidadDeMedidaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard', [AuthController::class, 'mostrarMensaje'])->name('dashboard');
    Route::resource('/categorias', CategoriaController::class,)->names('categoria');
    Route::resource('/proveedores', ProveedorController::class,)->names('proveedor');
    Route::resource('/fabricantes', FabricanteController::class,)->names('fabricante');
    Route::resource('/unidad-de-medidas', UnidadDeMedidaController::class, )->names('unidad_de_medida');
    Route::resource('/roles',RoleController::class,)->names('roles');
    Route::resource('/permisos',PermisoController::class,)->names('permisos');
    Route::resource('/asignar',AsignarController::class,)->names('asignar');
    
});

Route::get('/auth/redirect', [AuthController::class, 'redirect']);
Route::get('/auth/callback-url', [AuthController::class, 'callback']);
/*

Route::get('/', [CartController::class, 'shop'])->name('shop');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/add', [CartController::class, 'add'])->name('cart.store');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');


*/
