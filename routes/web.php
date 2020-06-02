<?php

use App\Models\Purchase;
use App\Models\Sale;
use Carbon\Carbon;

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
// Auth::routes(['register' => false,'reset'=>false]);


Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@authenticate')->name('login');

Route::group(['middleware' => ['auth','logout']], function () {
    Route::get('/', function () {
        $sales = Sale::where('user_id',auth()->id())->where('date',Carbon::now()->format('Y-m-d'));
        $quantitySales = $sales->count();
        $amountSales = $sales->sum('total');
        $purchases = Purchase::where('user_id',auth()->id())->where('date',Carbon::now()->format('Y-m-d'));
        $quantityPurchases = $purchases->count();
        $amountPurchases = $purchases->sum('total');
        return view('home', compact('quantitySales','amountSales','quantityPurchases','amountPurchases'));
    });

    Route::post('logout','Auth\LoginController@logout')->name('logout');
    Route::get('/inicio', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'administracion'], function(){
        /**
         * USUARIOS
         */
        Route::get('usuarios',['as'=>'users.index', 'uses' => 'User\UserController@index'])->middleware('can:index,App\Models\User');
        Route::post('usuarios',['as'=>'users.store', 'uses' => 'User\UserController@store'])->middleware('can:store,App\Models\User');
        Route::get('usuarios/{user}/edit',['as'=>'users.edit', 'uses' => 'User\UserController@edit'])->middleware('can:update,App\Models\User');
        Route::get('usuarios/{user}',['as'=>'users.show', 'uses' => 'User\UserController@show'])->middleware('can:show,App\Models\User');
        Route::put('usuarios/{user}',['as'=>'users.update', 'uses'=>'User\UserController@update'])->middleware('can:update,App\Models\User');
        Route::delete('usuarios/{user}',['as'=>'users.destroy', 'uses' => 'User\UserController@destroy'])->middleware('can:destroy,App\Models\User');
        Route::get('cambiar-contraseña',['as'=>'users.change-password-view','uses'=> 'User\UserController@changePasswordView']);
        Route::post('usuarios/cambiar-contraseña',['as'=>'users.change-password','uses'=> 'User\UserController@changePassword']);
        Route::get('perfil',['as' => 'users.profile','uses'=> 'User\UserController@profile']);
        /**
         * ROLES
         */
        Route::get('roles/listar',['as'=>'roles.index', 'uses' => 'Role\RoleController@index'])->middleware('can:index,App\Models\Role');
        Route::get('roles/crear',['as'=>'roles.create', 'uses' => 'Role\RoleController@create'])->middleware('can:store,App\Models\Role');
        Route::post('roles',['as'=>'roles.store', 'uses' => 'Role\RoleController@store'])->middleware('can:store,App\Models\Role');
        Route::get('roles/{role}',['as'=>'roles.show', 'uses' => 'Role\RoleController@show'])->middleware('can:show,App\Models\Role');
        Route::get('roles/listar/{role}/edit',['as'=>'roles.edit', 'uses' => 'Role\RoleController@edit'])->middleware('can:update,App\Models\Role');
        Route::put('roles/{role}',['as'=>'roles.update', 'uses'=>'Role\RoleController@update'])->middleware('can:update,App\Models\Role');
        Route::delete('roles/{role}',['as'=>'roles.destroy', 'uses' => 'Role\RoleController@destroy'])->middleware('can:destroy,App\Models\Role');


        /**
         * CARGOS
         */
        Route::get('cargos',['as'=>'companies-positions.index','uses'=>'CompanyPosition\CompanyPositionController@index'])->middleware('can:index,App\Models\User');
        Route::post('cargos',['as'=>'companies-positions.store', 'uses' => 'CompanyPosition\CompanyPositionController@store'])->middleware('can:store,App\Models\User');
        Route::get('cargos/{companies_position}',['as'=>'companies-positions.show', 'uses' => 'CompanyPosition\CompanyPositionController@show'])->middleware('can:show,App\Models\User');
        Route::get('cargos/{companies_position}/edit',['as'=>'companies-positions.edit', 'uses' => 'CompanyPosition\CompanyPositionController@edit'])->middleware('can:update,App\Models\User');
        Route::put('cargos/{companies_position}',['as'=>'companies-positions.update', 'uses'=>'CompanyPosition\CompanyPositionController@update'])->middleware('can:update,App\Models\User');
        Route::delete('cargos/{companies_position}',['as'=>'companies-positions.destroy', 'uses' => 'CompanyPosition\CompanyPositionController@destroy'])->middleware('can:destroy,App\Models\User');
    });
    
    /**
     * PRODUCTOS
     */
    Route::get('productos', ['as'=>'products.index','uses'=>'Product\ProductController@index'])->middleware('can:index,App\Models\Product');
    Route::post('productos',['as'=>'products.store', 'uses' => 'Product\ProductController@store'])->middleware('can:store,App\Models\Product');
//    Route::get('productos/{product}',['as'=>'products.show', 'uses' => 'Product\ProductController@show'])->middleware('can:show,App\Models\Product');
    Route::get('productos/{product}/edit',['as'=>'products.edit', 'uses' => 'Product\ProductController@edit'])->middleware('can:update,App\Models\Product');
    Route::put('productos/{product}',['as'=>'products.update', 'uses'=>'Product\ProductController@update'])->middleware('can:update,App\Models\Product');
    Route::delete('productos/{product}',['as'=>'products.destroy', 'uses' => 'Product\ProductController@destroy'])->middleware('can:destroy,App\Models\Product');

    /**
     * COMPRAS
     */
    Route::get('compras/listar', ['as'=>'purchases.index','uses'=>'Purchase\PurchaseController@index'])->middleware('can:index,App\Models\Purchase');
    Route::get('compras/crear',['as'=>'purchases.create', 'uses' => 'Purchase\PurchaseController@create'])->middleware('can:store,App\Models\Purchase');
    Route::post('compras',['as'=>'purchases.store', 'uses' => 'Purchase\PurchaseController@store'])->middleware('can:store,App\Models\Purchase');
    Route::get('compras/{purchase}',['as'=>'purchases.show', 'uses' => 'Purchase\PurchaseController@show'])->middleware('can:show,App\Models\Purchase');
    Route::get('compras/listar/{purchase}/edit',['as'=>'purchases.edit', 'uses' => 'Purchase\PurchaseController@edit'])->middleware('can:update,App\Models\Purchase');
    Route::put('compras/{purchase}',['as'=>'purchases.update', 'uses'=>'Purchase\PurchaseController@update'])->middleware('can:update,App\Models\Purchase');
    Route::delete('compras/{purchase}',['as'=>'purchases.destroy', 'uses' => 'Purchase\PurchaseController@destroy'])->middleware('can:update,App\Models\Purchase');

    /**
     * VENTAS
     */
    Route::get('ventas/listar', ['as'=>'sales.index','uses'=>'Sale\SaleController@index'])->middleware('can:index,App\Models\Sale');
    Route::get('ventas/crear',['as'=>'sales.create', 'uses' => 'Sale\SaleController@create'])->middleware('can:store,App\Models\Sale');
    Route::post('ventas',['as'=>'sales.store', 'uses' => 'Sale\SaleController@store'])->middleware('can:store,App\Models\Sale');
    Route::get('ventas/{sale}',['as'=>'sales.show', 'uses' => 'Sale\SaleController@show'])->middleware('can:show,App\Models\Sale');
    Route::get('ventas/listar/{sale}/edit',['as'=>'sales.edit', 'uses' => 'Sale\SaleController@edit'])->middleware('can:update,App\Models\Sale');
    Route::put('ventas/{sale}',['as'=>'sales.update', 'uses'=>'Sale\SaleController@update'])->middleware('can:update,App\Models\Sale');
    Route::delete('ventas/{sale}',['as'=>'sales.destroy', 'uses' => 'Sale\SaleController@destroy'])->middleware('can:destroy,App\Models\Sale');
    Route::get('ventas/{sale}/recibo',['as'=>'sales.getSale','uses'=> 'Sale\SaleController@getSale']);
    /**
     * ENTRADAS Y SALIDAS
     */
    Route::get('entradas-salidas', ['as'=>'inputs-outputs.index','uses'=>'InputOutput\InputOutputController@index']);
    Route::get('entradas-salidas/crear',['as'=>'inputs-outputs.create', 'uses' => 'InputOutput\InputOutputController@create']);
    Route::post('entradas-salidas',['as'=>'inputs-outputs.store', 'uses' => 'InputOutput\InputOutputController@store']);
    Route::get('entradas-salidas/{inputs_output}',['as'=>'inputs-outputs.show', 'uses' => 'InputOutput\InputOutputController@show']);
    Route::put('entradas-salidas/{inputs_output}',['as'=>'inputs-outputs.update', 'uses'=>'InputOutput\InputOutputController@update']);
    Route::delete('entradas-salidas/{inputs_output}',['as'=>'inputs-outputs.destroy', 'uses' => 'InputOutput\InputOutputController@destroy']);
    
    /**
     * KARDEX
     */
    Route::get('kardexs',['as'=>'kardexs.index','uses'=>'Kardex\KardexController@index']);
    Route::get('kardexs-month',['as'=>'kardexs.getMonth','uses'=>'Kardex\KardexController@getMonth']);
    Route::get('kardexs-products',['as'=>'kardexs.getProducts','uses'=>'Kardex\KardexController@getProducts']);
    
    
    /**
     * REPORTES
     */
    Route::get('reportes/ventas',['as'=>'reports.sales','uses'=>'Report\ReportController@sales']);
    Route::post('reportes/ventas-por-productos',['as'=>'reports.sales.products','uses'=>'Report\SaleReportController@getSaleForProducts']);
    
    Route::get('reportes/compras',['as'=>'reports.purchases','uses'=>'Report\ReportController@purchases']);
    Route::post('reportes/compras-por-productos',['as'=>'reports.purchases.products','uses'=>'Report\PurchaseReportController@getPurchaseForProducts']);
});