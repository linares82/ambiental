<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(
[
    'prefix' => 'roles',
    'middleware'=>'role:superadmin',
], function () {

    Route::get('/', 'RolesController@index')
         ->name('roles.role.index');

    Route::get('/create','RolesController@create')
         ->name('roles.role.create');

    Route::get('/show/{role}','RolesController@show')
         ->name('roles.role.show')
         ->where('id', '[0-9]+');

    Route::get('/{role}/edit','RolesController@edit')
         ->name('roles.role.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'RolesController@store')
         ->name('roles.role.store');
               
    Route::put('role/{role}', 'RolesController@update')
         ->name('roles.role.update')
         ->where('id', '[0-9]+');

    Route::delete('/role/{role}','RolesController@destroy')
         ->name('roles.role.destroy')
         ->where('id', '[0-9]+');

    Route::get('/addPermission','RolesController@addPermission')
     ->name('roles.role.addPermission');

    Route::get('/lessPermission','RolesController@lessPermission')
     ->name('roles.role.lessPermission');
    
    Route::get('/addUser','RolesController@addUser')
     ->name('roles.role.addUser');

    Route::get('/lessUser','RolesController@lessUser')
     ->name('roles.role.lessUser');
    
    Route::get('/addGroup','RolesController@addGroup')
     ->name('roles.role.addGroup');

    Route::get('/lessGroup','RolesController@lessGroup')
     ->name('roles.role.lessGroup');

});

Route::group(
[
    'prefix' => 'permissions',
    'middleware'=>'role:superadmin',
], function () {

    Route::get('/', 'PermissionsController@index')
         ->name('permissions.permission.index');

    Route::get('/create','PermissionsController@create')
         ->name('permissions.permission.create');

    Route::get('/show/{permission}','PermissionsController@show')
         ->name('permissions.permission.show')
         ->where('id', '[0-9]+');

    Route::get('/{permission}/edit','PermissionsController@edit')
         ->name('permissions.permission.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PermissionsController@store')
         ->name('permissions.permission.store');
               
    Route::put('permission/{permission}', 'PermissionsController@update')
         ->name('permissions.permission.update')
         ->where('id', '[0-9]+');

    Route::delete('/permission/{permission}','PermissionsController@destroy')
         ->name('permissions.permission.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'permission_groups',
    'middleware'=>'role:superadmin',
], function () {

    Route::get('/', 'PermissionGroupsController@index')
         ->name('permission_groups.permission_group.index');

    Route::get('/create','PermissionGroupsController@create')
         ->name('permission_groups.permission_group.create');

    Route::get('/show/{permissionGroup}','PermissionGroupsController@show')
         ->name('permission_groups.permission_group.show')
         ->where('id', '[0-9]+');

    Route::get('/{permissionGroup}/edit','PermissionGroupsController@edit')
         ->name('permission_groups.permission_group.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PermissionGroupsController@store')
         ->name('permission_groups.permission_group.store');
               
    Route::put('permission_group/{permissionGroup}', 'PermissionGroupsController@update')
         ->name('permission_groups.permission_group.update')
         ->where('id', '[0-9]+');

    Route::delete('/permission_group/{permissionGroup}','PermissionGroupsController@destroy')
         ->name('permission_groups.permission_group.destroy')
         ->where('id', '[0-9]+');
    
    Route::get('/addPermission','PermissionGroupsController@addPermission')
         ->name('permission_groups.permission_group.addPermission');
    
    Route::get('/lessPermission','PermissionGroupsController@lessPermission')
         ->name('permission_groups.permission_group.lessPermission');
    
    Route::get('/addRole','PermissionGroupsController@addRole')
         ->name('permission_groups.permission_group.addRole');
    
    Route::get('/lessRole','PermissionGroupsController@lessRole')
         ->name('permission_groups.permission_group.lessRole');

});

Route::group(
[
    'prefix' => 'menus',
    'middleware'=>'role:superadmin',
], function () {

    Route::get('/', 'MenusController@index')
         ->name('menus.menu.index');

    Route::get('/create','MenusController@create')
         ->name('menus.menu.create');

    Route::get('/show/{menu}','MenusController@show')
         ->name('menus.menu.show')
         ->where('id', '[0-9]+');

    Route::get('/{menu}/edit','MenusController@edit')
         ->name('menus.menu.edit')
         ->where('id', '[0-9]+');
    
    Route::get('/clasesMenu','MenusController@clasesMenu')
         ->name('menus.menu.clases')
         ->where('id', '[0-9]+');

    Route::post('/', 'MenusController@store')
         ->name('menus.menu.store');
               
    Route::put('menu/{menu}', 'MenusController@update')
         ->name('menus.menu.update')
         ->where('id', '[0-9]+');

    Route::delete('/menu/{menu}','MenusController@destroy')
         ->name('menus.menu.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'users',
], function () {

    Route::get('/', [
        'uses'=>'UsersController@index',
        'middleware'=>'permission:users.user.index',
        'as'=>'users.user.index'
    ])->middleware('auth');
         
    Route::get('/create',[
        'uses'=>'UsersController@create',
        'middleware'=>'permission:users.user.create',
        'as'=>'users.user.create'
    ])->middleware('auth');

    Route::get('/show/{user}',[
        'uses'=>'UsersController@show',
        'middleware'=>'permission:users.user.show',
        'as'=>'users.user.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{user}/edit',[
        'uses'=>'UsersController@edit',
        'middleware'=>'permission:users.user.edit',
        'as'=>'users.user.edit'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    Route::get('/{user}/editPerfil',[
        'uses'=>'UsersController@editPerfil',
        'middleware'=>'permission:users.user.editPerfil',
        'as'=>'users.user.editPerfil'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'UsersController@store',
        'middleware'=>'permission:users.user.store',
        'as'=>'users.user.store'
    ])->middleware('auth');
               
    Route::post('user/{user}', [
        'uses'=>'UsersController@update',
        'middleware'=>'permission:users.user.update',
        'as'=>'users.user.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/user/{user}',[
        'uses'=>'UsersController@destroy',
        'middleware'=>'permission:users.user.destroy',
        'as'=>'users.user.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/addRol',[
        'uses'=>'UsersController@addRol',
        'middleware'=>'permission:users.user.addRol',
        'as'=>'users.user.addRol'
    ])->middleware('auth');
    
    Route::get('/lessRol',[
        'uses'=>'UsersController@lessRol',
        'middleware'=>'permission:users.user.lessRol',
        'as'=>'users.user.lessRol'
    ])->middleware('auth');
});

Route::group(
[
    'prefix' => 'entities',
], function () {

    Route::get('/', [
        'uses'=>'EntitiesController@index',
        'middleware'=>'permission:entities.entity.index',
        'as'=>'entities.entity.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'EntitiesController@create',
        'middleware'=> 'permission:entities.entity.create',
        'as'=>'entities.entity.create'
    ])->middleware('auth');

    Route::get('/show/{entity}',[
        'uses'=>'EntitiesController@show',
        'middleware'=>'permission:entities.entity.show',
        'as'=>'entities.entity.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{entity}/edit',[
        'uses'=>'EntitiesController@edit',
        'middleware'=>'permission:entities.entity.edit',
        'as'=>'entities.entity.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'EntitiesController@store',
        'middleware'=>'permission:entities.entity.store',
        'as'=>'entities.entity.store'
    ])->middleware('auth');
    
    Route::post('/cargaArchivo', [
        'uses'=>'EntitiesController@cargaArchivo',
        //'middleware'=>'permission:entities.entity.cargaArchivo',
        'as'=>'entities.entity.cargaArchivo'
    ])->middleware('auth');
               
    Route::put('entity/{entity}', [
        'uses'=>'EntitiesController@update',
        'middleware'=>'permission:entities.entity.update',
        'as'=>'entities.entity.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/entity/{entity}',[
        'uses'=>'EntitiesController@destroy',
        'middleware'=>'permission:entities.entity.destroy',
        'as'=>'entities.entity.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'puestos',
], function () {

    Route::get('/', [
        'uses'=>'PuestosController@index',
        'middleware'=>'permission:puestos.puesto.index',
        'as'=>'puestos.puesto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'PuestosController@create',
        'middleware'=> 'permission:puestos.puesto.create',
        'as'=>'puestos.puesto.create',
    ])->middleware('auth');

    Route::get('/show/{puesto}',[
        'uses'=>'PuestosController@show',
        'middleware'=>'permission:puestos.puesto.show',
        'as'=>'puestos.puesto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{puesto}/edit',[
        'uses'=>'PuestosController@edit',
        'middleware'=>'permission:puestos.puesto.edit',
        'as'=>'puestos.puesto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'PuestosController@store',
        'middleware'=>'permission:puestos.puesto.store',
        'as'=>'puestos.puesto.store'
    ])->middleware('auth');
               
    Route::put('puesto/{puesto}', [
        'uses'=>'PuestosController@update',
        'middleware'=>'permission:puestos.puesto.update',
        'as'=>'puestos.puesto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/puesto/{puesto}',[
        'uses'=>'PuestosController@destroy',
        'middleware'=>'permission:puestos.puesto.destroy',
        'as'=>'puestos.puesto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'empleados',
], function () {

    Route::get('/', [
        'uses'=>'EmpleadosController@index',
        'middleware'=>'permission:empleados.empleado.index',
        'as'=>'empleados.empleado.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'EmpleadosController@create',
        'middleware'=> 'permission:empleados.empleado.create',
        'as'=>'empleados.empleado.create'
    ])->middleware('auth');

    Route::get('/show/{empleado}',[
        'uses'=>'EmpleadosController@show',
        'middleware'=>'permission:empleados.empleado.show',
        'as'=>'empleados.empleado.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{empleado}/edit',[
        'uses'=>'EmpleadosController@edit',
        'middleware'=>'permission:empleados.empleado.edit',
        'as'=>'empleados.empleado.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'EmpleadosController@store',
        'middleware'=>'permission:empleados.empleado.store',
        'as'=>'empleados.empleado.store'
    ])->middleware('auth');
               
    Route::put('empleado/{empleado}', [
        'uses'=>'EmpleadosController@update',
        'middleware'=>'permission:empleados.empleado.update',
        'as'=>'empleados.empleado.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/empleado/{empleado}',[
        'uses'=>'EmpleadosController@destroy',
        'middleware'=>'permission:empleados.empleado.destroy',
        'as'=>'empleados.empleado.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'areas',
], function () {

    Route::get('/', [
        'uses'=>'AreasController@index',
        'middleware'=>'permission:areas.area.index',
        'as'=>'areas.area.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AreasController@create',
        'middleware'=> 'permission:areas.area.create',
        'as'=>'areas.area.create'
    ])->middleware('auth');

    Route::get('/show/{area}',[
        'uses'=>'AreasController@show',
        'middleware'=>'permission:areas.area.show',
        'as'=>'areas.area.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{area}/edit',[
        'uses'=>'AreasController@edit',
        'middleware'=>'permission:areas.area.edit',
        'as'=>'areas.area.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AreasController@store',
        'middleware'=>'permission:areas.area.store',
        'as'=>'areas.area.store'
    ])->middleware('auth');
               
    Route::put('area/{area}', [
        'uses'=>'AreasController@update',
        'middleware'=>'permission:areas.area.update',
        'as'=>'areas.area.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/area/{area}',[
        'uses'=>'AreasController@destroy',
        'middleware'=>'permission:areas.area.destroy',
        'as'=>'areas.area.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'bnds',
], function () {

    Route::get('/', [
        'uses'=>'BndsController@index',
        'middleware'=>'permission:bnds.bnd.index',
        'as'=>'bnds.bnd.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'BndsController@create',
        'middleware'=> 'permission:bnds.bnd.create',
        'as'=>'bnds.bnd.create'
    ])->middleware('auth');

    Route::get('/show/{bnd}',[
        'uses'=>'BndsController@show',
        'middleware'=>'permission:bnds.bnd.show',
        'as'=>'bnds.bnd.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{bnd}/edit',[
        'uses'=>'BndsController@edit',
        'middleware'=>'permission:bnds.bnd.edit',
        'as'=>'bnds.bnd.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'BndsController@store',
        'middleware'=>'permission:bnds.bnd.store',
        'as'=>'bnds.bnd.store'
    ])->middleware('auth');
               
    Route::put('bnd/{bnd}', [
        'uses'=>'BndsController@update',
        'middleware'=>'permission:bnds.bnd.update',
        'as'=>'bnds.bnd.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/bnd/{bnd}',[
        'uses'=>'BndsController@destroy',
        'middleware'=>'permission:bnds.bnd.destroy',
        'as'=>'bnds.bnd.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'clientes',
], function () {

    Route::get('/', [
        'uses'=>'ClientesController@index',
        'middleware'=>'permission:clientes.cliente.index',
        'as'=>'clientes.cliente.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ClientesController@create',
        'middleware'=> 'permission:clientes.cliente.create',
        'as'=>'clientes.cliente.create'
    ])->middleware('auth');

    Route::get('/show/{cliente}',[
        'uses'=>'ClientesController@show',
        'middleware'=>'permission:clientes.cliente.show',
        'as'=>'clientes.cliente.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{cliente}/edit',[
        'uses'=>'ClientesController@edit',
        'middleware'=>'permission:clientes.cliente.edit',
        'as'=>'clientes.cliente.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ClientesController@store',
        'middleware'=>'permission:clientes.cliente.store',
        'as'=>'clientes.cliente.store'
    ])->middleware('auth');
               
    Route::put('cliente/{cliente}', [
        'uses'=>'ClientesController@update',
        'middleware'=>'permission:clientes.cliente.update',
        'as'=>'clientes.cliente.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cliente/{cliente}',[
        'uses'=>'ClientesController@destroy',
        'middleware'=>'permission:clientes.cliente.destroy',
        'as'=>'clientes.cliente.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'factors',
], function () {

    Route::get('/', [
        'uses'=>'FactorsController@index',
        'middleware'=>'permission:factors.factor.index',
        'as'=>'factors.factor.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'FactorsController@create',
        'middleware'=> 'permission:factors.factor.create',
        'as'=>'factors.factor.create'
    ])->middleware('auth');

    Route::get('/show/{factor}',[
        'uses'=>'FactorsController@show',
        'middleware'=>'permission:factors.factor.show',
        'as'=>'factors.factor.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{factor}/edit',[
        'uses'=>'FactorsController@edit',
        'middleware'=>'permission:factors.factor.edit',
        'as'=>'factors.factor.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'FactorsController@store',
        'middleware'=>'permission:factors.factor.store',
        'as'=>'factors.factor.store'
    ])->middleware('auth');
               
    Route::put('factor/{factor}', [
        'uses'=>'FactorsController@update',
        'middleware'=>'permission:factors.factor.update',
        'as'=>'factors.factor.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/factor/{factor}',[
        'uses'=>'FactorsController@destroy',
        'middleware'=>'permission:factors.factor.destroy',
        'as'=>'factors.factor.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'rubros',
], function () {

    Route::get('/', [
        'uses'=>'RubrosController@index',
        'middleware'=>'permission:rubros.rubro.index',
        'as'=>'rubros.rubro.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'RubrosController@create',
        'middleware'=> 'permission:rubros.rubro.create',
        'as'=>'rubros.rubro.create'
    ])->middleware('auth');

    Route::get('/show/{rubro}',[
        'uses'=>'RubrosController@show',
        'middleware'=>'permission:rubros.rubro.show',
        'as'=>'rubros.rubro.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{rubro}/edit',[
        'uses'=>'RubrosController@edit',
        'middleware'=>'permission:rubros.rubro.edit',
        'as'=>'rubros.rubro.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'RubrosController@store',
        'middleware'=>'permission:rubros.rubro.store',
        'as'=>'rubros.rubro.store'
    ])->middleware('auth');
               
    Route::put('rubro/{rubro}', [
        'uses'=>'RubrosController@update',
        'middleware'=>'permission:rubros.rubro.update',
        'as'=>'rubros.rubro.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/rubro/{rubro}',[
        'uses'=>'RubrosController@destroy',
        'middleware'=>'permission:rubros.rubro.destroy',
        'as'=>'rubros.rubro.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'especificos',
], function () {

    Route::get('/', [
        'uses'=>'EspecificosController@index',
        'middleware'=>'permission:especificos.especifico.index',
        'as'=>'especificos.especifico.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'EspecificosController@create',
        'middleware'=> 'permission:especificos.especifico.create',
        'as'=>'especificos.especifico.create'
    ])->middleware('auth');

    Route::get('/show/{especifico}',[
        'uses'=>'EspecificosController@show',
        'middleware'=>'permission:especificos.especifico.show',
        'as'=>'especificos.especifico.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{especifico}/edit',[
        'uses'=>'EspecificosController@edit',
        'middleware'=>'permission:especificos.especifico.edit',
        'as'=>'especificos.especifico.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'EspecificosController@store',
        'middleware'=>'permission:especificos.especifico.store',
        'as'=>'especificos.especifico.store'
    ])->middleware('auth');
               
    Route::put('especifico/{especifico}', [
        'uses'=>'EspecificosController@update',
        'middleware'=>'permission:especificos.especifico.update',
        'as'=>'especificos.especifico.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/especifico/{especifico}',[
        'uses'=>'EspecificosController@destroy',
        'middleware'=>'permission:especificos.especifico.destroy',
        'as'=>'especificos.especifico.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'caracteristicas',
], function () {

    Route::get('/', [
        'uses'=>'CaracteristicasController@index',
        'middleware'=>'permission:caracteristicas.caracteristica.index',
        'as'=>'caracteristicas.caracteristica.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaracteristicasController@create',
        'middleware'=> 'permission:caracteristicas.caracteristica.create',
        'as'=>'caracteristicas.caracteristica.create'
    ])->middleware('auth');

    Route::get('/show/{caracteristica}',[
        'uses'=>'CaracteristicasController@show',
        'middleware'=>'permission:caracteristicas.caracteristica.show',
        'as'=>'caracteristicas.caracteristica.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caracteristica}/edit',[
        'uses'=>'CaracteristicasController@edit',
        'middleware'=>'permission:caracteristicas.caracteristica.edit',
        'as'=>'caracteristicas.caracteristica.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaracteristicasController@store',
        'middleware'=>'permission:caracteristicas.caracteristica.store',
        'as'=>'caracteristicas.caracteristica.store'
    ])->middleware('auth');
               
    Route::put('caracteristica/{caracteristica}', [
        'uses'=>'CaracteristicasController@update',
        'middleware'=>'permission:caracteristicas.caracteristica.update',
        'as'=>'caracteristicas.caracteristica.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/caracteristica/{caracteristica}',[
        'uses'=>'CaracteristicasController@destroy',
        'middleware'=>'permission:caracteristicas.caracteristica.destroy',
        'as'=>'caracteristicas.caracteristica.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'tipo_impactos',
], function () {

    Route::get('/', [
        'uses'=>'TipoImpactosController@index',
        'middleware'=>'permission:tipo_impactos.tipo_impacto.index',
        'as'=>'tipo_impactos.tipo_impacto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'TipoImpactosController@create',
        'middleware'=> 'permission:tipo_impactos.tipo_impacto.create',
        'as'=>'tipo_impactos.tipo_impacto.create'
    ])->middleware('auth');

    Route::get('/show/{tipoImpacto}',[
        'uses'=>'TipoImpactosController@show',
        'middleware'=>'permission:tipo_impactos.tipo_impacto.show',
        'as'=>'tipo_impactos.tipo_impacto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{tipoImpacto}/edit',[
        'uses'=>'TipoImpactosController@edit',
        'middleware'=>'permission:tipo_impactos.tipo_impacto.edit',
        'as'=>'tipo_impactos.tipo_impacto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'TipoImpactosController@store',
        'middleware'=>'permission:tipo_impactos.tipo_impacto.store',
        'as'=>'tipo_impactos.tipo_impacto.store'
    ])->middleware('auth');
               
    Route::put('tipo_impacto/{tipoImpacto}', [
        'uses'=>'TipoImpactosController@update',
        'middleware'=>'permission:tipo_impactos.tipo_impacto.update',
        'as'=>'tipo_impactos.tipo_impacto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/tipo_impacto/{tipoImpacto}',[
        'uses'=>'TipoImpactosController@destroy',
        'middleware'=>'permission:tipo_impactos.tipo_impacto.destroy',
        'as'=>'tipo_impactos.tipo_impacto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'matrizs',
], function () {

    Route::get('/', [
        'uses'=>'MatrizsController@index',
        'middleware'=>'permission:matrizs.matriz.index',
        'as'=>'matrizs.matriz.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'MatrizsController@create',
        'middleware'=> 'permission:matrizs.matriz.create',
        'as'=>'matrizs.matriz.create'
    ])->middleware('auth');

    Route::get('/show/{matriz}',[
        'uses'=>'MatrizsController@show',
        'middleware'=>'permission:matrizs.matriz.show',
        'as'=>'matrizs.matriz.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{matriz}/edit',[
        'uses'=>'MatrizsController@edit',
        'middleware'=>'permission:matrizs.matriz.edit',
        'as'=>'matrizs.matriz.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'MatrizsController@store',
        'middleware'=>'permission:matrizs.matriz.store',
        'as'=>'matrizs.matriz.store'
    ])->middleware('auth');
               
    Route::put('matriz/{matriz}', [
        'uses'=>'MatrizsController@update',
        'middleware'=>'permission:matrizs.matriz.update',
        'as'=>'matrizs.matriz.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/matriz/{matriz}',[
        'uses'=>'MatrizsController@destroy',
        'middleware'=>'permission:matrizs.matriz.destroy',
        'as'=>'matrizs.matriz.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'efectos',
], function () {

    Route::get('/', [
        'uses'=>'EfectosController@index',
        'middleware'=>'permission:efectos.efecto.index',
        'as'=>'efectos.efecto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'EfectosController@create',
        'middleware'=> 'permission:efectos.efecto.create',
        'as'=>'efectos.efecto.create'
    ])->middleware('auth');

    Route::get('/show/{efecto}',[
        'uses'=>'EfectosController@show',
        'middleware'=>'permission:efectos.efecto.show',
        'as'=>'efectos.efecto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{efecto}/edit',[
        'uses'=>'EfectosController@edit',
        'middleware'=>'permission:efectos.efecto.edit',
        'as'=>'efectos.efecto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'EfectosController@store',
        'middleware'=>'permission:efectos.efecto.store',
        'as'=>'efectos.efecto.store'
    ])->middleware('auth');
               
    Route::put('efecto/{efecto}', [
        'uses'=>'EfectosController@update',
        'middleware'=>'permission:efectos.efecto.update',
        'as'=>'efectos.efecto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/efecto/{efecto}',[
        'uses'=>'EfectosController@destroy',
        'middleware'=>'permission:efectos.efecto.destroy',
        'as'=>'efectos.efecto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'sms',
], function () {

    Route::get('/', [
        'uses'=>'SmsController@index',
        'middleware'=>'permission:sms.sm.index',
        'as'=>'sms.sm.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'SmsController@create',
        'middleware'=> 'permission:sms.sm.create',
        'as'=>'sms.sm.create'
    ])->middleware('auth');

    Route::get('/show/{sm}',[
        'uses'=>'SmsController@show',
        'middleware'=>'permission:sms.sm.show',
        'as'=>'sms.sm.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{sm}/edit',[
        'uses'=>'SmsController@edit',
        'middleware'=>'permission:sms.sm.edit',
        'as'=>'sms.sm.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'SmsController@store',
        'middleware'=>'permission:sms.sm.store',
        'as'=>'sms.sm.store'
    ])->middleware('auth');
               
    Route::put('sm/{sm}', [
        'uses'=>'SmsController@update',
        'middleware'=>'permission:sms.sm.update',
        'as'=>'sms.sm.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/sm/{sm}',[
        'uses'=>'SmsController@destroy',
        'middleware'=>'permission:sms.sm.destroy',
        'as'=>'sms.sm.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'achecks',
], function () {

    Route::get('/', [
        'uses'=>'AchecksController@index',
        'middleware'=>'permission:achecks.acheck.index',
        'as'=>'achecks.acheck.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AchecksController@create',
        'middleware'=> 'permission:achecks.acheck.create',
        'as'=>'achecks.acheck.create'
    ])->middleware('auth');

    Route::get('/show/{acheck}',[
        'uses'=>'AchecksController@show',
        'middleware'=>'permission:achecks.acheck.show',
        'as'=>'achecks.acheck.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{acheck}/edit',[
        'uses'=>'AchecksController@edit',
        'middleware'=>'permission:achecks.acheck.edit',
        'as'=>'achecks.acheck.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AchecksController@store',
        'middleware'=>'permission:achecks.acheck.store',
        'as'=>'achecks.acheck.store'
    ])->middleware('auth');
               
    Route::put('acheck/{acheck}', [
        'uses'=>'AchecksController@update',
        'middleware'=>'permission:achecks.acheck.update',
        'as'=>'achecks.acheck.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/acheck/{acheck}',[
        'uses'=>'AchecksController@destroy',
        'middleware'=>'permission:achecks.acheck.destroy',
        'as'=>'achecks.acheck.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'normas',
], function () {

    Route::get('/', [
        'uses'=>'NormasController@index',
        'middleware'=>'permission:normas.norma.index',
        'as'=>'normas.norma.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'NormasController@create',
        'middleware'=> 'permission:normas.norma.create',
        'as'=>'normas.norma.create'
    ])->middleware('auth');

    Route::get('/show/{norma}',[
        'uses'=>'NormasController@show',
        'middleware'=>'permission:normas.norma.show',
        'as'=>'normas.norma.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{norma}/edit',[
        'uses'=>'NormasController@edit',
        'middleware'=>'permission:normas.norma.edit',
        'as'=>'normas.norma.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'NormasController@store',
        'middleware'=>'permission:normas.norma.store',
        'as'=>'normas.norma.store'
    ])->middleware('auth');
               
    Route::put('norma/{norma}', [
        'uses'=>'NormasController@update',
        'middleware'=>'permission:normas.norma.update',
        'as'=>'normas.norma.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/norma/{norma}',[
        'uses'=>'NormasController@destroy',
        'middleware'=>'permission:normas.norma.destroy',
        'as'=>'normas.norma.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'mchecks',
], function () {

    Route::get('/', [
        'uses'=>'MchecksController@index',
        'middleware'=>'permission:mchecks.mcheck.index',
        'as'=>'mchecks.mcheck.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'MchecksController@create',
        'middleware'=> 'permission:mchecks.mcheck.create',
        'as'=>'mchecks.mcheck.create'
    ])->middleware('auth');

    Route::get('/show/{mcheck}',[
        'uses'=>'MchecksController@show',
        'middleware'=>'permission:mchecks.mcheck.show',
        'as'=>'mchecks.mcheck.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{mcheck}/edit',[
        'uses'=>'MchecksController@edit',
        'middleware'=>'permission:mchecks.mcheck.edit',
        'as'=>'mchecks.mcheck.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'MchecksController@store',
        'middleware'=>'permission:mchecks.mcheck.store',
        'as'=>'mchecks.mcheck.store'
    ])->middleware('auth');
               
    Route::put('mcheck/{mcheck}', [
        'uses'=>'MchecksController@update',
        'middleware'=>'permission:mchecks.mcheck.update',
        'as'=>'mchecks.mcheck.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/mcheck/{mcheck}',[
        'uses'=>'MchecksController@destroy',
        'middleware'=>'permission:mchecks.mcheck.destroy',
        'as'=>'mchecks.mcheck.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ca_ca_docs',
], function () {

    Route::get('/', [
        'uses'=>'CaCaDocsController@index',
        'middleware'=>'permission:ca_ca_docs.ca_ca_doc.index',
        'as'=>'ca_ca_docs.ca_ca_doc.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaCaDocsController@create',
        'middleware'=> 'permission:ca_ca_docs.ca_ca_doc.create',
        'as'=>'ca_ca_docs.ca_ca_doc.create'
    ])->middleware('auth');

    Route::get('/show/{caCaDoc}',[
        'uses'=>'CaCaDocsController@show',
        'middleware'=>'permission:ca_ca_docs.ca_ca_doc.show',
        'as'=>'ca_ca_docs.ca_ca_doc.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caCaDoc}/edit',[
        'uses'=>'CaCaDocsController@edit',
        'middleware'=>'permission:ca_ca_docs.ca_ca_doc.edit',
        'as'=>'ca_ca_docs.ca_ca_doc.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaCaDocsController@store',
        'middleware'=>'permission:ca_ca_docs.ca_ca_doc.store',
        'as'=>'ca_ca_docs.ca_ca_doc.store'
    ])->middleware('auth');
               
    Route::put('ca_ca_doc/{caCaDoc}', [
        'uses'=>'CaCaDocsController@update',
        'middleware'=>'permission:ca_ca_docs.ca_ca_doc.update',
        'as'=>'ca_ca_docs.ca_ca_doc.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ca_ca_doc/{caCaDoc}',[
        'uses'=>'CaCaDocsController@destroy',
        'middleware'=>'permission:ca_ca_docs.ca_ca_doc.destroy',
        'as'=>'ca_ca_docs.ca_ca_doc.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ca_procedimientos',
], function () {

    Route::get('/', [
        'uses'=>'CaProcedimientosController@index',
        'middleware'=>'permission:ca_procedimientos.ca_procedimiento.index',
        'as'=>'ca_procedimientos.ca_procedimiento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaProcedimientosController@create',
        'middleware'=> 'permission:ca_procedimientos.ca_procedimiento.create',
        'as'=>'ca_procedimientos.ca_procedimiento.create'
    ])->middleware('auth');

    Route::get('/show/{caProcedimiento}',[
        'uses'=>'CaProcedimientosController@show',
        'middleware'=>'permission:ca_procedimientos.ca_procedimiento.show',
        'as'=>'ca_procedimientos.ca_procedimiento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caProcedimiento}/edit',[
        'uses'=>'CaProcedimientosController@edit',
        'middleware'=>'permission:ca_procedimientos.ca_procedimiento.edit',
        'as'=>'ca_procedimientos.ca_procedimiento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaProcedimientosController@store',
        'middleware'=>'permission:ca_procedimientos.ca_procedimiento.store',
        'as'=>'ca_procedimientos.ca_procedimiento.store'
    ])->middleware('auth');
               
    Route::put('ca_procedimiento/{caProcedimiento}', [
        'uses'=>'CaProcedimientosController@update',
        'middleware'=>'permission:ca_procedimientos.ca_procedimiento.update',
        'as'=>'ca_procedimientos.ca_procedimiento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ca_procedimiento/{caProcedimiento}',[
        'uses'=>'CaProcedimientosController@destroy',
        'middleware'=>'permission:ca_procedimientos.ca_procedimiento.destroy',
        'as'=>'ca_procedimientos.ca_procedimiento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ca_materials',
], function () {

    Route::get('/', [
        'uses'=>'CaMaterialsController@index',
        'middleware'=>'permission:ca_materials.ca_material.index',
        'as'=>'ca_materials.ca_material.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaMaterialsController@create',
        'middleware'=> 'permission:ca_materials.ca_material.create',
        'as'=>'ca_materials.ca_material.create'
    ])->middleware('auth');

    Route::get('/show/{caMaterial}',[
        'uses'=>'CaMaterialsController@show',
        'middleware'=>'permission:ca_materials.ca_material.show',
        'as'=>'ca_materials.ca_material.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caMaterial}/edit',[
        'uses'=>'CaMaterialsController@edit',
        'middleware'=>'permission:ca_materials.ca_material.edit',
        'as'=>'ca_materials.ca_material.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaMaterialsController@store',
        'middleware'=>'permission:ca_materials.ca_material.store',
        'as'=>'ca_materials.ca_material.store'
    ])->middleware('auth');
               
    Route::put('ca_material/{caMaterial}', [
        'uses'=>'CaMaterialsController@update',
        'middleware'=>'permission:ca_materials.ca_material.update',
        'as'=>'ca_materials.ca_material.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ca_material/{caMaterial}',[
        'uses'=>'CaMaterialsController@destroy',
        'middleware'=>'permission:ca_materials.ca_material.destroy',
        'as'=>'ca_materials.ca_material.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ca_categorias',
], function () {

    Route::get('/', [
        'uses'=>'CaCategoriasController@index',
        'middleware'=>'permission:ca_categorias.ca_categoria.index',
        'as'=>'ca_categorias.ca_categoria.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaCategoriasController@create',
        'middleware'=> 'permission:ca_categorias.ca_categoria.create',
        'as'=>'ca_categorias.ca_categoria.create'
    ])->middleware('auth');

    Route::get('/show/{caCategoria}',[
        'uses'=>'CaCategoriasController@show',
        'middleware'=>'permission:ca_categorias.ca_categoria.show',
        'as'=>'ca_categorias.ca_categoria.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caCategoria}/edit',[
        'uses'=>'CaCategoriasController@edit',
        'middleware'=>'permission:ca_categorias.ca_categoria.edit',
        'as'=>'ca_categorias.ca_categoria.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaCategoriasController@store',
        'middleware'=>'permission:ca_categorias.ca_categoria.store',
        'as'=>'ca_categorias.ca_categoria.store'
    ])->middleware('auth');
               
    Route::put('ca_categoria/{caCategoria}', [
        'uses'=>'CaCategoriasController@update',
        'middleware'=>'permission:ca_categorias.ca_categoria.update',
        'as'=>'ca_categorias.ca_categoria.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ca_categoria/{caCategoria}',[
        'uses'=>'CaCategoriasController@destroy',
        'middleware'=>'permission:ca_categorias.ca_categoria.destroy',
        'as'=>'ca_categorias.ca_categoria.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ca_aa_docs',
], function () {

    Route::get('/', [
        'uses'=>'CaAaDocsController@index',
        'middleware'=>'permission:ca_aa_docs.ca_aa_doc.index',
        'as'=>'ca_aa_docs.ca_aa_doc.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaAaDocsController@create',
        'middleware'=> 'permission:ca_aa_docs.ca_aa_doc.create',
        'as'=>'ca_aa_docs.ca_aa_doc.create'
    ])->middleware('auth');

    Route::get('/show/{caAaDoc}',[
        'uses'=>'CaAaDocsController@show',
        'middleware'=>'permission:ca_aa_docs.ca_aa_doc.show',
        'as'=>'ca_aa_docs.ca_aa_doc.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caAaDoc}/edit',[
        'uses'=>'CaAaDocsController@edit',
        'middleware'=>'permission:ca_aa_docs.ca_aa_doc.edit',
        'as'=>'ca_aa_docs.ca_aa_doc.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaAaDocsController@store',
        'middleware'=>'permission:ca_aa_docs.ca_aa_doc.store',
        'as'=>'ca_aa_docs.ca_aa_doc.store'
    ])->middleware('auth');
               
    Route::put('ca_aa_doc/{caAaDoc}', [
        'uses'=>'CaAaDocsController@update',
        'middleware'=>'permission:ca_aa_docs.ca_aa_doc.update',
        'as'=>'ca_aa_docs.ca_aa_doc.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ca_aa_doc/{caAaDoc}',[
        'uses'=>'CaAaDocsController@destroy',
        'middleware'=>'permission:ca_aa_docs.ca_aa_doc.destroy',
        'as'=>'ca_aa_docs.ca_aa_doc.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ca_fuentes_fijas',
], function () {

    Route::get('/', [
        'uses'=>'CaFuentesFijasController@index',
        'middleware'=>'permission:ca_fuentes_fijas.ca_fuentes_fija.index',
        'as'=>'ca_fuentes_fijas.ca_fuentes_fija.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaFuentesFijasController@create',
        'middleware'=> 'permission:ca_fuentes_fijas.ca_fuentes_fija.create',
        'as'=>'ca_fuentes_fijas.ca_fuentes_fija.create'
    ])->middleware('auth');

    Route::get('/show/{caFuentesFija}',[
        'uses'=>'CaFuentesFijasController@show',
        'middleware'=>'permission:ca_fuentes_fijas.ca_fuentes_fija.show',
        'as'=>'ca_fuentes_fijas.ca_fuentes_fija.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caFuentesFija}/edit',[
        'uses'=>'CaFuentesFijasController@edit',
        'middleware'=>'permission:ca_fuentes_fijas.ca_fuentes_fija.edit',
        'as'=>'ca_fuentes_fijas.ca_fuentes_fija.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaFuentesFijasController@store',
        'middleware'=>'permission:ca_fuentes_fijas.ca_fuentes_fija.store',
        'as'=>'ca_fuentes_fijas.ca_fuentes_fija.store'
    ])->middleware('auth');
               
    Route::put('ca_fuentes_fija/{caFuentesFija}', [
        'uses'=>'CaFuentesFijasController@update',
        'middleware'=>'permission:ca_fuentes_fijas.ca_fuentes_fija.update',
        'as'=>'ca_fuentes_fijas.ca_fuentes_fija.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ca_fuentes_fija/{caFuentesFija}',[
        'uses'=>'CaFuentesFijasController@destroy',
        'middleware'=>'permission:ca_fuentes_fijas.ca_fuentes_fija.destroy',
        'as'=>'ca_fuentes_fijas.ca_fuentes_fija.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ca_plantas',
], function () {

    Route::get('/', [
        'uses'=>'CaPlantasController@index',
        'middleware'=>'permission:ca_plantas.ca_planta.index',
        'as'=>'ca_plantas.ca_planta.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaPlantasController@create',
        'middleware'=> 'permission:ca_plantas.ca_planta.create',
        'as'=>'ca_plantas.ca_planta.create'
    ])->middleware('auth');

    Route::get('/show/{caPlanta}',[
        'uses'=>'CaPlantasController@show',
        'middleware'=>'permission:ca_plantas.ca_planta.show',
        'as'=>'ca_plantas.ca_planta.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caPlanta}/edit',[
        'uses'=>'CaPlantasController@edit',
        'middleware'=>'permission:ca_plantas.ca_planta.edit',
        'as'=>'ca_plantas.ca_planta.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaPlantasController@store',
        'middleware'=>'permission:ca_plantas.ca_planta.store',
        'as'=>'ca_plantas.ca_planta.store'
    ])->middleware('auth');
               
    Route::put('ca_planta/{caPlanta}', [
        'uses'=>'CaPlantasController@update',
        'middleware'=>'permission:ca_plantas.ca_planta.update',
        'as'=>'ca_plantas.ca_planta.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ca_planta/{caPlanta}',[
        'uses'=>'CaPlantasController@destroy',
        'middleware'=>'permission:ca_plantas.ca_planta.destroy',
        'as'=>'ca_plantas.ca_planta.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ca_residuos',
], function () {

    Route::get('/', [
        'uses'=>'CaResiduosController@index',
        'middleware'=>'permission:ca_residuos.ca_residuo.index',
        'as'=>'ca_residuos.ca_residuo.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaResiduosController@create',
        'middleware'=> 'permission:ca_residuos.ca_residuo.create',
        'as'=>'ca_residuos.ca_residuo.create'
    ])->middleware('auth');

    Route::get('/show/{caResiduo}',[
        'uses'=>'CaResiduosController@show',
        'middleware'=>'permission:ca_residuos.ca_residuo.show',
        'as'=>'ca_residuos.ca_residuo.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caResiduo}/edit',[
        'uses'=>'CaResiduosController@edit',
        'middleware'=>'permission:ca_residuos.ca_residuo.edit',
        'as'=>'ca_residuos.ca_residuo.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaResiduosController@store',
        'middleware'=>'permission:ca_residuos.ca_residuo.store',
        'as'=>'ca_residuos.ca_residuo.store'
    ])->middleware('auth');
               
    Route::put('ca_residuo/{caResiduo}', [
        'uses'=>'CaResiduosController@update',
        'middleware'=>'permission:ca_residuos.ca_residuo.update',
        'as'=>'ca_residuos.ca_residuo.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ca_residuo/{caResiduo}',[
        'uses'=>'CaResiduosController@destroy',
        'middleware'=>'permission:ca_residuos.ca_residuo.destroy',
        'as'=>'ca_residuos.ca_residuo.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ca_consumibles',
], function () {

    Route::get('/', [
        'uses'=>'CaConsumiblesController@index',
        'middleware'=>'permission:ca_consumibles.ca_consumible.index',
        'as'=>'ca_consumibles.ca_consumible.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaConsumiblesController@create',
        'middleware'=> 'permission:ca_consumibles.ca_consumible.create',
        'as'=>'ca_consumibles.ca_consumible.create'
    ])->middleware('auth');

    Route::get('/show/{caConsumible}',[
        'uses'=>'CaConsumiblesController@show',
        'middleware'=>'permission:ca_consumibles.ca_consumible.show',
        'as'=>'ca_consumibles.ca_consumible.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caConsumible}/edit',[
        'uses'=>'CaConsumiblesController@edit',
        'middleware'=>'permission:ca_consumibles.ca_consumible.edit',
        'as'=>'ca_consumibles.ca_consumible.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaConsumiblesController@store',
        'middleware'=>'permission:ca_consumibles.ca_consumible.store',
        'as'=>'ca_consumibles.ca_consumible.store'
    ])->middleware('auth');
               
    Route::put('ca_consumible/{caConsumible}', [
        'uses'=>'CaConsumiblesController@update',
        'middleware'=>'permission:ca_consumibles.ca_consumible.update',
        'as'=>'ca_consumibles.ca_consumible.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ca_consumible/{caConsumible}',[
        'uses'=>'CaConsumiblesController@destroy',
        'middleware'=>'permission:ca_consumibles.ca_consumible.destroy',
        'as'=>'ca_consumibles.ca_consumible.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ca_tpo_inconformidads',
], function () {

    Route::get('/', [
        'uses'=>'CaTpoInconformidadsController@index',
        'middleware'=>'permission:ca_tpo_inconformidads.ca_tpo_inconformidad.index',
        'as'=>'ca_tpo_inconformidads.ca_tpo_inconformidad.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaTpoInconformidadsController@create',
        'middleware'=> 'permission:ca_tpo_inconformidads.ca_tpo_inconformidad.create',
        'as'=>'ca_tpo_inconformidads.ca_tpo_inconformidad.create'
    ])->middleware('auth');

    Route::get('/show/{caTpoInconformidad}',[
        'uses'=>'CaTpoInconformidadsController@show',
        'middleware'=>'permission:ca_tpo_inconformidads.ca_tpo_inconformidad.show',
        'as'=>'ca_tpo_inconformidads.ca_tpo_inconformidad.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caTpoInconformidad}/edit',[
        'uses'=>'CaTpoInconformidadsController@edit',
        'middleware'=>'permission:ca_tpo_inconformidads.ca_tpo_inconformidad.edit',
        'as'=>'ca_tpo_inconformidads.ca_tpo_inconformidad.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaTpoInconformidadsController@store',
        'middleware'=>'permission:ca_tpo_inconformidads.ca_tpo_inconformidad.store',
        'as'=>'ca_tpo_inconformidads.ca_tpo_inconformidad.store'
    ])->middleware('auth');
               
    Route::put('ca_tpo_inconformidad/{caTpoInconformidad}', [
        'uses'=>'CaTpoInconformidadsController@update',
        'middleware'=>'permission:ca_tpo_inconformidads.ca_tpo_inconformidad.update',
        'as'=>'ca_tpo_inconformidads.ca_tpo_inconformidad.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ca_tpo_inconformidad/{caTpoInconformidad}',[
        'uses'=>'CaTpoInconformidadsController@destroy',
        'middleware'=>'permission:ca_tpo_inconformidads.ca_tpo_inconformidad.destroy',
        'as'=>'ca_tpo_inconformidads.ca_tpo_inconformidad.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ca_tpo_bitacoras',
], function () {

    Route::get('/', [
        'uses'=>'CaTpoBitacorasController@index',
        'middleware'=>'permission:ca_tpo_bitacoras.ca_tpo_bitacora.index',
        'as'=>'ca_tpo_bitacoras.ca_tpo_bitacora.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaTpoBitacorasController@create',
        'middleware'=> 'permission:ca_tpo_bitacoras.ca_tpo_bitacora.create',
        'as'=>'ca_tpo_bitacoras.ca_tpo_bitacora.create'
    ])->middleware('auth');

    Route::get('/show/{caTpoBitacora}',[
        'uses'=>'CaTpoBitacorasController@show',
        'middleware'=>'permission:ca_tpo_bitacoras.ca_tpo_bitacora.show',
        'as'=>'ca_tpo_bitacoras.ca_tpo_bitacora.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caTpoBitacora}/edit',[
        'uses'=>'CaTpoBitacorasController@edit',
        'middleware'=>'permission:ca_tpo_bitacoras.ca_tpo_bitacora.edit',
        'as'=>'ca_tpo_bitacoras.ca_tpo_bitacora.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaTpoBitacorasController@store',
        'middleware'=>'permission:ca_tpo_bitacoras.ca_tpo_bitacora.store',
        'as'=>'ca_tpo_bitacoras.ca_tpo_bitacora.store'
    ])->middleware('auth');
               
    Route::put('ca_tpo_bitacora/{caTpoBitacora}', [
        'uses'=>'CaTpoBitacorasController@update',
        'middleware'=>'permission:ca_tpo_bitacoras.ca_tpo_bitacora.update',
        'as'=>'ca_tpo_bitacoras.ca_tpo_bitacora.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ca_tpo_bitacora/{caTpoBitacora}',[
        'uses'=>'CaTpoBitacorasController@destroy',
        'middleware'=>'permission:ca_tpo_bitacoras.ca_tpo_bitacora.destroy',
        'as'=>'ca_tpo_bitacoras.ca_tpo_bitacora.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ca_tpo_no_conformidads',
], function () {

    Route::get('/', [
        'uses'=>'CaTpoNoConformidadsController@index',
        'middleware'=>'permission:ca_tpo_no_conformidads.ca_tpo_no_conformidad.index',
        'as'=>'ca_tpo_no_conformidads.ca_tpo_no_conformidad.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CaTpoNoConformidadsController@create',
        'middleware'=> 'permission:ca_tpo_no_conformidads.ca_tpo_no_conformidad.create',
        'as'=>'ca_tpo_no_conformidads.ca_tpo_no_conformidad.create'
    ])->middleware('auth');

    Route::get('/show/{caTpoNoConformidad}',[
        'uses'=>'CaTpoNoConformidadsController@show',
        'middleware'=>'permission:ca_tpo_no_conformidads.ca_tpo_no_conformidad.show',
        'as'=>'ca_tpo_no_conformidads.ca_tpo_no_conformidad.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{caTpoNoConformidad}/edit',[
        'uses'=>'CaTpoNoConformidadsController@edit',
        'middleware'=>'permission:ca_tpo_no_conformidads.ca_tpo_no_conformidad.edit',
        'as'=>'ca_tpo_no_conformidads.ca_tpo_no_conformidad.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CaTpoNoConformidadsController@store',
        'middleware'=>'permission:ca_tpo_no_conformidads.ca_tpo_no_conformidad.store',
        'as'=>'ca_tpo_no_conformidads.ca_tpo_no_conformidad.store'
    ])->middleware('auth');
               
    Route::put('ca_tpo_no_conformidad/{caTpoNoConformidad}', [
        'uses'=>'CaTpoNoConformidadsController@update',
        'middleware'=>'permission:ca_tpo_no_conformidads.ca_tpo_no_conformidad.update',
        'as'=>'ca_tpo_no_conformidads.ca_tpo_no_conformidad.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ca_tpo_no_conformidad/{caTpoNoConformidad}',[
        'uses'=>'CaTpoNoConformidadsController@destroy',
        'middleware'=>'permission:ca_tpo_no_conformidads.ca_tpo_no_conformidad.destroy',
        'as'=>'ca_tpo_no_conformidads.ca_tpo_no_conformidad.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'cs_tpo_procedimientos',
], function () {

    Route::get('/', [
        'uses'=>'CsTpoProcedimientosController@index',
        'middleware'=>'permission:cs_tpo_procedimientos.cs_tpo_procedimiento.index',
        'as'=>'cs_tpo_procedimientos.cs_tpo_procedimiento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CsTpoProcedimientosController@create',
        'middleware'=> 'permission:cs_tpo_procedimientos.cs_tpo_procedimiento.create',
        'as'=>'cs_tpo_procedimientos.cs_tpo_procedimiento.create'
    ])->middleware('auth');

    Route::get('/show/{csTpoProcedimiento}',[
        'uses'=>'CsTpoProcedimientosController@show',
        'middleware'=>'permission:cs_tpo_procedimientos.cs_tpo_procedimiento.show',
        'as'=>'cs_tpo_procedimientos.cs_tpo_procedimiento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{csTpoProcedimiento}/edit',[
        'uses'=>'CsTpoProcedimientosController@edit',
        'middleware'=>'permission:cs_tpo_procedimientos.cs_tpo_procedimiento.edit',
        'as'=>'cs_tpo_procedimientos.cs_tpo_procedimiento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CsTpoProcedimientosController@store',
        'middleware'=>'permission:cs_tpo_procedimientos.cs_tpo_procedimiento.store',
        'as'=>'cs_tpo_procedimientos.cs_tpo_procedimiento.store'
    ])->middleware('auth');
               
    Route::put('cs_tpo_procedimiento/{csTpoProcedimiento}', [
        'uses'=>'CsTpoProcedimientosController@update',
        'middleware'=>'permission:cs_tpo_procedimientos.cs_tpo_procedimiento.update',
        'as'=>'cs_tpo_procedimientos.cs_tpo_procedimiento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cs_tpo_procedimiento/{csTpoProcedimiento}',[
        'uses'=>'CsTpoProcedimientosController@destroy',
        'middleware'=>'permission:cs_tpo_procedimientos.cs_tpo_procedimiento.destroy',
        'as'=>'cs_tpo_procedimientos.cs_tpo_procedimiento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'cs_tpo_docs',
], function () {

    Route::get('/', [
        'uses'=>'CsTpoDocsController@index',
        'middleware'=>'permission:cs_tpo_docs.cs_tpo_doc.index',
        'as'=>'cs_tpo_docs.cs_tpo_doc.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CsTpoDocsController@create',
        'middleware'=> 'permission:cs_tpo_docs.cs_tpo_doc.create',
        'as'=>'cs_tpo_docs.cs_tpo_doc.create'
    ])->middleware('auth');

    Route::get('/show/{csTpoDoc}',[
        'uses'=>'CsTpoDocsController@show',
        'middleware'=>'permission:cs_tpo_docs.cs_tpo_doc.show',
        'as'=>'cs_tpo_docs.cs_tpo_doc.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{csTpoDoc}/edit',[
        'uses'=>'CsTpoDocsController@edit',
        'middleware'=>'permission:cs_tpo_docs.cs_tpo_doc.edit',
        'as'=>'cs_tpo_docs.cs_tpo_doc.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CsTpoDocsController@store',
        'middleware'=>'permission:cs_tpo_docs.cs_tpo_doc.store',
        'as'=>'cs_tpo_docs.cs_tpo_doc.store'
    ])->middleware('auth');
               
    Route::put('cs_tpo_doc/{csTpoDoc}', [
        'uses'=>'CsTpoDocsController@update',
        'middleware'=>'permission:cs_tpo_docs.cs_tpo_doc.update',
        'as'=>'cs_tpo_docs.cs_tpo_doc.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cs_tpo_doc/{csTpoDoc}',[
        'uses'=>'CsTpoDocsController@destroy',
        'middleware'=>'permission:cs_tpo_docs.cs_tpo_doc.destroy',
        'as'=>'cs_tpo_docs.cs_tpo_doc.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'cs_grupo_normas',
], function () {

    Route::get('/', [
        'uses'=>'CsGrupoNormasController@index',
        'middleware'=>'permission:cs_grupo_normas.cs_grupo_norma.index',
        'as'=>'cs_grupo_normas.cs_grupo_norma.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CsGrupoNormasController@create',
        'middleware'=> 'permission:cs_grupo_normas.cs_grupo_norma.create',
        'as'=>'cs_grupo_normas.cs_grupo_norma.create'
    ])->middleware('auth');

    Route::get('/show/{csGrupoNorma}',[
        'uses'=>'CsGrupoNormasController@show',
        'middleware'=>'permission:cs_grupo_normas.cs_grupo_norma.show',
        'as'=>'cs_grupo_normas.cs_grupo_norma.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{csGrupoNorma}/edit',[
        'uses'=>'CsGrupoNormasController@edit',
        'middleware'=>'permission:cs_grupo_normas.cs_grupo_norma.edit',
        'as'=>'cs_grupo_normas.cs_grupo_norma.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CsGrupoNormasController@store',
        'middleware'=>'permission:cs_grupo_normas.cs_grupo_norma.store',
        'as'=>'cs_grupo_normas.cs_grupo_norma.store'
    ])->middleware('auth');
               
    Route::put('cs_grupo_norma/{csGrupoNorma}', [
        'uses'=>'CsGrupoNormasController@update',
        'middleware'=>'permission:cs_grupo_normas.cs_grupo_norma.update',
        'as'=>'cs_grupo_normas.cs_grupo_norma.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cs_grupo_norma/{csGrupoNorma}',[
        'uses'=>'CsGrupoNormasController@destroy',
        'middleware'=>'permission:cs_grupo_normas.cs_grupo_norma.destroy',
        'as'=>'cs_grupo_normas.cs_grupo_norma.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'cs_normas',
], function () {

    Route::get('/', [
        'uses'=>'CsNormasController@index',
        'middleware'=>'permission:cs_normas.cs_norma.index',
        'as'=>'cs_normas.cs_norma.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CsNormasController@create',
        'middleware'=> 'permission:cs_normas.cs_norma.create',
        'as'=>'cs_normas.cs_norma.create'
    ])->middleware('auth');

    Route::get('/show/{csNorma}',[
        'uses'=>'CsNormasController@show',
        'middleware'=>'permission:cs_normas.cs_norma.show',
        'as'=>'cs_normas.cs_norma.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{csNorma}/edit',[
        'uses'=>'CsNormasController@edit',
        'middleware'=>'permission:cs_normas.cs_norma.edit',
        'as'=>'cs_normas.cs_norma.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CsNormasController@store',
        'middleware'=>'permission:cs_normas.cs_norma.store',
        'as'=>'cs_normas.cs_norma.store'
    ])->middleware('auth');
               
    Route::put('cs_norma/{csNorma}', [
        'uses'=>'CsNormasController@update',
        'middleware'=>'permission:cs_normas.cs_norma.update',
        'as'=>'cs_normas.cs_norma.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cs_norma/{csNorma}',[
        'uses'=>'CsNormasController@destroy',
        'middleware'=>'permission:cs_normas.cs_norma.destroy',
        'as'=>'cs_normas.cs_norma.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/cmbNormas', array(
        'as' => 'cs_normas.cs_norma.cmbNormas',
        'uses' => 'CsNormasController@cmbNormas')
    );
});

Route::group(
[
    'prefix' => 'cs_elementos_inspeccions',
], function () {

    Route::get('/', [
        'uses'=>'CsElementosInspeccionsController@index',
        'middleware'=>'permission:cs_elementos_inspeccions.cs_elementos_inspeccion.index',
        'as'=>'cs_elementos_inspeccions.cs_elementos_inspeccion.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CsElementosInspeccionsController@create',
        'middleware'=> 'permission:cs_elementos_inspeccions.cs_elementos_inspeccion.create',
        'as'=>'cs_elementos_inspeccions.cs_elementos_inspeccion.create'
    ])->middleware('auth');

    Route::get('/show/{csElementosInspeccion}',[
        'uses'=>'CsElementosInspeccionsController@show',
        'middleware'=>'permission:cs_elementos_inspeccions.cs_elementos_inspeccion.show',
        'as'=>'cs_elementos_inspeccions.cs_elementos_inspeccion.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{csElementosInspeccion}/edit',[
        'uses'=>'CsElementosInspeccionsController@edit',
        'middleware'=>'permission:cs_elementos_inspeccions.cs_elementos_inspeccion.edit',
        'as'=>'cs_elementos_inspeccions.cs_elementos_inspeccion.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CsElementosInspeccionsController@store',
        'middleware'=>'permission:cs_elementos_inspeccions.cs_elementos_inspeccion.store',
        'as'=>'cs_elementos_inspeccions.cs_elementos_inspeccion.store'
    ])->middleware('auth');
               
    Route::put('cs_elementos_inspeccion/{csElementosInspeccion}', [
        'uses'=>'CsElementosInspeccionsController@update',
        'middleware'=>'permission:cs_elementos_inspeccions.cs_elementos_inspeccion.update',
        'as'=>'cs_elementos_inspeccions.cs_elementos_inspeccion.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cs_elementos_inspeccion/{csElementosInspeccion}',[
        'uses'=>'CsElementosInspeccionsController@destroy',
        'middleware'=>'permission:cs_elementos_inspeccions.cs_elementos_inspeccion.destroy',
        'as'=>'cs_elementos_inspeccions.cs_elementos_inspeccion.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'cs_cat_docs',
], function () {

    Route::get('/', [
        'uses'=>'CsCatDocsController@index',
        'middleware'=>'permission:cs_cat_docs.cs_cat_doc.index',
        'as'=>'cs_cat_docs.cs_cat_doc.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CsCatDocsController@create',
        'middleware'=> 'permission:cs_cat_docs.cs_cat_doc.create',
        'as'=>'cs_cat_docs.cs_cat_doc.create'
    ])->middleware('auth');

    Route::get('/show/{csCatDoc}',[
        'uses'=>'CsCatDocsController@show',
        'middleware'=>'permission:cs_cat_docs.cs_cat_doc.show',
        'as'=>'cs_cat_docs.cs_cat_doc.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{csCatDoc}/edit',[
        'uses'=>'CsCatDocsController@edit',
        'middleware'=>'permission:cs_cat_docs.cs_cat_doc.edit',
        'as'=>'cs_cat_docs.cs_cat_doc.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CsCatDocsController@store',
        'middleware'=>'permission:cs_cat_docs.cs_cat_doc.store',
        'as'=>'cs_cat_docs.cs_cat_doc.store'
    ])->middleware('auth');
               
    Route::put('cs_cat_doc/{csCatDoc}', [
        'uses'=>'CsCatDocsController@update',
        'middleware'=>'permission:cs_cat_docs.cs_cat_doc.update',
        'as'=>'cs_cat_docs.cs_cat_doc.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cs_cat_doc/{csCatDoc}',[
        'uses'=>'CsCatDocsController@destroy',
        'middleware'=>'permission:cs_cat_docs.cs_cat_doc.destroy',
        'as'=>'cs_cat_docs.cs_cat_doc.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'cs_accidentes',
], function () {

    Route::get('/', [
        'uses'=>'CsAccidentesController@index',
        'middleware'=>'permission:cs_accidentes.cs_accidente.index',
        'as'=>'cs_accidentes.cs_accidente.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CsAccidentesController@create',
        'middleware'=> 'permission:cs_accidentes.cs_accidente.create',
        'as'=>'cs_accidentes.cs_accidente.create'
    ])->middleware('auth');

    Route::get('/show/{csAccidente}',[
        'uses'=>'CsAccidentesController@show',
        'middleware'=>'permission:cs_accidentes.cs_accidente.show',
        'as'=>'cs_accidentes.cs_accidente.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{csAccidente}/edit',[
        'uses'=>'CsAccidentesController@edit',
        'middleware'=>'permission:cs_accidentes.cs_accidente.edit',
        'as'=>'cs_accidentes.cs_accidente.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CsAccidentesController@store',
        'middleware'=>'permission:cs_accidentes.cs_accidente.store',
        'as'=>'cs_accidentes.cs_accidente.store'
    ])->middleware('auth');
               
    Route::put('cs_accidente/{csAccidente}', [
        'uses'=>'CsAccidentesController@update',
        'middleware'=>'permission:cs_accidentes.cs_accidente.update',
        'as'=>'cs_accidentes.cs_accidente.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cs_accidente/{csAccidente}',[
        'uses'=>'CsAccidentesController@destroy',
        'middleware'=>'permission:cs_accidentes.cs_accidente.destroy',
        'as'=>'cs_accidentes.cs_accidente.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'cs_acciones',
], function () {

    Route::get('/', [
        'uses'=>'CsAccionesController@index',
        'middleware'=>'permission:cs_acciones.cs_accione.index',
        'as'=>'cs_acciones.cs_accione.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CsAccionesController@create',
        'middleware'=> 'permission:cs_acciones.cs_accione.create',
        'as'=>'cs_acciones.cs_accione.create'
    ])->middleware('auth');

    Route::get('/show/{csAccione}',[
        'uses'=>'CsAccionesController@show',
        'middleware'=>'permission:cs_acciones.cs_accione.show',
        'as'=>'cs_acciones.cs_accione.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{csAccione}/edit',[
        'uses'=>'CsAccionesController@edit',
        'middleware'=>'permission:cs_acciones.cs_accione.edit',
        'as'=>'cs_acciones.cs_accione.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CsAccionesController@store',
        'middleware'=>'permission:cs_acciones.cs_accione.store',
        'as'=>'cs_acciones.cs_accione.store'
    ])->middleware('auth');
               
    Route::put('cs_accione/{csAccione}', [
        'uses'=>'CsAccionesController@update',
        'middleware'=>'permission:cs_acciones.cs_accione.update',
        'as'=>'cs_acciones.cs_accione.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cs_accione/{csAccione}',[
        'uses'=>'CsAccionesController@destroy',
        'middleware'=>'permission:cs_acciones.cs_accione.destroy',
        'as'=>'cs_acciones.cs_accione.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'cs_enfermedades',
], function () {

    Route::get('/', [
        'uses'=>'CsEnfermedadesController@index',
        'middleware'=>'permission:cs_enfermedades.cs_enfermedade.index',
        'as'=>'cs_enfermedades.cs_enfermedade.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CsEnfermedadesController@create',
        'middleware'=> 'permission:cs_enfermedades.cs_enfermedade.create',
        'as'=>'cs_enfermedades.cs_enfermedade.create'
    ])->middleware('auth');

    Route::get('/show/{csEnfermedade}',[
        'uses'=>'CsEnfermedadesController@show',
        'middleware'=>'permission:cs_enfermedades.cs_enfermedade.show',
        'as'=>'cs_enfermedades.cs_enfermedade.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{csEnfermedade}/edit',[
        'uses'=>'CsEnfermedadesController@edit',
        'middleware'=>'permission:cs_enfermedades.cs_enfermedade.edit',
        'as'=>'cs_enfermedades.cs_enfermedade.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CsEnfermedadesController@store',
        'middleware'=>'permission:cs_enfermedades.cs_enfermedade.store',
        'as'=>'cs_enfermedades.cs_enfermedade.store'
    ])->middleware('auth');
               
    Route::put('cs_enfermedade/{csEnfermedade}', [
        'uses'=>'CsEnfermedadesController@update',
        'middleware'=>'permission:cs_enfermedades.cs_enfermedade.update',
        'as'=>'cs_enfermedades.cs_enfermedade.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cs_enfermedade/{csEnfermedade}',[
        'uses'=>'CsEnfermedadesController@destroy',
        'middleware'=>'permission:cs_enfermedades.cs_enfermedade.destroy',
        'as'=>'cs_enfermedades.cs_enfermedade.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'cs_tpo_bitacoras',
], function () {

    Route::get('/', [
        'uses'=>'CsTpoBitacorasController@index',
        'middleware'=>'permission:cs_tpo_bitacoras.cs_tpo_bitacora.index',
        'as'=>'cs_tpo_bitacoras.cs_tpo_bitacora.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CsTpoBitacorasController@create',
        'middleware'=> 'permission:cs_tpo_bitacoras.cs_tpo_bitacora.create',
        'as'=>'cs_tpo_bitacoras.cs_tpo_bitacora.create'
    ])->middleware('auth');

    Route::get('/show/{csTpoBitacora}',[
        'uses'=>'CsTpoBitacorasController@show',
        'middleware'=>'permission:cs_tpo_bitacoras.cs_tpo_bitacora.show',
        'as'=>'cs_tpo_bitacoras.cs_tpo_bitacora.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{csTpoBitacora}/edit',[
        'uses'=>'CsTpoBitacorasController@edit',
        'middleware'=>'permission:cs_tpo_bitacoras.cs_tpo_bitacora.edit',
        'as'=>'cs_tpo_bitacoras.cs_tpo_bitacora.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CsTpoBitacorasController@store',
        'middleware'=>'permission:cs_tpo_bitacoras.cs_tpo_bitacora.store',
        'as'=>'cs_tpo_bitacoras.cs_tpo_bitacora.store'
    ])->middleware('auth');
               
    Route::put('cs_tpo_bitacora/{csTpoBitacora}', [
        'uses'=>'CsTpoBitacorasController@update',
        'middleware'=>'permission:cs_tpo_bitacoras.cs_tpo_bitacora.update',
        'as'=>'cs_tpo_bitacoras.cs_tpo_bitacora.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cs_tpo_bitacora/{csTpoBitacora}',[
        'uses'=>'CsTpoBitacorasController@destroy',
        'middleware'=>'permission:cs_tpo_bitacoras.cs_tpo_bitacora.destroy',
        'as'=>'cs_tpo_bitacoras.cs_tpo_bitacora.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'cs_tpo_inconformidades',
], function () {

    Route::get('/', [
        'uses'=>'CsTpoInconformidadesController@index',
        'middleware'=>'permission:cs_tpo_inconformidades.cs_tpo_inconformidade.index',
        'as'=>'cs_tpo_inconformidades.cs_tpo_inconformidade.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CsTpoInconformidadesController@create',
        'middleware'=> 'permission:cs_tpo_inconformidades.cs_tpo_inconformidade.create',
        'as'=>'cs_tpo_inconformidades.cs_tpo_inconformidade.create'
    ])->middleware('auth');

    Route::get('/show/{csTpoInconformidade}',[
        'uses'=>'CsTpoInconformidadesController@show',
        'middleware'=>'permission:cs_tpo_inconformidades.cs_tpo_inconformidade.show',
        'as'=>'cs_tpo_inconformidades.cs_tpo_inconformidade.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{csTpoInconformidade}/edit',[
        'uses'=>'CsTpoInconformidadesController@edit',
        'middleware'=>'permission:cs_tpo_inconformidades.cs_tpo_inconformidade.edit',
        'as'=>'cs_tpo_inconformidades.cs_tpo_inconformidade.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CsTpoInconformidadesController@store',
        'middleware'=>'permission:cs_tpo_inconformidades.cs_tpo_inconformidade.store',
        'as'=>'cs_tpo_inconformidades.cs_tpo_inconformidade.store'
    ])->middleware('auth');
               
    Route::put('cs_tpo_inconformidade/{csTpoInconformidade}', [
        'uses'=>'CsTpoInconformidadesController@update',
        'middleware'=>'permission:cs_tpo_inconformidades.cs_tpo_inconformidade.update',
        'as'=>'cs_tpo_inconformidades.cs_tpo_inconformidade.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cs_tpo_inconformidade/{csTpoInconformidade}',[
        'uses'=>'CsTpoInconformidadesController@destroy',
        'middleware'=>'permission:cs_tpo_inconformidades.cs_tpo_inconformidade.destroy',
        'as'=>'cs_tpo_inconformidades.cs_tpo_inconformidade.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'aa_procesos',
], function () {

    Route::get('/', [
        'uses'=>'AaProcesosController@index',
        'middleware'=>'permission:aa_procesos.aa_proceso.index',
        'as'=>'aa_procesos.aa_proceso.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AaProcesosController@create',
        'middleware'=> 'permission:aa_procesos.aa_proceso.create',
        'as'=>'aa_procesos.aa_proceso.create'
    ])->middleware('auth');

    Route::get('/show/{aaProceso}',[
        'uses'=>'AaProcesosController@show',
        'middleware'=>'permission:aa_procesos.aa_proceso.show',
        'as'=>'aa_procesos.aa_proceso.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aaProceso}/edit',[
        'uses'=>'AaProcesosController@edit',
        'middleware'=>'permission:aa_procesos.aa_proceso.edit',
        'as'=>'aa_procesos.aa_proceso.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AaProcesosController@store',
        'middleware'=>'permission:aa_procesos.aa_proceso.store',
        'as'=>'aa_procesos.aa_proceso.store'
    ])->middleware('auth');
               
    Route::put('aa_proceso/{aaProceso}', [
        'uses'=>'AaProcesosController@update',
        'middleware'=>'permission:aa_procesos.aa_proceso.update',
        'as'=>'aa_procesos.aa_proceso.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/aa_proceso/{aaProceso}',[
        'uses'=>'AaProcesosController@destroy',
        'middleware'=>'permission:aa_procesos.aa_proceso.destroy',
        'as'=>'aa_procesos.aa_proceso.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'aa_aspectos',
], function () {

    Route::get('/', [
        'uses'=>'AaAspectosController@index',
        'middleware'=>'permission:aa_aspectos.aa_aspecto.index',
        'as'=>'aa_aspectos.aa_aspecto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AaAspectosController@create',
        'middleware'=> 'permission:aa_aspectos.aa_aspecto.create',
        'as'=>'aa_aspectos.aa_aspecto.create'
    ])->middleware('auth');

    Route::get('/show/{aaAspecto}',[
        'uses'=>'AaAspectosController@show',
        'middleware'=>'permission:aa_aspectos.aa_aspecto.show',
        'as'=>'aa_aspectos.aa_aspecto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aaAspecto}/edit',[
        'uses'=>'AaAspectosController@edit',
        'middleware'=>'permission:aa_aspectos.aa_aspecto.edit',
        'as'=>'aa_aspectos.aa_aspecto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AaAspectosController@store',
        'middleware'=>'permission:aa_aspectos.aa_aspecto.store',
        'as'=>'aa_aspectos.aa_aspecto.store'
    ])->middleware('auth');
               
    Route::put('aa_aspecto/{aaAspecto}', [
        'uses'=>'AaAspectosController@update',
        'middleware'=>'permission:aa_aspectos.aa_aspecto.update',
        'as'=>'aa_aspectos.aa_aspecto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/aa_aspecto/{aaAspecto}',[
        'uses'=>'AaAspectosController@destroy',
        'middleware'=>'permission:aa_aspectos.aa_aspecto.destroy',
        'as'=>'aa_aspectos.aa_aspecto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'aa_impactos',
], function () {

    Route::get('/', [
        'uses'=>'AaImpactosController@index',
        'middleware'=>'permission:aa_impactos.aa_impacto.index',
        'as'=>'aa_impactos.aa_impacto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AaImpactosController@create',
        'middleware'=> 'permission:aa_impactos.aa_impacto.create',
        'as'=>'aa_impactos.aa_impacto.create'
    ])->middleware('auth');

    Route::get('/show/{aaImpacto}',[
        'uses'=>'AaImpactosController@show',
        'middleware'=>'permission:aa_impactos.aa_impacto.show',
        'as'=>'aa_impactos.aa_impacto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aaImpacto}/edit',[
        'uses'=>'AaImpactosController@edit',
        'middleware'=>'permission:aa_impactos.aa_impacto.edit',
        'as'=>'aa_impactos.aa_impacto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AaImpactosController@store',
        'middleware'=>'permission:aa_impactos.aa_impacto.store',
        'as'=>'aa_impactos.aa_impacto.store'
    ])->middleware('auth');
               
    Route::put('aa_impacto/{aaImpacto}', [
        'uses'=>'AaImpactosController@update',
        'middleware'=>'permission:aa_impactos.aa_impacto.update',
        'as'=>'aa_impactos.aa_impacto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/aa_impacto/{aaImpacto}',[
        'uses'=>'AaImpactosController@destroy',
        'middleware'=>'permission:aa_impactos.aa_impacto.destroy',
        'as'=>'aa_impactos.aa_impacto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'tpo_docs',
], function () {

    Route::get('/', [
        'uses'=>'TpoDocsController@index',
        'middleware'=>'permission:tpo_docs.tpo_doc.index',
        'as'=>'tpo_docs.tpo_doc.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'TpoDocsController@create',
        'middleware'=> 'permission:tpo_docs.tpo_doc.create',
        'as'=>'tpo_docs.tpo_doc.create'
    ])->middleware('auth');

    Route::get('/show/{tpoDoc}',[
        'uses'=>'TpoDocsController@show',
        'middleware'=>'permission:tpo_docs.tpo_doc.show',
        'as'=>'tpo_docs.tpo_doc.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{tpoDoc}/edit',[
        'uses'=>'TpoDocsController@edit',
        'middleware'=>'permission:tpo_docs.tpo_doc.edit',
        'as'=>'tpo_docs.tpo_doc.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'TpoDocsController@store',
        'middleware'=>'permission:tpo_docs.tpo_doc.store',
        'as'=>'tpo_docs.tpo_doc.store'
    ])->middleware('auth');
               
    Route::put('tpo_doc/{tpoDoc}', [
        'uses'=>'TpoDocsController@update',
        'middleware'=>'permission:tpo_docs.tpo_doc.update',
        'as'=>'tpo_docs.tpo_doc.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/tpo_doc/{tpoDoc}',[
        'uses'=>'TpoDocsController@destroy',
        'middleware'=>'permission:tpo_docs.tpo_doc.destroy',
        'as'=>'tpo_docs.tpo_doc.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'r_documentos',
], function () {

    Route::get('/', [
        'uses'=>'RDocumentosController@index',
        'middleware'=>'permission:r_documentos.r_documento.index',
        'as'=>'r_documentos.r_documento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'RDocumentosController@create',
        'middleware'=> 'permission:r_documentos.r_documento.create',
        'as'=>'r_documentos.r_documento.create'
    ])->middleware('auth');

    Route::get('/show/{rDocumento}',[
        'uses'=>'RDocumentosController@show',
        'middleware'=>'permission:r_documentos.r_documento.show',
        'as'=>'r_documentos.r_documento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{rDocumento}/edit',[
        'uses'=>'RDocumentosController@edit',
        'middleware'=>'permission:r_documentos.r_documento.edit',
        'as'=>'r_documentos.r_documento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'RDocumentosController@store',
        'middleware'=>'permission:r_documentos.r_documento.store',
        'as'=>'r_documentos.r_documento.store'
    ])->middleware('auth');
               
    Route::put('r_documento/{rDocumento}', [
        'uses'=>'RDocumentosController@update',
        'middleware'=>'permission:r_documentos.r_documento.update',
        'as'=>'r_documentos.r_documento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/r_documento/{rDocumento}',[
        'uses'=>'RDocumentosController@destroy',
        'middleware'=>'permission:r_documentos.r_documento.destroy',
        'as'=>'r_documentos.r_documento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'condiciones',
], function () {

    Route::get('/', [
        'uses'=>'CondicionesController@index',
        'middleware'=>'permission:condiciones.condicione.index',
        'as'=>'condiciones.condicione.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CondicionesController@create',
        'middleware'=> 'permission:condiciones.condicione.create',
        'as'=>'condiciones.condicione.create'
    ])->middleware('auth');

    Route::get('/show/{condicione}',[
        'uses'=>'CondicionesController@show',
        'middleware'=>'permission:condiciones.condicione.show',
        'as'=>'condiciones.condicione.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{condicione}/edit',[
        'uses'=>'CondicionesController@edit',
        'middleware'=>'permission:condiciones.condicione.edit',
        'as'=>'condiciones.condicione.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CondicionesController@store',
        'middleware'=>'permission:condiciones.condicione.store',
        'as'=>'condiciones.condicione.store'
    ])->middleware('auth');
               
    Route::put('condicione/{condicione}', [
        'uses'=>'CondicionesController@update',
        'middleware'=>'permission:condiciones.condicione.update',
        'as'=>'condiciones.condicione.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/condicione/{condicione}',[
        'uses'=>'CondicionesController@destroy',
        'middleware'=>'permission:condiciones.condicione.destroy',
        'as'=>'condiciones.condicione.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'm_objetivos',
], function () {

    Route::get('/', [
        'uses'=>'MObjetivosController@index',
        'middleware'=>'permission:m_objetivos.m_objetivo.index',
        'as'=>'m_objetivos.m_objetivo.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'MObjetivosController@create',
        'middleware'=> 'permission:m_objetivos.m_objetivo.create',
        'as'=>'m_objetivos.m_objetivo.create'
    ])->middleware('auth');

    Route::get('/show/{mObjetivo}',[
        'uses'=>'MObjetivosController@show',
        'middleware'=>'permission:m_objetivos.m_objetivo.show',
        'as'=>'m_objetivos.m_objetivo.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{mObjetivo}/edit',[
        'uses'=>'MObjetivosController@edit',
        'middleware'=>'permission:m_objetivos.m_objetivo.edit',
        'as'=>'m_objetivos.m_objetivo.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'MObjetivosController@store',
        'middleware'=>'permission:m_objetivos.m_objetivo.store',
        'as'=>'m_objetivos.m_objetivo.store'
    ])->middleware('auth');
               
    Route::put('m_objetivo/{mObjetivo}', [
        'uses'=>'MObjetivosController@update',
        'middleware'=>'permission:m_objetivos.m_objetivo.update',
        'as'=>'m_objetivos.m_objetivo.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/m_objetivo/{mObjetivo}',[
        'uses'=>'MObjetivosController@destroy',
        'middleware'=>'permission:m_objetivos.m_objetivo.destroy',
        'as'=>'m_objetivos.m_objetivo.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'm_clase_mantos',
], function () {

    Route::get('/', [
        'uses'=>'MClaseMantosController@index',
        'middleware'=>'permission:m_clase_mantos.m_clase_manto.index',
        'as'=>'m_clase_mantos.m_clase_manto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'MClaseMantosController@create',
        'middleware'=> 'permission:m_clase_mantos.m_clase_manto.create',
        'as'=>'m_clase_mantos.m_clase_manto.create'
    ])->middleware('auth');

    Route::get('/show/{mClaseManto}',[
        'uses'=>'MClaseMantosController@show',
        'middleware'=>'permission:m_clase_mantos.m_clase_manto.show',
        'as'=>'m_clase_mantos.m_clase_manto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{mClaseManto}/edit',[
        'uses'=>'MClaseMantosController@edit',
        'middleware'=>'permission:m_clase_mantos.m_clase_manto.edit',
        'as'=>'m_clase_mantos.m_clase_manto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'MClaseMantosController@store',
        'middleware'=>'permission:m_clase_mantos.m_clase_manto.store',
        'as'=>'m_clase_mantos.m_clase_manto.store'
    ])->middleware('auth');
               
    Route::put('m_clase_manto/{mClaseManto}', [
        'uses'=>'MClaseMantosController@update',
        'middleware'=>'permission:m_clase_mantos.m_clase_manto.update',
        'as'=>'m_clase_mantos.m_clase_manto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/m_clase_manto/{mClaseManto}',[
        'uses'=>'MClaseMantosController@destroy',
        'middleware'=>'permission:m_clase_mantos.m_clase_manto.destroy',
        'as'=>'m_clase_mantos.m_clase_manto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'm_tpo_mantos',
], function () {

    Route::get('/', [
        'uses'=>'MTpoMantosController@index',
        'middleware'=>'permission:m_tpo_mantos.m_tpo_manto.index',
        'as'=>'m_tpo_mantos.m_tpo_manto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'MTpoMantosController@create',
        'middleware'=> 'permission:m_tpo_mantos.m_tpo_manto.create',
        'as'=>'m_tpo_mantos.m_tpo_manto.create'
    ])->middleware('auth');

    Route::get('/show/{mTpoManto}',[
        'uses'=>'MTpoMantosController@show',
        'middleware'=>'permission:m_tpo_mantos.m_tpo_manto.show',
        'as'=>'m_tpo_mantos.m_tpo_manto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{mTpoManto}/edit',[
        'uses'=>'MTpoMantosController@edit',
        'middleware'=>'permission:m_tpo_mantos.m_tpo_manto.edit',
        'as'=>'m_tpo_mantos.m_tpo_manto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'MTpoMantosController@store',
        'middleware'=>'permission:m_tpo_mantos.m_tpo_manto.store',
        'as'=>'m_tpo_mantos.m_tpo_manto.store'
    ])->middleware('auth');
               
    Route::put('m_tpo_manto/{mTpoManto}', [
        'uses'=>'MTpoMantosController@update',
        'middleware'=>'permission:m_tpo_mantos.m_tpo_manto.update',
        'as'=>'m_tpo_mantos.m_tpo_manto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/m_tpo_manto/{mTpoManto}',[
        'uses'=>'MTpoMantosController@destroy',
        'middleware'=>'permission:m_tpo_mantos.m_tpo_manto.destroy',
        'as'=>'m_tpo_mantos.m_tpo_manto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'subequipos',
], function () {

    Route::get('/', [
        'uses'=>'SubequiposController@index',
        'middleware'=>'permission:subequipos.subequipo.index',
        'as'=>'subequipos.subequipo.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'SubequiposController@create',
        'middleware'=> 'permission:subequipos.subequipo.create',
        'as'=>'subequipos.subequipo.create'
    ])->middleware('auth');

    Route::get('/show/{subequipo}',[
        'uses'=>'SubequiposController@show',
        'middleware'=>'permission:subequipos.subequipo.show',
        'as'=>'subequipos.subequipo.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{subequipo}/edit',[
        'uses'=>'SubequiposController@edit',
        'middleware'=>'permission:subequipos.subequipo.edit',
        'as'=>'subequipos.subequipo.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'SubequiposController@store',
        'middleware'=>'permission:subequipos.subequipo.store',
        'as'=>'subequipos.subequipo.store'
    ])->middleware('auth');
               
    Route::put('subequipo/{subequipo}', [
        'uses'=>'SubequiposController@update',
        'middleware'=>'permission:subequipos.subequipo.update',
        'as'=>'subequipos.subequipo.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/subequipo/{subequipo}',[
        'uses'=>'SubequiposController@destroy',
        'middleware'=>'permission:subequipos.subequipo.destroy',
        'as'=>'subequipos.subequipo.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'enc_impactos',
], function () {

    Route::get('/', [
        'uses'=>'EncImpactosController@index',
        'middleware'=>'permission:enc_impactos.enc_impacto.index',
        'as'=>'enc_impactos.enc_impacto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'EncImpactosController@create',
        'middleware'=> 'permission:enc_impactos.enc_impacto.create',
        'as'=>'enc_impactos.enc_impacto.create'
    ])->middleware('auth');

    Route::get('/show/{encImpacto}',[
        'uses'=>'EncImpactosController@show',
        'middleware'=>'permission:enc_impactos.enc_impacto.show',
        'as'=>'enc_impactos.enc_impacto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{encImpacto}/edit',[
        'uses'=>'EncImpactosController@edit',
        'middleware'=>'permission:enc_impactos.enc_impacto.edit',
        'as'=>'enc_impactos.enc_impacto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'EncImpactosController@store',
        'middleware'=>'permission:enc_impactos.enc_impacto.store',
        'as'=>'enc_impactos.enc_impacto.store'
    ])->middleware('auth');
               
    Route::put('enc_impacto/{encImpacto}', [
        'uses'=>'EncImpactosController@update',
        'middleware'=>'permission:enc_impactos.enc_impacto.update',
        'as'=>'enc_impactos.enc_impacto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/enc_impacto/{encImpacto}',[
        'uses'=>'EncImpactosController@destroy',
        'middleware'=>'permission:enc_impactos.enc_impacto.destroy',
        'as'=>'enc_impactos.enc_impacto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ln_impactos',
], function () {

    Route::get('/', [
        'uses'=>'LnImpactosController@index',
        'middleware'=>'permission:ln_impactos.ln_impacto.index',
        'as'=>'ln_impactos.ln_impacto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'LnImpactosController@create',
        'middleware'=> 'permission:ln_impactos.ln_impacto.create',
        'as'=>'ln_impactos.ln_impacto.create'
    ])->middleware('auth');

    Route::get('/show/{lnImpacto}',[
        'uses'=>'LnImpactosController@show',
        'middleware'=>'permission:ln_impactos.ln_impacto.show',
        'as'=>'ln_impactos.ln_impacto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/edit/{lnImpacto}',[
        'uses'=>'LnImpactosController@edit',
        'middleware'=>'permission:ln_impactos.ln_impacto.edit',
        'as'=>'ln_impactos.ln_impacto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'LnImpactosController@store',
        'middleware'=>'permission:ln_impactos.ln_impacto.store',
        'as'=>'ln_impactos.ln_impacto.store'
    ])->middleware('auth');
               
    Route::put('ln_impacto/{lnImpacto}', [
        'uses'=>'LnImpactosController@update',
        'middleware'=>'permission:ln_impactos.ln_impacto.update',
        'as'=>'ln_impactos.ln_impacto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ln_impacto/{lnImpacto}',[
        'uses'=>'LnImpactosController@destroy',
        'middleware'=>'permission:ln_impactos.ln_impacto.destroy',
        'as'=>'ln_impactos.ln_impacto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/ln_impacto/getByEnc',[
        'uses'=>'LnImpactosController@getByEnc',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'ln_impactos.ln_impacto.getByEnc'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'st_reg_impactos',
], function () {

    Route::get('/', [
        'uses'=>'StRegImpactosController@index',
        'middleware'=>'permission:st_reg_impactos.st_reg_impacto.index',
        'as'=>'st_reg_impactos.st_reg_impacto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'StRegImpactosController@create',
        'middleware'=> 'permission:st_reg_impactos.st_reg_impacto.create',
        'as'=>'st_reg_impactos.st_reg_impacto.create'
    ])->middleware('auth');

    Route::get('/show/{stRegImpacto}',[
        'uses'=>'StRegImpactosController@show',
        'middleware'=>'permission:st_reg_impactos.st_reg_impacto.show',
        'as'=>'st_reg_impactos.st_reg_impacto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{stRegImpacto}/edit',[
        'uses'=>'StRegImpactosController@edit',
        'middleware'=>'permission:st_reg_impactos.st_reg_impacto.edit',
        'as'=>'st_reg_impactos.st_reg_impacto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'StRegImpactosController@store',
        'middleware'=>'permission:st_reg_impactos.st_reg_impacto.store',
        'as'=>'st_reg_impactos.st_reg_impacto.store'
    ])->middleware('auth');
               
    Route::put('st_reg_impacto/{stRegImpacto}', [
        'uses'=>'StRegImpactosController@update',
        'middleware'=>'permission:st_reg_impactos.st_reg_impacto.update',
        'as'=>'st_reg_impactos.st_reg_impacto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/st_reg_impacto/{stRegImpacto}',[
        'uses'=>'StRegImpactosController@destroy',
        'middleware'=>'permission:st_reg_impactos.st_reg_impacto.destroy',
        'as'=>'st_reg_impactos.st_reg_impacto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'ln_caracteristicas',
], function () {

    Route::get('/', [
        'uses'=>'LnCaracteristicasController@index',
        'middleware'=>'permission:ln_caracteristicas.ln_caracteristica.index',
        'as'=>'ln_caracteristicas.ln_caracteristica.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'LnCaracteristicasController@create',
        'middleware'=> 'permission:ln_caracteristicas.ln_caracteristica.create',
        'as'=>'ln_caracteristicas.ln_caracteristica.create'
    ])->middleware('auth');

    Route::get('/show/{lnCaracteristica}',[
        'uses'=>'LnCaracteristicasController@show',
        'middleware'=>'permission:ln_caracteristicas.ln_caracteristica.show',
        'as'=>'ln_caracteristicas.ln_caracteristica.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{lnCaracteristica}/edit',[
        'uses'=>'LnCaracteristicasController@edit',
        'middleware'=>'permission:ln_caracteristicas.ln_caracteristica.edit',
        'as'=>'ln_caracteristicas.ln_caracteristica.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'LnCaracteristicasController@store',
        'middleware'=>'permission:ln_caracteristicas.ln_caracteristica.store',
        'as'=>'ln_caracteristicas.ln_caracteristica.store'
    ])->middleware('auth');
               
    Route::put('ln_caracteristica/{lnCaracteristica}', [
        'uses'=>'LnCaracteristicasController@update',
        'middleware'=>'permission:ln_caracteristicas.ln_caracteristica.update',
        'as'=>'ln_caracteristicas.ln_caracteristica.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/ln_caracteristica/{lnCaracteristica}',[
        'uses'=>'LnCaracteristicasController@destroy',
        'middleware'=>'permission:ln_caracteristicas.ln_caracteristica.destroy',
        'as'=>'ln_caracteristicas.ln_caracteristica.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'imp_potencials',
], function () {

    Route::get('/', [
        'uses'=>'ImpPotencialsController@index',
        'middleware'=>'permission:imp_potencials.imp_potencial.index',
        'as'=>'imp_potencials.imp_potencial.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ImpPotencialsController@create',
        'middleware'=> 'permission:imp_potencials.imp_potencial.create',
        'as'=>'imp_potencials.imp_potencial.create'
    ])->middleware('auth');

    Route::get('/show/{impPotencial}',[
        'uses'=>'ImpPotencialsController@show',
        'middleware'=>'permission:imp_potencials.imp_potencial.show',
        'as'=>'imp_potencials.imp_potencial.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{impPotencial}/edit',[
        'uses'=>'ImpPotencialsController@edit',
        'middleware'=>'permission:imp_potencials.imp_potencial.edit',
        'as'=>'imp_potencials.imp_potencial.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ImpPotencialsController@store',
        'middleware'=>'permission:imp_potencials.imp_potencial.store',
        'as'=>'imp_potencials.imp_potencial.store'
    ])->middleware('auth');
               
    Route::put('imp_potencial/{impPotencial}', [
        'uses'=>'ImpPotencialsController@update',
        'middleware'=>'permission:imp_potencials.imp_potencial.update',
        'as'=>'imp_potencials.imp_potencial.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/imp_potencial/{impPotencial}',[
        'uses'=>'ImpPotencialsController@destroy',
        'middleware'=>'permission:imp_potencials.imp_potencial.destroy',
        'as'=>'imp_potencials.imp_potencial.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'imp_reals',
], function () {

    Route::get('/', [
        'uses'=>'ImpRealsController@index',
        'middleware'=>'permission:imp_reals.imp_real.index',
        'as'=>'imp_reals.imp_real.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ImpRealsController@create',
        'middleware'=> 'permission:imp_reals.imp_real.create',
        'as'=>'imp_reals.imp_real.create'
    ])->middleware('auth');

    Route::get('/show/{impReal}',[
        'uses'=>'ImpRealsController@show',
        'middleware'=>'permission:imp_reals.imp_real.show',
        'as'=>'imp_reals.imp_real.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{impReal}/edit',[
        'uses'=>'ImpRealsController@edit',
        'middleware'=>'permission:imp_reals.imp_real.edit',
        'as'=>'imp_reals.imp_real.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ImpRealsController@store',
        'middleware'=>'permission:imp_reals.imp_real.store',
        'as'=>'imp_reals.imp_real.store'
    ])->middleware('auth');
               
    Route::put('imp_real/{impReal}', [
        'uses'=>'ImpRealsController@update',
        'middleware'=>'permission:imp_reals.imp_real.update',
        'as'=>'imp_reals.imp_real.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/imp_real/{impReal}',[
        'uses'=>'ImpRealsController@destroy',
        'middleware'=>'permission:imp_reals.imp_real.destroy',
        'as'=>'imp_reals.imp_real.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'intensidad_impactos',
], function () {

    Route::get('/', [
        'uses'=>'IntensidadImpactosController@index',
        'middleware'=>'permission:intensidad_impactos.intensidad_impacto.index',
        'as'=>'intensidad_impactos.intensidad_impacto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'IntensidadImpactosController@create',
        'middleware'=> 'permission:intensidad_impactos.intensidad_impacto.create',
        'as'=>'intensidad_impactos.intensidad_impacto.create'
    ])->middleware('auth');

    Route::get('/show/{intensidadImpacto}',[
        'uses'=>'IntensidadImpactosController@show',
        'middleware'=>'permission:intensidad_impactos.intensidad_impacto.show',
        'as'=>'intensidad_impactos.intensidad_impacto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{intensidadImpacto}/edit',[
        'uses'=>'IntensidadImpactosController@edit',
        'middleware'=>'permission:intensidad_impactos.intensidad_impacto.edit',
        'as'=>'intensidad_impactos.intensidad_impacto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'IntensidadImpactosController@store',
        'middleware'=>'permission:intensidad_impactos.intensidad_impacto.store',
        'as'=>'intensidad_impactos.intensidad_impacto.store'
    ])->middleware('auth');
               
    Route::put('intensidad_impacto/{intensidadImpacto}', [
        'uses'=>'IntensidadImpactosController@update',
        'middleware'=>'permission:intensidad_impactos.intensidad_impacto.update',
        'as'=>'intensidad_impactos.intensidad_impacto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/intensidad_impacto/{intensidadImpacto}',[
        'uses'=>'IntensidadImpactosController@destroy',
        'middleware'=>'permission:intensidad_impactos.intensidad_impacto.destroy',
        'as'=>'intensidad_impactos.intensidad_impacto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'mitigacions',
], function () {

    Route::get('/', [
        'uses'=>'MitigacionsController@index',
        'middleware'=>'permission:mitigacions.mitigacion.index',
        'as'=>'mitigacions.mitigacion.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'MitigacionsController@create',
        'middleware'=> 'permission:mitigacions.mitigacion.create',
        'as'=>'mitigacions.mitigacion.create'
    ])->middleware('auth');

    Route::get('/show/{mitigacion}',[
        'uses'=>'MitigacionsController@show',
        'middleware'=>'permission:mitigacions.mitigacion.show',
        'as'=>'mitigacions.mitigacion.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{mitigacion}/edit',[
        'uses'=>'MitigacionsController@edit',
        'middleware'=>'permission:mitigacions.mitigacion.edit',
        'as'=>'mitigacions.mitigacion.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'MitigacionsController@store',
        'middleware'=>'permission:mitigacions.mitigacion.store',
        'as'=>'mitigacions.mitigacion.store'
    ])->middleware('auth');
               
    Route::put('mitigacion/{mitigacion}', [
        'uses'=>'MitigacionsController@update',
        'middleware'=>'permission:mitigacions.mitigacion.update',
        'as'=>'mitigacions.mitigacion.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/mitigacion/{mitigacion}',[
        'uses'=>'MitigacionsController@destroy',
        'middleware'=>'permission:mitigacions.mitigacion.destroy',
        'as'=>'mitigacions.mitigacion.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'probabilidads',
], function () {

    Route::get('/', [
        'uses'=>'ProbabilidadsController@index',
        'middleware'=>'permission:probabilidads.probabilidad.index',
        'as'=>'probabilidads.probabilidad.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ProbabilidadsController@create',
        'middleware'=> 'permission:probabilidads.probabilidad.create',
        'as'=>'probabilidads.probabilidad.create'
    ])->middleware('auth');

    Route::get('/show/{probabilidad}',[
        'uses'=>'ProbabilidadsController@show',
        'middleware'=>'permission:probabilidads.probabilidad.show',
        'as'=>'probabilidads.probabilidad.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{probabilidad}/edit',[
        'uses'=>'ProbabilidadsController@edit',
        'middleware'=>'permission:probabilidads.probabilidad.edit',
        'as'=>'probabilidads.probabilidad.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ProbabilidadsController@store',
        'middleware'=>'permission:probabilidads.probabilidad.store',
        'as'=>'probabilidads.probabilidad.store'
    ])->middleware('auth');
               
    Route::put('probabilidad/{probabilidad}', [
        'uses'=>'ProbabilidadsController@update',
        'middleware'=>'permission:probabilidads.probabilidad.update',
        'as'=>'probabilidads.probabilidad.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/probabilidad/{probabilidad}',[
        'uses'=>'ProbabilidadsController@destroy',
        'middleware'=>'permission:probabilidads.probabilidad.destroy',
        'as'=>'probabilidads.probabilidad.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'reversibilidads',
], function () {

    Route::get('/', [
        'uses'=>'ReversibilidadsController@index',
        'middleware'=>'permission:reversibilidads.reversibilidad.index',
        'as'=>'reversibilidads.reversibilidad.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ReversibilidadsController@create',
        'middleware'=> 'permission:reversibilidads.reversibilidad.create',
        'as'=>'reversibilidads.reversibilidad.create'
    ])->middleware('auth');

    Route::get('/show/{reversibilidad}',[
        'uses'=>'ReversibilidadsController@show',
        'middleware'=>'permission:reversibilidads.reversibilidad.show',
        'as'=>'reversibilidads.reversibilidad.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{reversibilidad}/edit',[
        'uses'=>'ReversibilidadsController@edit',
        'middleware'=>'permission:reversibilidads.reversibilidad.edit',
        'as'=>'reversibilidads.reversibilidad.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ReversibilidadsController@store',
        'middleware'=>'permission:reversibilidads.reversibilidad.store',
        'as'=>'reversibilidads.reversibilidad.store'
    ])->middleware('auth');
               
    Route::put('reversibilidad/{reversibilidad}', [
        'uses'=>'ReversibilidadsController@update',
        'middleware'=>'permission:reversibilidads.reversibilidad.update',
        'as'=>'reversibilidads.reversibilidad.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/reversibilidad/{reversibilidad}',[
        'uses'=>'ReversibilidadsController@destroy',
        'middleware'=>'permission:reversibilidads.reversibilidad.destroy',
        'as'=>'reversibilidads.reversibilidad.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'continuidad_efectos',
], function () {

    Route::get('/', [
        'uses'=>'ContinuidadEfectosController@index',
        'middleware'=>'permission:continuidad_efectos.continuidad_efecto.index',
        'as'=>'continuidad_efectos.continuidad_efecto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ContinuidadEfectosController@create',
        'middleware'=> 'permission:continuidad_efectos.continuidad_efecto.create',
        'as'=>'continuidad_efectos.continuidad_efecto.create'
    ])->middleware('auth');

    Route::get('/show/{continuidadEfecto}',[
        'uses'=>'ContinuidadEfectosController@show',
        'middleware'=>'permission:continuidad_efectos.continuidad_efecto.show',
        'as'=>'continuidad_efectos.continuidad_efecto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{continuidadEfecto}/edit',[
        'uses'=>'ContinuidadEfectosController@edit',
        'middleware'=>'permission:continuidad_efectos.continuidad_efecto.edit',
        'as'=>'continuidad_efectos.continuidad_efecto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ContinuidadEfectosController@store',
        'middleware'=>'permission:continuidad_efectos.continuidad_efecto.store',
        'as'=>'continuidad_efectos.continuidad_efecto.store'
    ])->middleware('auth');
               
    Route::put('continuidad_efecto/{continuidadEfecto}', [
        'uses'=>'ContinuidadEfectosController@update',
        'middleware'=>'permission:continuidad_efectos.continuidad_efecto.update',
        'as'=>'continuidad_efectos.continuidad_efecto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/continuidad_efecto/{continuidadEfecto}',[
        'uses'=>'ContinuidadEfectosController@destroy',
        'middleware'=>'permission:continuidad_efectos.continuidad_efecto.destroy',
        'as'=>'continuidad_efectos.continuidad_efecto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'duracion_accions',
], function () {

    Route::get('/', [
        'uses'=>'DuracionAccionsController@index',
        'middleware'=>'permission:duracion_accions.duracion_accion.index',
        'as'=>'duracion_accions.duracion_accion.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'DuracionAccionsController@create',
        'middleware'=> 'permission:duracion_accions.duracion_accion.create',
        'as'=>'duracion_accions.duracion_accion.create'
    ])->middleware('auth');

    Route::get('/show/{duracionAccion}',[
        'uses'=>'DuracionAccionsController@show',
        'middleware'=>'permission:duracion_accions.duracion_accion.show',
        'as'=>'duracion_accions.duracion_accion.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{duracionAccion}/edit',[
        'uses'=>'DuracionAccionsController@edit',
        'middleware'=>'permission:duracion_accions.duracion_accion.edit',
        'as'=>'duracion_accions.duracion_accion.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'DuracionAccionsController@store',
        'middleware'=>'permission:duracion_accions.duracion_accion.store',
        'as'=>'duracion_accions.duracion_accion.store'
    ])->middleware('auth');
               
    Route::put('duracion_accion/{duracionAccion}', [
        'uses'=>'DuracionAccionsController@update',
        'middleware'=>'permission:duracion_accions.duracion_accion.update',
        'as'=>'duracion_accions.duracion_accion.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/duracion_accion/{duracionAccion}',[
        'uses'=>'DuracionAccionsController@destroy',
        'middleware'=>'permission:duracion_accions.duracion_accion.destroy',
        'as'=>'duracion_accions.duracion_accion.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'emision_efectos',
], function () {

    Route::get('/', [
        'uses'=>'EmisionEfectosController@index',
        'middleware'=>'permission:emision_efectos.emision_efecto.index',
        'as'=>'emision_efectos.emision_efecto.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'EmisionEfectosController@create',
        'middleware'=> 'permission:emision_efectos.emision_efecto.create',
        'as'=>'emision_efectos.emision_efecto.create'
    ])->middleware('auth');

    Route::get('/show/{emisionEfecto}',[
        'uses'=>'EmisionEfectosController@show',
        'middleware'=>'permission:emision_efectos.emision_efecto.show',
        'as'=>'emision_efectos.emision_efecto.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{emisionEfecto}/edit',[
        'uses'=>'EmisionEfectosController@edit',
        'middleware'=>'permission:emision_efectos.emision_efecto.edit',
        'as'=>'emision_efectos.emision_efecto.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'EmisionEfectosController@store',
        'middleware'=>'permission:emision_efectos.emision_efecto.store',
        'as'=>'emision_efectos.emision_efecto.store'
    ])->middleware('auth');
               
    Route::put('emision_efecto/{emisionEfecto}', [
        'uses'=>'EmisionEfectosController@update',
        'middleware'=>'permission:emision_efectos.emision_efecto.update',
        'as'=>'emision_efectos.emision_efecto.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/emision_efecto/{emisionEfecto}',[
        'uses'=>'EmisionEfectosController@destroy',
        'middleware'=>'permission:emision_efectos.emision_efecto.destroy',
        'as'=>'emision_efectos.emision_efecto.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'checks',
], function () {

    Route::get('/', [
        'uses'=>'ChecksController@index',
        'middleware'=>'permission:checks.check.index',
        'as'=>'checks.check.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ChecksController@create',
        'middleware'=> 'permission:checks.check.create',
        'as'=>'checks.check.create'
    ])->middleware('auth');

    Route::get('/show/{check}',[
        'uses'=>'ChecksController@show',
        'middleware'=>'permission:checks.check.show',
        'as'=>'checks.check.show'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    Route::get('/addNorma','ChecksController@addNorma')
     ->name('roles.role.addNorma');
    
    Route::get('/lessNorma','ChecksController@lessNorma')
     ->name('roles.role.lessNorma');

    Route::get('/{check}/edit',[
        'uses'=>'ChecksController@edit',
        'middleware'=>'permission:checks.check.edit',
        'as'=>'checks.check.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ChecksController@store',
        'middleware'=>'permission:checks.check.store',
        'as'=>'checks.check.store'
    ])->middleware('auth');
               
    Route::put('check/{check}', [
        'uses'=>'ChecksController@update',
        'middleware'=>'permission:checks.check.update',
        'as'=>'checks.check.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/check/{check}',[
        'uses'=>'ChecksController@destroy',
        'middleware'=>'permission:checks.check.destroy',
        'as'=>'checks.check.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'a_checks',
], function () {

    Route::get('/', [
        'uses'=>'AChecksController@index',
        'middleware'=>'permission:a_checks.a_check.index',
        'as'=>'a_checks.a_check.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AChecksController@create',
        'middleware'=> 'permission:a_checks.a_check.create',
        'as'=>'a_checks.a_check.create'
    ])->middleware('auth');

    Route::get('/show/{aCheck}',[
        'uses'=>'AChecksController@show',
        'middleware'=>'permission:a_checks.a_check.show',
        'as'=>'a_checks.a_check.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aCheck}/edit',[
        'uses'=>'AChecksController@edit',
        'middleware'=>'permission:a_checks.a_check.edit',
        'as'=>'a_checks.a_check.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AChecksController@store',
        'middleware'=>'permission:a_checks.a_check.store',
        'as'=>'a_checks.a_check.store'
    ])->middleware('auth');
               
    Route::put('a_check/{aCheck}', [
        'uses'=>'AChecksController@update',
        'middleware'=>'permission:a_checks.a_check.update',
        'as'=>'a_checks.a_check.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/a_check/{aCheck}',[
        'uses'=>'AChecksController@destroy',
        'middleware'=>'permission:a_checks.a_check.destroy',
        'as'=>'a_checks.a_check.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'check_ls',
], function () {

    Route::get('/', [
        'uses'=>'CheckLsController@index',
        'middleware'=>'permission:check_ls.check_l.index',
        'as'=>'check_ls.check_l.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CheckLsController@create',
        'middleware'=> 'permission:check_ls.check_l.create',
        'as'=>'check_ls.check_l.create'
    ])->middleware('auth');

    Route::get('/show/{checkL}',[
        'uses'=>'CheckLsController@show',
        'middleware'=>'permission:check_ls.check_l.show',
        'as'=>'check_ls.check_l.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/edit/{checkL}',[
        'uses'=>'CheckLsController@edit',
        'middleware'=>'permission:check_ls.check_l.edit',
        'as'=>'check_ls.check_l.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CheckLsController@store',
        'middleware'=>'permission:check_ls.check_l.store',
        'as'=>'check_ls.check_l.store'
    ])->middleware('auth');
               
    Route::put('check_l/{checkL}', [
        'uses'=>'CheckLsController@update',
        'middleware'=>'permission:check_ls.check_l.update',
        'as'=>'check_ls.check_l.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/check_l/{checkL}',[
        'uses'=>'CheckLsController@destroy',
        'middleware'=>'permission:check_ls.check_l.destroy',
        'as'=>'check_ls.check_l.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/check_l/getByCheck',[
        'uses'=>'CheckLsController@getByCheck',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'check_ls.check_l.getByCheck'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'cumplimientos',
], function () {

    Route::get('/', [
        'uses'=>'CumplimientosController@index',
        'middleware'=>'permission:cumplimientos.cumplimiento.index',
        'as'=>'cumplimientos.cumplimiento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CumplimientosController@create',
        'middleware'=> 'permission:cumplimientos.cumplimiento.create',
        'as'=>'cumplimientos.cumplimiento.create'
    ])->middleware('auth');

    Route::get('/show/{cumplimiento}',[
        'uses'=>'CumplimientosController@show',
        'middleware'=>'permission:cumplimientos.cumplimiento.show',
        'as'=>'cumplimientos.cumplimiento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{cumplimiento}/edit',[
        'uses'=>'CumplimientosController@edit',
        'middleware'=>'permission:cumplimientos.cumplimiento.edit',
        'as'=>'cumplimientos.cumplimiento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CumplimientosController@store',
        'middleware'=>'permission:cumplimientos.cumplimiento.store',
        'as'=>'cumplimientos.cumplimiento.store'
    ])->middleware('auth');
               
    Route::put('cumplimiento/{cumplimiento}', [
        'uses'=>'CumplimientosController@update',
        'middleware'=>'permission:cumplimientos.cumplimiento.update',
        'as'=>'cumplimientos.cumplimiento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cumplimiento/{cumplimiento}',[
        'uses'=>'CumplimientosController@destroy',
        'middleware'=>'permission:cumplimientos.cumplimiento.destroy',
        'as'=>'cumplimientos.cumplimiento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'aspectos_ambientales',
], function () {

    Route::get('/', [
        'uses'=>'AspectosAmbientalesController@index',
        'middleware'=>'permission:aspectos_ambientales.aspectos_ambientale.index',
        'as'=>'aspectos_ambientales.aspectos_ambientale.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AspectosAmbientalesController@create',
        'middleware'=> 'permission:aspectos_ambientales.aspectos_ambientale.create',
        'as'=>'aspectos_ambientales.aspectos_ambientale.create'
    ])->middleware('auth');

    Route::get('/show/{aspectosAmbientale}',[
        'uses'=>'AspectosAmbientalesController@show',
        'middleware'=>'permission:aspectos_ambientales.aspectos_ambientale.show',
        'as'=>'aspectos_ambientales.aspectos_ambientale.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aspectosAmbientale}/edit',[
        'uses'=>'AspectosAmbientalesController@edit',
        'middleware'=>'permission:aspectos_ambientales.aspectos_ambientale.edit',
        'as'=>'aspectos_ambientales.aspectos_ambientale.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AspectosAmbientalesController@store',
        'middleware'=>'permission:aspectos_ambientales.aspectos_ambientale.store',
        'as'=>'aspectos_ambientales.aspectos_ambientale.store'
    ])->middleware('auth');
               
    Route::put('aspectos_ambientale/{aspectosAmbientale}', [
        'uses'=>'AspectosAmbientalesController@update',
        'middleware'=>'permission:aspectos_ambientales.aspectos_ambientale.update',
        'as'=>'aspectos_ambientales.aspectos_ambientale.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/aspectos_ambientale/{aspectosAmbientale}',[
        'uses'=>'AspectosAmbientalesController@destroy',
        'middleware'=>'permission:aspectos_ambientales.aspectos_ambientale.destroy',
        'as'=>'aspectos_ambientales.aspectos_ambientale.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'aa_emes',
], function () {

    Route::get('/', [
        'uses'=>'AaEmesController@index',
        'middleware'=>'permission:aa_emes.aa_eme.index',
        'as'=>'aa_emes.aa_eme.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AaEmesController@create',
        'middleware'=> 'permission:aa_emes.aa_eme.create',
        'as'=>'aa_emes.aa_eme.create'
    ])->middleware('auth');

    Route::get('/show/{aaEme}',[
        'uses'=>'AaEmesController@show',
        'middleware'=>'permission:aa_emes.aa_eme.show',
        'as'=>'aa_emes.aa_eme.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aaEme}/edit',[
        'uses'=>'AaEmesController@edit',
        'middleware'=>'permission:aa_emes.aa_eme.edit',
        'as'=>'aa_emes.aa_eme.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AaEmesController@store',
        'middleware'=>'permission:aa_emes.aa_eme.store',
        'as'=>'aa_emes.aa_eme.store'
    ])->middleware('auth');
               
    Route::put('aa_eme/{aaEme}', [
        'uses'=>'AaEmesController@update',
        'middleware'=>'permission:aa_emes.aa_eme.update',
        'as'=>'aa_emes.aa_eme.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/aa_eme/{aaEme}',[
        'uses'=>'AaEmesController@destroy',
        'middleware'=>'permission:aa_emes.aa_eme.destroy',
        'as'=>'aa_emes.aa_eme.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'aa_condiciones',
], function () {

    Route::get('/', [
        'uses'=>'AaCondicionesController@index',
        'middleware'=>'permission:aa_condiciones.aa_condicione.index',
        'as'=>'aa_condiciones.aa_condicione.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AaCondicionesController@create',
        'middleware'=> 'permission:aa_condiciones.aa_condicione.create',
        'as'=>'aa_condiciones.aa_condicione.create'
    ])->middleware('auth');

    Route::get('/show/{aaCondicione}',[
        'uses'=>'AaCondicionesController@show',
        'middleware'=>'permission:aa_condiciones.aa_condicione.show',
        'as'=>'aa_condiciones.aa_condicione.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aaCondicione}/edit',[
        'uses'=>'AaCondicionesController@edit',
        'middleware'=>'permission:aa_condiciones.aa_condicione.edit',
        'as'=>'aa_condiciones.aa_condicione.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AaCondicionesController@store',
        'middleware'=>'permission:aa_condiciones.aa_condicione.store',
        'as'=>'aa_condiciones.aa_condicione.store'
    ])->middleware('auth');
               
    Route::put('aa_condicione/{aaCondicione}', [
        'uses'=>'AaCondicionesController@update',
        'middleware'=>'permission:aa_condiciones.aa_condicione.update',
        'as'=>'aa_condiciones.aa_condicione.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/aa_condicione/{aaCondicione}',[
        'uses'=>'AaCondicionesController@destroy',
        'middleware'=>'permission:aa_condiciones.aa_condicione.destroy',
        'as'=>'aa_condiciones.aa_condicione.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'rev_requisitos',
], function () {

    Route::get('/', [
        'uses'=>'RevRequisitosController@index',
        'middleware'=>'permission:rev_requisitos.rev_requisito.index',
        'as'=>'rev_requisitos.rev_requisito.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'RevRequisitosController@create',
        'middleware'=> 'permission:rev_requisitos.rev_requisito.create',
        'as'=>'rev_requisitos.rev_requisito.create'
    ])->middleware('auth');

    Route::get('/show/{revRequisito}',[
        'uses'=>'RevRequisitosController@show',
        'middleware'=>'permission:rev_requisitos.rev_requisito.show',
        'as'=>'rev_requisitos.rev_requisito.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{revRequisito}/edit',[
        'uses'=>'RevRequisitosController@edit',
        'middleware'=>'permission:rev_requisitos.rev_requisito.edit',
        'as'=>'rev_requisitos.rev_requisito.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'RevRequisitosController@store',
        'middleware'=>'permission:rev_requisitos.rev_requisito.store',
        'as'=>'rev_requisitos.rev_requisito.store'
    ])->middleware('auth');
               
    Route::put('rev_requisito/{revRequisito}', [
        'uses'=>'RevRequisitosController@update',
        'middleware'=>'permission:rev_requisitos.rev_requisito.update',
        'as'=>'rev_requisitos.rev_requisito.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/rev_requisito/{revRequisito}',[
        'uses'=>'RevRequisitosController@destroy',
        'middleware'=>'permission:rev_requisitos.rev_requisito.destroy',
        'as'=>'rev_requisitos.rev_requisito.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'meses',
], function () {

    Route::get('/', [
        'uses'=>'MesesController@index',
        'middleware'=>'permission:meses.meses.index',
        'as'=>'meses.meses.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'MesesController@create',
        'middleware'=> 'permission:meses.meses.create',
        'as'=>'meses.meses.create'
    ])->middleware('auth');

    Route::get('/show/{meses}',[
        'uses'=>'MesesController@show',
        'middleware'=>'permission:meses.meses.show',
        'as'=>'meses.meses.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{meses}/edit',[
        'uses'=>'MesesController@edit',
        'middleware'=>'permission:meses.meses.edit',
        'as'=>'meses.meses.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'MesesController@store',
        'middleware'=>'permission:meses.meses.store',
        'as'=>'meses.meses.store'
    ])->middleware('auth');
               
    Route::put('meses/{meses}', [
        'uses'=>'MesesController@update',
        'middleware'=>'permission:meses.meses.update',
        'as'=>'meses.meses.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/meses/{meses}',[
        'uses'=>'MesesController@destroy',
        'middleware'=>'permission:meses.meses.destroy',
        'as'=>'meses.meses.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'rev_requisitos_lns',
], function () {

    Route::get('/', [
        'uses'=>'RevRequisitosLnsController@index',
        'middleware'=>'permission:rev_requisitos_lns.rev_requisitos_ln.index',
        'as'=>'rev_requisitos_lns.rev_requisitos_ln.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'RevRequisitosLnsController@create',
        'middleware'=> 'permission:rev_requisitos_lns.rev_requisitos_ln.create',
        'as'=>'rev_requisitos_lns.rev_requisitos_ln.create'
    ])->middleware('auth');

    Route::get('/show/{revRequisitosLn}',[
        'uses'=>'RevRequisitosLnsController@show',
        'middleware'=>'permission:rev_requisitos_lns.rev_requisitos_ln.show',
        'as'=>'rev_requisitos_lns.rev_requisitos_ln.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/edit/{revRequisitosLn}',[
        'uses'=>'RevRequisitosLnsController@edit',
        'middleware'=>'permission:rev_requisitos_lns.rev_requisitos_ln.edit',
        'as'=>'rev_requisitos_lns.rev_requisitos_ln.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'RevRequisitosLnsController@store',
        'middleware'=>'permission:rev_requisitos_lns.rev_requisitos_ln.store',
        'as'=>'rev_requisitos_lns.rev_requisitos_ln.store'
    ])->middleware('auth');
               
    Route::put('rev_requisitos_ln/{revRequisitosLn}', [
        'uses'=>'RevRequisitosLnsController@update',
        'middleware'=>'permission:rev_requisitos_lns.rev_requisitos_ln.update',
        'as'=>'rev_requisitos_lns.rev_requisitos_ln.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/rev_requisitos_ln/{revRequisitosLn}',[
        'uses'=>'RevRequisitosLnsController@destroy',
        'middleware'=>'permission:rev_requisitos_lns.rev_requisitos_ln.destroy',
        'as'=>'rev_requisitos_lns.rev_requisitos_ln.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    Route::get('/rev_requisitos_ln/getByEnc',[
        'uses'=>'RevRequisitosLnsController@getByEnc',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'rev_requisitos_lns.rev_requisitos_ln.getByEnc'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'estatus_condiciones',
], function () {

    Route::get('/', [
        'uses'=>'EstatusCondicionesController@index',
        'middleware'=>'permission:estatus_condiciones.estatus_condicione.index',
        'as'=>'estatus_condiciones.estatus_condicione.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'EstatusCondicionesController@create',
        'middleware'=> 'permission:estatus_condiciones.estatus_condicione.create',
        'as'=>'estatus_condiciones.estatus_condicione.create'
    ])->middleware('auth');

    Route::get('/show/{estatusCondicione}',[
        'uses'=>'EstatusCondicionesController@show',
        'middleware'=>'permission:estatus_condiciones.estatus_condicione.show',
        'as'=>'estatus_condiciones.estatus_condicione.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{estatusCondicione}/edit',[
        'uses'=>'EstatusCondicionesController@edit',
        'middleware'=>'permission:estatus_condiciones.estatus_condicione.edit',
        'as'=>'estatus_condiciones.estatus_condicione.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'EstatusCondicionesController@store',
        'middleware'=>'permission:estatus_condiciones.estatus_condicione.store',
        'as'=>'estatus_condiciones.estatus_condicione.store'
    ])->middleware('auth');
               
    Route::put('estatus_condicione/{estatusCondicione}', [
        'uses'=>'EstatusCondicionesController@update',
        'middleware'=>'permission:estatus_condiciones.estatus_condicione.update',
        'as'=>'estatus_condiciones.estatus_condicione.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/estatus_condicione/{estatusCondicione}',[
        'uses'=>'EstatusCondicionesController@destroy',
        'middleware'=>'permission:estatus_condiciones.estatus_condicione.destroy',
        'as'=>'estatus_condiciones.estatus_condicione.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'importancia',
], function () {

    Route::get('/', [
        'uses'=>'ImportanciaController@index',
        'middleware'=>'permission:importancia.importancium.index',
        'as'=>'importancia.importancium.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ImportanciaController@create',
        'middleware'=> 'permission:importancia.importancium.create',
        'as'=>'importancia.importancium.create'
    ])->middleware('auth');

    Route::get('/show/{importancium}',[
        'uses'=>'ImportanciaController@show',
        'middleware'=>'permission:importancia.importancium.show',
        'as'=>'importancia.importancium.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{importancium}/edit',[
        'uses'=>'ImportanciaController@edit',
        'middleware'=>'permission:importancia.importancium.edit',
        'as'=>'importancia.importancium.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ImportanciaController@store',
        'middleware'=>'permission:importancia.importancium.store',
        'as'=>'importancia.importancium.store'
    ])->middleware('auth');
               
    Route::put('importancium/{importancium}', [
        'uses'=>'ImportanciaController@update',
        'middleware'=>'permission:importancia.importancium.update',
        'as'=>'importancia.importancium.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/importancium/{importancium}',[
        'uses'=>'ImportanciaController@destroy',
        'middleware'=>'permission:importancia.importancium.destroy',
        'as'=>'importancia.importancium.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'rev_documentals',
], function () {

    Route::get('/', [
        'uses'=>'RevDocumentalsController@index',
        'middleware'=>'permission:rev_documentals.rev_documental.index',
        'as'=>'rev_documentals.rev_documental.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'RevDocumentalsController@create',
        'middleware'=> 'permission:rev_documentals.rev_documental.create',
        'as'=>'rev_documentals.rev_documental.create'
    ])->middleware('auth');

    Route::get('/show/{revDocumental}',[
        'uses'=>'RevDocumentalsController@show',
        'middleware'=>'permission:rev_documentals.rev_documental.show',
        'as'=>'rev_documentals.rev_documental.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{revDocumental}/edit',[
        'uses'=>'RevDocumentalsController@edit',
        'middleware'=>'permission:rev_documentals.rev_documental.edit',
        'as'=>'rev_documentals.rev_documental.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'RevDocumentalsController@store',
        'middleware'=>'permission:rev_documentals.rev_documental.store',
        'as'=>'rev_documentals.rev_documental.store'
    ])->middleware('auth');
               
    Route::put('rev_documental/{revDocumental}', [
        'uses'=>'RevDocumentalsController@update',
        'middleware'=>'permission:rev_documentals.rev_documental.update',
        'as'=>'rev_documentals.rev_documental.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/rev_documental/{revDocumental}',[
        'uses'=>'RevDocumentalsController@destroy',
        'middleware'=>'permission:rev_documentals.rev_documental.destroy',
        'as'=>'rev_documentals.rev_documental.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'rev_documental_lns',
], function () {

    Route::get('/', [
        'uses'=>'RevDocumentalLnsController@index',
        'middleware'=>'permission:rev_documental_lns.rev_documental_ln.index',
        'as'=>'rev_documental_lns.rev_documental_ln.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'RevDocumentalLnsController@create',
        'middleware'=> 'permission:rev_documental_lns.rev_documental_ln.create',
        'as'=>'rev_documental_lns.rev_documental_ln.create'
    ])->middleware('auth');

    Route::get('/show/{revDocumentalLn}',[
        'uses'=>'RevDocumentalLnsController@show',
        'middleware'=>'permission:rev_documental_lns.rev_documental_ln.show',
        'as'=>'rev_documental_lns.rev_documental_ln.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/edit/{revDocumentalLn}',[
        'uses'=>'RevDocumentalLnsController@edit',
        'middleware'=>'permission:rev_documental_lns.rev_documental_ln.edit',
        'as'=>'rev_documental_lns.rev_documental_ln.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'RevDocumentalLnsController@store',
        'middleware'=>'permission:rev_documental_lns.rev_documental_ln.store',
        'as'=>'rev_documental_lns.rev_documental_ln.store'
    ])->middleware('auth');
               
    Route::put('rev_documental_ln/{revDocumentalLn}', [
        'uses'=>'RevDocumentalLnsController@update',
        'middleware'=>'permission:rev_documental_lns.rev_documental_ln.update',
        'as'=>'rev_documental_lns.rev_documental_ln.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/rev_documental_ln/{revDocumentalLn}',[
        'uses'=>'RevDocumentalLnsController@destroy',
        'middleware'=>'permission:rev_documental_lns.rev_documental_ln.destroy',
        'as'=>'rev_documental_lns.rev_documental_ln.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    Route::get('/rev_documental_ln/getByEnc',[
        'uses'=>'RevDocumentalLnsController@getByEnc',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'rev_documental_lns.rev_documental_ln.getByEnc'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'estatus_requisitos',
], function () {

    Route::get('/', [
        'uses'=>'EstatusRequisitosController@index',
        'middleware'=>'permission:estatus_requisitos.estatus_requisito.index',
        'as'=>'estatus_requisitos.estatus_requisito.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'EstatusRequisitosController@create',
        'middleware'=> 'permission:estatus_requisitos.estatus_requisito.create',
        'as'=>'estatus_requisitos.estatus_requisito.create'
    ])->middleware('auth');

    Route::get('/show/{estatusRequisito}',[
        'uses'=>'EstatusRequisitosController@show',
        'middleware'=>'permission:estatus_requisitos.estatus_requisito.show',
        'as'=>'estatus_requisitos.estatus_requisito.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{estatusRequisito}/edit',[
        'uses'=>'EstatusRequisitosController@edit',
        'middleware'=>'permission:estatus_requisitos.estatus_requisito.edit',
        'as'=>'estatus_requisitos.estatus_requisito.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'EstatusRequisitosController@store',
        'middleware'=>'permission:estatus_requisitos.estatus_requisito.store',
        'as'=>'estatus_requisitos.estatus_requisito.store'
    ])->middleware('auth');
               
    Route::put('estatus_requisito/{estatusRequisito}', [
        'uses'=>'EstatusRequisitosController@update',
        'middleware'=>'permission:estatus_requisitos.estatus_requisito.update',
        'as'=>'estatus_requisitos.estatus_requisito.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/estatus_requisito/{estatusRequisito}',[
        'uses'=>'EstatusRequisitosController@destroy',
        'middleware'=>'permission:estatus_requisitos.estatus_requisito.destroy',
        'as'=>'estatus_requisitos.estatus_requisito.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'm_mantenimientos',
], function () {

    Route::get('/', [
        'uses'=>'MMantenimientosController@index',
        'middleware'=>'permission:m_mantenimientos.m_mantenimiento.index',
        'as'=>'m_mantenimientos.m_mantenimiento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'MMantenimientosController@create',
        'middleware'=> 'permission:m_mantenimientos.m_mantenimiento.create',
        'as'=>'m_mantenimientos.m_mantenimiento.create'
    ])->middleware('auth');

    Route::get('/show/{mMantenimiento}',[
        'uses'=>'MMantenimientosController@show',
        'middleware'=>'permission:m_mantenimientos.m_mantenimiento.show',
        'as'=>'m_mantenimientos.m_mantenimiento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{mMantenimiento}/edit',[
        'uses'=>'MMantenimientosController@edit',
        'middleware'=>'permission:m_mantenimientos.m_mantenimiento.edit',
        'as'=>'m_mantenimientos.m_mantenimiento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'MMantenimientosController@store',
        'middleware'=>'permission:m_mantenimientos.m_mantenimiento.store',
        'as'=>'m_mantenimientos.m_mantenimiento.store'
    ])->middleware('auth');
               
    Route::put('m_mantenimiento/{mMantenimiento}', [
        'uses'=>'MMantenimientosController@update',
        'middleware'=>'permission:m_mantenimientos.m_mantenimiento.update',
        'as'=>'m_mantenimientos.m_mantenimiento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/m_mantenimiento/{mMantenimiento}',[
        'uses'=>'MMantenimientosController@destroy',
        'middleware'=>'permission:m_mantenimientos.m_mantenimiento.destroy',
        'as'=>'m_mantenimientos.m_mantenimiento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/conEquipo',[
        'uses'=>'MMantenimientosController@conEquipo',
        //'middleware'=>'permission:m_mantenimientos.m_mantenimiento.conEquipo',
        'as'=>'m_mantenimientos.m_mantenimiento.conEquipo'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/conSubequipo', array(
        'as' => 'm_mantenimientos.m_mantenimiento.conSubequipo',
        'uses' => 'MMantenimientosController@conSubequipo')
    );
    Route::get('/reporte/{id}', [
        'uses'=>'MMantenimientosController@rptFormato',
        //'middleware'=>'permission:m_mantenimientos.m_mantenimiento.index',
        'as'=>'m_mantenimientos.m_mantenimiento.reporte'
    ])->middleware('auth');
});

Route::group(
[
    'prefix' => 'm_estatuses',
], function () {

    Route::get('/', [
        'uses'=>'MEstatusesController@index',
        'middleware'=>'permission:m_estatuses.m_estatus.index',
        'as'=>'m_estatuses.m_estatus.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'MEstatusesController@create',
        'middleware'=> 'permission:m_estatuses.m_estatus.create',
        'as'=>'m_estatuses.m_estatus.create'
    ])->middleware('auth');

    Route::get('/show/{mEstatus}',[
        'uses'=>'MEstatusesController@show',
        'middleware'=>'permission:m_estatuses.m_estatus.show',
        'as'=>'m_estatuses.m_estatus.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{mEstatus}/edit',[
        'uses'=>'MEstatusesController@edit',
        'middleware'=>'permission:m_estatuses.m_estatus.edit',
        'as'=>'m_estatuses.m_estatus.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'MEstatusesController@store',
        'middleware'=>'permission:m_estatuses.m_estatus.store',
        'as'=>'m_estatuses.m_estatus.store'
    ])->middleware('auth');
               
    Route::put('m_estatus/{mEstatus}', [
        'uses'=>'MEstatusesController@update',
        'middleware'=>'permission:m_estatuses.m_estatus.update',
        'as'=>'m_estatuses.m_estatus.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/m_estatus/{mEstatus}',[
        'uses'=>'MEstatusesController@destroy',
        'middleware'=>'permission:m_estatuses.m_estatus.destroy',
        'as'=>'m_estatuses.m_estatus.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'a_procedimientos',
], function () {

    Route::get('/', [
        'uses'=>'AProcedimientosController@index',
        'middleware'=>'permission:a_procedimientos.a_procedimiento.index',
        'as'=>'a_procedimientos.a_procedimiento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AProcedimientosController@create',
        'middleware'=> 'permission:a_procedimientos.a_procedimiento.create',
        'as'=>'a_procedimientos.a_procedimiento.create'
    ])->middleware('auth');

    Route::get('/show/{aProcedimiento}',[
        'uses'=>'AProcedimientosController@show',
        'middleware'=>'permission:a_procedimientos.a_procedimiento.show',
        'as'=>'a_procedimientos.a_procedimiento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aProcedimiento}/edit',[
        'uses'=>'AProcedimientosController@edit',
        'middleware'=>'permission:a_procedimientos.a_procedimiento.edit',
        'as'=>'a_procedimientos.a_procedimiento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AProcedimientosController@store',
        'middleware'=>'permission:a_procedimientos.a_procedimiento.store',
        'as'=>'a_procedimientos.a_procedimiento.store'
    ])->middleware('auth');
               
    Route::put('a_procedimiento/{aProcedimiento}', [
        'uses'=>'AProcedimientosController@update',
        'middleware'=>'permission:a_procedimientos.a_procedimiento.update',
        'as'=>'a_procedimientos.a_procedimiento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/a_procedimiento/{aProcedimiento}',[
        'uses'=>'AProcedimientosController@destroy',
        'middleware'=>'permission:a_procedimientos.a_procedimiento.destroy',
        'as'=>'a_procedimientos.a_procedimiento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'a_st_archivos',
], function () {

    Route::get('/', [
        'uses'=>'AStArchivosController@index',
        'middleware'=>'permission:a_st_archivos.a_st_archivo.index',
        'as'=>'a_st_archivos.a_st_archivo.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AStArchivosController@create',
        'middleware'=> 'permission:a_st_archivos.a_st_archivo.create',
        'as'=>'a_st_archivos.a_st_archivo.create'
    ])->middleware('auth');

    Route::get('/show/{aStArchivo}',[
        'uses'=>'AStArchivosController@show',
        'middleware'=>'permission:a_st_archivos.a_st_archivo.show',
        'as'=>'a_st_archivos.a_st_archivo.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aStArchivo}/edit',[
        'uses'=>'AStArchivosController@edit',
        'middleware'=>'permission:a_st_archivos.a_st_archivo.edit',
        'as'=>'a_st_archivos.a_st_archivo.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AStArchivosController@store',
        'middleware'=>'permission:a_st_archivos.a_st_archivo.store',
        'as'=>'a_st_archivos.a_st_archivo.store'
    ])->middleware('auth');
               
    Route::put('a_st_archivo/{aStArchivo}', [
        'uses'=>'AStArchivosController@update',
        'middleware'=>'permission:a_st_archivos.a_st_archivo.update',
        'as'=>'a_st_archivos.a_st_archivo.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/a_st_archivo/{aStArchivo}',[
        'uses'=>'AStArchivosController@destroy',
        'middleware'=>'permission:a_st_archivos.a_st_archivo.destroy',
        'as'=>'a_st_archivos.a_st_archivo.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'a_archivos',
], function () {

    Route::get('/', [
        'uses'=>'AArchivosController@index',
        'middleware'=>'permission:a_archivos.a_archivo.index',
        'as'=>'a_archivos.a_archivo.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AArchivosController@create',
        'middleware'=> 'permission:a_archivos.a_archivo.create',
        'as'=>'a_archivos.a_archivo.create'
    ])->middleware('auth');

    Route::get('/show/{aArchivo}',[
        'uses'=>'AArchivosController@show',
        'middleware'=>'permission:a_archivos.a_archivo.show',
        'as'=>'a_archivos.a_archivo.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aArchivo}/edit',[
        'uses'=>'AArchivosController@edit',
        'middleware'=>'permission:a_archivos.a_archivo.edit',
        'as'=>'a_archivos.a_archivo.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AArchivosController@store',
        'middleware'=>'permission:a_archivos.a_archivo.store',
        'as'=>'a_archivos.a_archivo.store'
    ])->middleware('auth');
               
    Route::put('a_archivo/{aArchivo}', [
        'uses'=>'AArchivosController@update',
        'middleware'=>'permission:a_archivos.a_archivo.update',
        'as'=>'a_archivos.a_archivo.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/a_archivo/{aArchivo}',[
        'uses'=>'AArchivosController@destroy',
        'middleware'=>'permission:a_archivos.a_archivo.destroy',
        'as'=>'a_archivos.a_archivo.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'a_rr_ambientales',
], function () {

    Route::get('/', [
        'uses'=>'ARrAmbientalesController@index',
        'middleware'=>'permission:a_rr_ambientales.a_rr_ambientale.index',
        'as'=>'a_rr_ambientales.a_rr_ambientale.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ARrAmbientalesController@create',
        'middleware'=> 'permission:a_rr_ambientales.a_rr_ambientale.create',
        'as'=>'a_rr_ambientales.a_rr_ambientale.create'
    ])->middleware('auth');

    Route::get('/show/{aRrAmbientale}',[
        'uses'=>'ARrAmbientalesController@show',
        'middleware'=>'permission:a_rr_ambientales.a_rr_ambientale.show',
        'as'=>'a_rr_ambientales.a_rr_ambientale.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aRrAmbientale}/edit',[
        'uses'=>'ARrAmbientalesController@edit',
        'middleware'=>'permission:a_rr_ambientales.a_rr_ambientale.edit',
        'as'=>'a_rr_ambientales.a_rr_ambientale.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ARrAmbientalesController@store',
        'middleware'=>'permission:a_rr_ambientales.a_rr_ambientale.store',
        'as'=>'a_rr_ambientales.a_rr_ambientale.store'
    ])->middleware('auth');
               
    Route::put('a_rr_ambientale/{aRrAmbientale}', [
        'uses'=>'ARrAmbientalesController@update',
        'middleware'=>'permission:a_rr_ambientales.a_rr_ambientale.update',
        'as'=>'a_rr_ambientales.a_rr_ambientale.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/a_rr_ambientale/{aRrAmbientale}',[
        'uses'=>'ARrAmbientalesController@destroy',
        'middleware'=>'permission:a_rr_ambientales.a_rr_ambientale.destroy',
        'as'=>'a_rr_ambientales.a_rr_ambientale.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'a_no_conformidades',
], function () {

    Route::get('/', [
        'uses'=>'ANoConformidadesController@index',
        'middleware'=>'permission:a_no_conformidades.a_no_conformidade.index',
        'as'=>'a_no_conformidades.a_no_conformidade.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ANoConformidadesController@create',
        'middleware'=> 'permission:a_no_conformidades.a_no_conformidade.create',
        'as'=>'a_no_conformidades.a_no_conformidade.create'
    ])->middleware('auth');

    Route::get('/show/{aNoConformidade}',[
        'uses'=>'ANoConformidadesController@show',
        'middleware'=>'permission:a_no_conformidades.a_no_conformidade.show',
        'as'=>'a_no_conformidades.a_no_conformidade.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aNoConformidade}/edit',[
        'uses'=>'ANoConformidadesController@edit',
        'middleware'=>'permission:a_no_conformidades.a_no_conformidade.edit',
        'as'=>'a_no_conformidades.a_no_conformidade.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ANoConformidadesController@store',
        'middleware'=>'permission:a_no_conformidades.a_no_conformidade.store',
        'as'=>'a_no_conformidades.a_no_conformidade.store'
    ])->middleware('auth');
               
    Route::put('a_no_conformidade/{aNoConformidade}', [
        'uses'=>'ANoConformidadesController@update',
        'middleware'=>'permission:a_no_conformidades.a_no_conformidade.update',
        'as'=>'a_no_conformidades.a_no_conformidade.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/a_no_conformidade/{aNoConformidade}',[
        'uses'=>'ANoConformidadesController@destroy',
        'middleware'=>'permission:a_no_conformidades.a_no_conformidade.destroy',
        'as'=>'a_no_conformidades.a_no_conformidade.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'cs_tpo_deteccions',
], function () {

    Route::get('/', [
        'uses'=>'CsTpoDeteccionsController@index',
        'middleware'=>'permission:cs_tpo_deteccions.cs_tpo_deteccion.index',
        'as'=>'cs_tpo_deteccions.cs_tpo_deteccion.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CsTpoDeteccionsController@create',
        'middleware'=> 'permission:cs_tpo_deteccions.cs_tpo_deteccion.create',
        'as'=>'cs_tpo_deteccions.cs_tpo_deteccion.create'
    ])->middleware('auth');

    Route::get('/show/{csTpoDeteccion}',[
        'uses'=>'CsTpoDeteccionsController@show',
        'middleware'=>'permission:cs_tpo_deteccions.cs_tpo_deteccion.show',
        'as'=>'cs_tpo_deteccions.cs_tpo_deteccion.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{csTpoDeteccion}/edit',[
        'uses'=>'CsTpoDeteccionsController@edit',
        'middleware'=>'permission:cs_tpo_deteccions.cs_tpo_deteccion.edit',
        'as'=>'cs_tpo_deteccions.cs_tpo_deteccion.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CsTpoDeteccionsController@store',
        'middleware'=>'permission:cs_tpo_deteccions.cs_tpo_deteccion.store',
        'as'=>'cs_tpo_deteccions.cs_tpo_deteccion.store'
    ])->middleware('auth');
               
    Route::put('cs_tpo_deteccion/{csTpoDeteccion}', [
        'uses'=>'CsTpoDeteccionsController@update',
        'middleware'=>'permission:cs_tpo_deteccions.cs_tpo_deteccion.update',
        'as'=>'cs_tpo_deteccions.cs_tpo_deteccion.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/cs_tpo_deteccion/{csTpoDeteccion}',[
        'uses'=>'CsTpoDeteccionsController@destroy',
        'middleware'=>'permission:cs_tpo_deteccions.cs_tpo_deteccion.destroy',
        'as'=>'cs_tpo_deteccions.cs_tpo_deteccion.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'a_st_ncs',
], function () {

    Route::get('/', [
        'uses'=>'AStNcsController@index',
        'middleware'=>'permission:a_st_ncs.a_st_nc.index',
        'as'=>'a_st_ncs.a_st_nc.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AStNcsController@create',
        'middleware'=> 'permission:a_st_ncs.a_st_nc.create',
        'as'=>'a_st_ncs.a_st_nc.create'
    ])->middleware('auth');

    Route::get('/show/{aStNc}',[
        'uses'=>'AStNcsController@show',
        'middleware'=>'permission:a_st_ncs.a_st_nc.show',
        'as'=>'a_st_ncs.a_st_nc.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aStNc}/edit',[
        'uses'=>'AStNcsController@edit',
        'middleware'=>'permission:a_st_ncs.a_st_nc.edit',
        'as'=>'a_st_ncs.a_st_nc.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AStNcsController@store',
        'middleware'=>'permission:a_st_ncs.a_st_nc.store',
        'as'=>'a_st_ncs.a_st_nc.store'
    ])->middleware('auth');
               
    Route::put('a_st_nc/{aStNc}', [
        'uses'=>'AStNcsController@update',
        'middleware'=>'permission:a_st_ncs.a_st_nc.update',
        'as'=>'a_st_ncs.a_st_nc.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/a_st_nc/{aStNc}',[
        'uses'=>'AStNcsController@destroy',
        'middleware'=>'permission:a_st_ncs.a_st_nc.destroy',
        'as'=>'a_st_ncs.a_st_nc.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'bitacora_ffs',
], function () {

    Route::get('/', [
        'uses'=>'BitacoraFfsController@index',
        'middleware'=>'permission:bitacora_ffs.bitacora_ff.index',
        'as'=>'bitacora_ffs.bitacora_ff.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'BitacoraFfsController@create',
        'middleware'=> 'permission:bitacora_ffs.bitacora_ff.create',
        'as'=>'bitacora_ffs.bitacora_ff.create'
    ])->middleware('auth');

    Route::get('/show/{bitacoraFf}',[
        'uses'=>'BitacoraFfsController@show',
        'middleware'=>'permission:bitacora_ffs.bitacora_ff.show',
        'as'=>'bitacora_ffs.bitacora_ff.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{bitacoraFf}/edit',[
        'uses'=>'BitacoraFfsController@edit',
        'middleware'=>'permission:bitacora_ffs.bitacora_ff.edit',
        'as'=>'bitacora_ffs.bitacora_ff.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'BitacoraFfsController@store',
        'middleware'=>'permission:bitacora_ffs.bitacora_ff.store',
        'as'=>'bitacora_ffs.bitacora_ff.store'
    ])->middleware('auth');
               
    Route::put('bitacora_ff/{bitacoraFf}', [
        'uses'=>'BitacoraFfsController@update',
        'middleware'=>'permission:bitacora_ffs.bitacora_ff.update',
        'as'=>'bitacora_ffs.bitacora_ff.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/bitacora_ff/{bitacoraFf}',[
        'uses'=>'BitacoraFfsController@destroy',
        'middleware'=>'permission:bitacora_ffs.bitacora_ff.destroy',
        'as'=>'bitacora_ffs.bitacora_ff.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'turnos',
], function () {

    Route::get('/', [
        'uses'=>'TurnosController@index',
        'middleware'=>'permission:turnos.turno.index',
        'as'=>'turnos.turno.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'TurnosController@create',
        'middleware'=> 'permission:turnos.turno.create',
        'as'=>'turnos.turno.create'
    ])->middleware('auth');

    Route::get('/show/{turno}',[
        'uses'=>'TurnosController@show',
        'middleware'=>'permission:turnos.turno.show',
        'as'=>'turnos.turno.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{turno}/edit',[
        'uses'=>'TurnosController@edit',
        'middleware'=>'permission:turnos.turno.edit',
        'as'=>'turnos.turno.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'TurnosController@store',
        'middleware'=>'permission:turnos.turno.store',
        'as'=>'turnos.turno.store'
    ])->middleware('auth');
               
    Route::put('turno/{turno}', [
        'uses'=>'TurnosController@update',
        'middleware'=>'permission:turnos.turno.update',
        'as'=>'turnos.turno.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/turno/{turno}',[
        'uses'=>'TurnosController@destroy',
        'middleware'=>'permission:turnos.turno.destroy',
        'as'=>'turnos.turno.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'bitacora_plantas',
], function () {

    Route::get('/', [
        'uses'=>'BitacoraPlantasController@index',
        'middleware'=>'permission:bitacora_plantas.bitacora_planta.index',
        'as'=>'bitacora_plantas.bitacora_planta.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'BitacoraPlantasController@create',
        'middleware'=> 'permission:bitacora_plantas.bitacora_planta.create',
        'as'=>'bitacora_plantas.bitacora_planta.create'
    ])->middleware('auth');

    Route::get('/show/{bitacoraPlanta}',[
        'uses'=>'BitacoraPlantasController@show',
        'middleware'=>'permission:bitacora_plantas.bitacora_planta.show',
        'as'=>'bitacora_plantas.bitacora_planta.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{bitacoraPlanta}/edit',[
        'uses'=>'BitacoraPlantasController@edit',
        'middleware'=>'permission:bitacora_plantas.bitacora_planta.edit',
        'as'=>'bitacora_plantas.bitacora_planta.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'BitacoraPlantasController@store',
        'middleware'=>'permission:bitacora_plantas.bitacora_planta.store',
        'as'=>'bitacora_plantas.bitacora_planta.store'
    ])->middleware('auth');
               
    Route::put('bitacora_planta/{bitacoraPlanta}', [
        'uses'=>'BitacoraPlantasController@update',
        'middleware'=>'permission:bitacora_plantas.bitacora_planta.update',
        'as'=>'bitacora_plantas.bitacora_planta.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/bitacora_planta/{bitacoraPlanta}',[
        'uses'=>'BitacoraPlantasController@destroy',
        'middleware'=>'permission:bitacora_plantas.bitacora_planta.destroy',
        'as'=>'bitacora_plantas.bitacora_planta.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'bitacora_residuos',
], function () {

    Route::get('/', [
        'uses'=>'BitacoraResiduosController@index',
        'middleware'=>'permission:bitacora_residuos.bitacora_residuo.index',
        'as'=>'bitacora_residuos.bitacora_residuo.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'BitacoraResiduosController@create',
        'middleware'=> 'permission:bitacora_residuos.bitacora_residuo.create',
        'as'=>'bitacora_residuos.bitacora_residuo.create'
    ])->middleware('auth');

    Route::get('/show/{bitacoraResiduo}',[
        'uses'=>'BitacoraResiduosController@show',
        'middleware'=>'permission:bitacora_residuos.bitacora_residuo.show',
        'as'=>'bitacora_residuos.bitacora_residuo.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{bitacoraResiduo}/edit',[
        'uses'=>'BitacoraResiduosController@edit',
        'middleware'=>'permission:bitacora_residuos.bitacora_residuo.edit',
        'as'=>'bitacora_residuos.bitacora_residuo.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'BitacoraResiduosController@store',
        'middleware'=>'permission:bitacora_residuos.bitacora_residuo.store',
        'as'=>'bitacora_residuos.bitacora_residuo.store'
    ])->middleware('auth');
               
    Route::put('bitacora_residuo/{bitacoraResiduo}', [
        'uses'=>'BitacoraResiduosController@update',
        'middleware'=>'permission:bitacora_residuos.bitacora_residuo.update',
        'as'=>'bitacora_residuos.bitacora_residuo.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/bitacora_residuo/{bitacoraResiduo}',[
        'uses'=>'BitacoraResiduosController@destroy',
        'middleware'=>'permission:bitacora_residuos.bitacora_residuo.destroy',
        'as'=>'bitacora_residuos.bitacora_residuo.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'bitacora_consumibles',
], function () {

    Route::get('/', [
        'uses'=>'BitacoraConsumiblesController@index',
        'middleware'=>'permission:bitacora_consumibles.bitacora_consumible.index',
        'as'=>'bitacora_consumibles.bitacora_consumible.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'BitacoraConsumiblesController@create',
        'middleware'=> 'permission:bitacora_consumibles.bitacora_consumible.create',
        'as'=>'bitacora_consumibles.bitacora_consumible.create'
    ])->middleware('auth');

    Route::get('/show/{bitacoraConsumible}',[
        'uses'=>'BitacoraConsumiblesController@show',
        'middleware'=>'permission:bitacora_consumibles.bitacora_consumible.show',
        'as'=>'bitacora_consumibles.bitacora_consumible.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{bitacoraConsumible}/edit',[
        'uses'=>'BitacoraConsumiblesController@edit',
        'middleware'=>'permission:bitacora_consumibles.bitacora_consumible.edit',
        'as'=>'bitacora_consumibles.bitacora_consumible.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'BitacoraConsumiblesController@store',
        'middleware'=>'permission:bitacora_consumibles.bitacora_consumible.store',
        'as'=>'bitacora_consumibles.bitacora_consumible.store'
    ])->middleware('auth');
               
    Route::put('bitacora_consumible/{bitacoraConsumible}', [
        'uses'=>'BitacoraConsumiblesController@update',
        'middleware'=>'permission:bitacora_consumibles.bitacora_consumible.update',
        'as'=>'bitacora_consumibles.bitacora_consumible.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/bitacora_consumible/{bitacoraConsumible}',[
        'uses'=>'BitacoraConsumiblesController@destroy',
        'middleware'=>'permission:bitacora_consumibles.bitacora_consumible.destroy',
        'as'=>'bitacora_consumibles.bitacora_consumible.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'bitacora_pendientes',
], function () {

    Route::get('/', [
        'uses'=>'BitacoraPendientesController@index',
        'middleware'=>'permission:bitacora_pendientes.bitacora_pendiente.index',
        'as'=>'bitacora_pendientes.bitacora_pendiente.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'BitacoraPendientesController@create',
        'middleware'=> 'permission:bitacora_pendientes.bitacora_pendiente.create',
        'as'=>'bitacora_pendientes.bitacora_pendiente.create'
    ])->middleware('auth');

    Route::get('/show/{bitacoraPendiente}',[
        'uses'=>'BitacoraPendientesController@show',
        'middleware'=>'permission:bitacora_pendientes.bitacora_pendiente.show',
        'as'=>'bitacora_pendientes.bitacora_pendiente.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{bitacoraPendiente}/edit',[
        'uses'=>'BitacoraPendientesController@edit',
        'middleware'=>'permission:bitacora_pendientes.bitacora_pendiente.edit',
        'as'=>'bitacora_pendientes.bitacora_pendiente.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'BitacoraPendientesController@store',
        'middleware'=>'permission:bitacora_pendientes.bitacora_pendiente.store',
        'as'=>'bitacora_pendientes.bitacora_pendiente.store'
    ])->middleware('auth');
               
    Route::put('bitacora_pendiente/{bitacoraPendiente}', [
        'uses'=>'BitacoraPendientesController@update',
        'middleware'=>'permission:bitacora_pendientes.bitacora_pendiente.update',
        'as'=>'bitacora_pendientes.bitacora_pendiente.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/bitacora_pendiente/{bitacoraPendiente}',[
        'uses'=>'BitacoraPendientesController@destroy',
        'middleware'=>'permission:bitacora_pendientes.bitacora_pendiente.destroy',
        'as'=>'bitacora_pendientes.bitacora_pendiente.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'bit_sts',
], function () {

    Route::get('/', [
        'uses'=>'BitStsController@index',
        'middleware'=>'permission:bit_sts.bit_st.index',
        'as'=>'bit_sts.bit_st.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'BitStsController@create',
        'middleware'=> 'permission:bit_sts.bit_st.create',
        'as'=>'bit_sts.bit_st.create'
    ])->middleware('auth');

    Route::get('/show/{bitSt}',[
        'uses'=>'BitStsController@show',
        'middleware'=>'permission:bit_sts.bit_st.show',
        'as'=>'bit_sts.bit_st.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{bitSt}/edit',[
        'uses'=>'BitStsController@edit',
        'middleware'=>'permission:bit_sts.bit_st.edit',
        'as'=>'bit_sts.bit_st.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'BitStsController@store',
        'middleware'=>'permission:bit_sts.bit_st.store',
        'as'=>'bit_sts.bit_st.store'
    ])->middleware('auth');
               
    Route::put('bit_st/{bitSt}', [
        'uses'=>'BitStsController@update',
        'middleware'=>'permission:bit_sts.bit_st.update',
        'as'=>'bit_sts.bit_st.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/bit_st/{bitSt}',[
        'uses'=>'BitStsController@destroy',
        'middleware'=>'permission:bit_sts.bit_st.destroy',
        'as'=>'bit_sts.bit_st.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'bitacora_accidentes',
], function () {

    Route::get('/', [
        'uses'=>'BitacoraAccidentesController@index',
        'middleware'=>'permission:bitacora_accidentes.bitacora_accidente.index',
        'as'=>'bitacora_accidentes.bitacora_accidente.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'BitacoraAccidentesController@create',
        'middleware'=> 'permission:bitacora_accidentes.bitacora_accidente.create',
        'as'=>'bitacora_accidentes.bitacora_accidente.create'
    ])->middleware('auth');

    Route::get('/show/{bitacoraAccidente}',[
        'uses'=>'BitacoraAccidentesController@show',
        'middleware'=>'permission:bitacora_accidentes.bitacora_accidente.show',
        'as'=>'bitacora_accidentes.bitacora_accidente.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{bitacoraAccidente}/edit',[
        'uses'=>'BitacoraAccidentesController@edit',
        'middleware'=>'permission:bitacora_accidentes.bitacora_accidente.edit',
        'as'=>'bitacora_accidentes.bitacora_accidente.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'BitacoraAccidentesController@store',
        'middleware'=>'permission:bitacora_accidentes.bitacora_accidente.store',
        'as'=>'bitacora_accidentes.bitacora_accidente.store'
    ])->middleware('auth');
               
    Route::put('bitacora_accidente/{bitacoraAccidente}', [
        'uses'=>'BitacoraAccidentesController@update',
        'middleware'=>'permission:bitacora_accidentes.bitacora_accidente.update',
        'as'=>'bitacora_accidentes.bitacora_accidente.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/bitacora_accidente/{bitacoraAccidente}',[
        'uses'=>'BitacoraAccidentesController@destroy',
        'middleware'=>'permission:bitacora_accidentes.bitacora_accidente.destroy',
        'as'=>'bitacora_accidentes.bitacora_accidente.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'bitacora_enfermedades',
], function () {

    Route::get('/', [
        'uses'=>'BitacoraEnfermedadesController@index',
        'middleware'=>'permission:bitacora_enfermedades.bitacora_enfermedade.index',
        'as'=>'bitacora_enfermedades.bitacora_enfermedade.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'BitacoraEnfermedadesController@create',
        'middleware'=> 'permission:bitacora_enfermedades.bitacora_enfermedade.create',
        'as'=>'bitacora_enfermedades.bitacora_enfermedade.create'
    ])->middleware('auth');

    Route::get('/show/{bitacoraEnfermedade}',[
        'uses'=>'BitacoraEnfermedadesController@show',
        'middleware'=>'permission:bitacora_enfermedades.bitacora_enfermedade.show',
        'as'=>'bitacora_enfermedades.bitacora_enfermedade.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{bitacoraEnfermedade}/edit',[
        'uses'=>'BitacoraEnfermedadesController@edit',
        'middleware'=>'permission:bitacora_enfermedades.bitacora_enfermedade.edit',
        'as'=>'bitacora_enfermedades.bitacora_enfermedade.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'BitacoraEnfermedadesController@store',
        'middleware'=>'permission:bitacora_enfermedades.bitacora_enfermedade.store',
        'as'=>'bitacora_enfermedades.bitacora_enfermedade.store'
    ])->middleware('auth');
               
    Route::put('bitacora_enfermedade/{bitacoraEnfermedade}', [
        'uses'=>'BitacoraEnfermedadesController@update',
        'middleware'=>'permission:bitacora_enfermedades.bitacora_enfermedade.update',
        'as'=>'bitacora_enfermedades.bitacora_enfermedade.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/bitacora_enfermedade/{bitacoraEnfermedade}',[
        'uses'=>'BitacoraEnfermedadesController@destroy',
        'middleware'=>'permission:bitacora_enfermedades.bitacora_enfermedade.destroy',
        'as'=>'bitacora_enfermedades.bitacora_enfermedade.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 's_procedimientos',
], function () {

    Route::get('/', [
        'uses'=>'SProcedimientosController@index',
        'middleware'=>'permission:s_procedimientos.s_procedimiento.index',
        'as'=>'s_procedimientos.s_procedimiento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'SProcedimientosController@create',
        'middleware'=> 'permission:s_procedimientos.s_procedimiento.create',
        'as'=>'s_procedimientos.s_procedimiento.create'
    ])->middleware('auth');

    Route::get('/show/{sProcedimiento}',[
        'uses'=>'SProcedimientosController@show',
        'middleware'=>'permission:s_procedimientos.s_procedimiento.show',
        'as'=>'s_procedimientos.s_procedimiento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{sProcedimiento}/edit',[
        'uses'=>'SProcedimientosController@edit',
        'middleware'=>'permission:s_procedimientos.s_procedimiento.edit',
        'as'=>'s_procedimientos.s_procedimiento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'SProcedimientosController@store',
        'middleware'=>'permission:s_procedimientos.s_procedimiento.store',
        'as'=>'s_procedimientos.s_procedimiento.store'
    ])->middleware('auth');
               
    Route::put('s_procedimiento/{sProcedimiento}', [
        'uses'=>'SProcedimientosController@update',
        'middleware'=>'permission:s_procedimientos.s_procedimiento.update',
        'as'=>'s_procedimientos.s_procedimiento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/s_procedimiento/{sProcedimiento}',[
        'uses'=>'SProcedimientosController@destroy',
        'middleware'=>'permission:s_procedimientos.s_procedimiento.destroy',
        'as'=>'s_procedimientos.s_procedimiento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 's_estatus_procedimientos',
], function () {

    Route::get('/', [
        'uses'=>'SEstatusProcedimientosController@index',
        'middleware'=>'permission:s_estatus_procedimientos.s_estatus_procedimiento.index',
        'as'=>'s_estatus_procedimientos.s_estatus_procedimiento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'SEstatusProcedimientosController@create',
        'middleware'=> 'permission:s_estatus_procedimientos.s_estatus_procedimiento.create',
        'as'=>'s_estatus_procedimientos.s_estatus_procedimiento.create'
    ])->middleware('auth');

    Route::get('/show/{sEstatusProcedimiento}',[
        'uses'=>'SEstatusProcedimientosController@show',
        'middleware'=>'permission:s_estatus_procedimientos.s_estatus_procedimiento.show',
        'as'=>'s_estatus_procedimientos.s_estatus_procedimiento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{sEstatusProcedimiento}/edit',[
        'uses'=>'SEstatusProcedimientosController@edit',
        'middleware'=>'permission:s_estatus_procedimientos.s_estatus_procedimiento.edit',
        'as'=>'s_estatus_procedimientos.s_estatus_procedimiento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'SEstatusProcedimientosController@store',
        'middleware'=>'permission:s_estatus_procedimientos.s_estatus_procedimiento.store',
        'as'=>'s_estatus_procedimientos.s_estatus_procedimiento.store'
    ])->middleware('auth');
               
    Route::put('s_estatus_procedimiento/{sEstatusProcedimiento}', [
        'uses'=>'SEstatusProcedimientosController@update',
        'middleware'=>'permission:s_estatus_procedimientos.s_estatus_procedimiento.update',
        'as'=>'s_estatus_procedimientos.s_estatus_procedimiento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/s_estatus_procedimiento/{sEstatusProcedimiento}',[
        'uses'=>'SEstatusProcedimientosController@destroy',
        'middleware'=>'permission:s_estatus_procedimientos.s_estatus_procedimiento.destroy',
        'as'=>'s_estatus_procedimientos.s_estatus_procedimiento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 's_registros',
], function () {

    Route::get('/', [
        'uses'=>'SRegistrosController@index',
        'middleware'=>'permission:s_registros.s_registro.index',
        'as'=>'s_registros.s_registro.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'SRegistrosController@create',
        'middleware'=> 'permission:s_registros.s_registro.create',
        'as'=>'s_registros.s_registro.create'
    ])->middleware('auth');

    Route::get('/show/{sRegistro}',[
        'uses'=>'SRegistrosController@show',
        'middleware'=>'permission:s_registros.s_registro.show',
        'as'=>'s_registros.s_registro.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{sRegistro}/edit',[
        'uses'=>'SRegistrosController@edit',
        'middleware'=>'permission:s_registros.s_registro.edit',
        'as'=>'s_registros.s_registro.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'SRegistrosController@store',
        'middleware'=>'permission:s_registros.s_registro.store',
        'as'=>'s_registros.s_registro.store'
    ])->middleware('auth');
               
    Route::put('s_registro/{sRegistro}', [
        'uses'=>'SRegistrosController@update',
        'middleware'=>'permission:s_registros.s_registro.update',
        'as'=>'s_registros.s_registro.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/s_registro/{sRegistro}',[
        'uses'=>'SRegistrosController@destroy',
        'middleware'=>'permission:s_registros.s_registro.destroy',
        'as'=>'s_registros.s_registro.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'bitacora_seguridads',
], function () {

    Route::get('/', [
        'uses'=>'BitacoraSeguridadsController@index',
        'middleware'=>'permission:bitacora_seguridads.bitacora_seguridad.index',
        'as'=>'bitacora_seguridads.bitacora_seguridad.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'BitacoraSeguridadsController@create',
        'middleware'=> 'permission:bitacora_seguridads.bitacora_seguridad.create',
        'as'=>'bitacora_seguridads.bitacora_seguridad.create'
    ])->middleware('auth');

    Route::get('/show/{bitacoraSeguridad}',[
        'uses'=>'BitacoraSeguridadsController@show',
        'middleware'=>'permission:bitacora_seguridads.bitacora_seguridad.show',
        'as'=>'bitacora_seguridads.bitacora_seguridad.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{bitacoraSeguridad}/edit',[
        'uses'=>'BitacoraSeguridadsController@edit',
        'middleware'=>'permission:bitacora_seguridads.bitacora_seguridad.edit',
        'as'=>'bitacora_seguridads.bitacora_seguridad.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'BitacoraSeguridadsController@store',
        'middleware'=>'permission:bitacora_seguridads.bitacora_seguridad.store',
        'as'=>'bitacora_seguridads.bitacora_seguridad.store'
    ])->middleware('auth');
               
    Route::put('bitacora_seguridad/{bitacoraSeguridad}', [
        'uses'=>'BitacoraSeguridadsController@update',
        'middleware'=>'permission:bitacora_seguridads.bitacora_seguridad.update',
        'as'=>'bitacora_seguridads.bitacora_seguridad.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/bitacora_seguridad/{bitacoraSeguridad}',[
        'uses'=>'BitacoraSeguridadsController@destroy',
        'middleware'=>'permission:bitacora_seguridads.bitacora_seguridad.destroy',
        'as'=>'bitacora_seguridads.bitacora_seguridad.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 's_st_bs',
], function () {

    Route::get('/', [
        'uses'=>'SStBsController@index',
        'middleware'=>'permission:s_st_bs.s_st_b.index',
        'as'=>'s_st_bs.s_st_b.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'SStBsController@create',
        'middleware'=> 'permission:s_st_bs.s_st_b.create',
        'as'=>'s_st_bs.s_st_b.create'
    ])->middleware('auth');

    Route::get('/show/{sStB}',[
        'uses'=>'SStBsController@show',
        'middleware'=>'permission:s_st_bs.s_st_b.show',
        'as'=>'s_st_bs.s_st_b.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{sStB}/edit',[
        'uses'=>'SStBsController@edit',
        'middleware'=>'permission:s_st_bs.s_st_b.edit',
        'as'=>'s_st_bs.s_st_b.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'SStBsController@store',
        'middleware'=>'permission:s_st_bs.s_st_b.store',
        'as'=>'s_st_bs.s_st_b.store'
    ])->middleware('auth');
               
    Route::put('s_st_b/{sStB}', [
        'uses'=>'SStBsController@update',
        'middleware'=>'permission:s_st_bs.s_st_b.update',
        'as'=>'s_st_bs.s_st_b.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/s_st_b/{sStB}',[
        'uses'=>'SStBsController@destroy',
        'middleware'=>'permission:s_st_bs.s_st_b.destroy',
        'as'=>'s_st_bs.s_st_b.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 's_documentos',
], function () {

    Route::get('/', [
        'uses'=>'SDocumentosController@index',
        'middleware'=>'permission:s_documentos.s_documento.index',
        'as'=>'s_documentos.s_documento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'SDocumentosController@create',
        'middleware'=> 'permission:s_documentos.s_documento.create',
        'as'=>'s_documentos.s_documento.create'
    ])->middleware('auth');

    Route::get('/show/{sDocumento}',[
        'uses'=>'SDocumentosController@show',
        'middleware'=>'permission:s_documentos.s_documento.show',
        'as'=>'s_documentos.s_documento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{sDocumento}/edit',[
        'uses'=>'SDocumentosController@edit',
        'middleware'=>'permission:s_documentos.s_documento.edit',
        'as'=>'s_documentos.s_documento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'SDocumentosController@store',
        'middleware'=>'permission:s_documentos.s_documento.store',
        'as'=>'s_documentos.s_documento.store'
    ])->middleware('auth');
               
    Route::put('s_documento/{sDocumento}', [
        'uses'=>'SDocumentosController@update',
        'middleware'=>'permission:s_documentos.s_documento.update',
        'as'=>'s_documentos.s_documento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/s_documento/{sDocumento}',[
        'uses'=>'SDocumentosController@destroy',
        'middleware'=>'permission:s_documentos.s_documento.destroy',
        'as'=>'s_documentos.s_documento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'files_s_documentos',
], function () {

    Route::get('/', [
        'uses'=>'FilesSDocumentosController@index',
        'middleware'=>'permission:files_s_documentos.files_s_documento.index',
        'as'=>'files_s_documentos.files_s_documento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'FilesSDocumentosController@create',
        'middleware'=> 'permission:files_s_documentos.files_s_documento.create',
        'as'=>'files_s_documentos.files_s_documento.create'
    ])->middleware('auth');

    Route::get('/show/{filesSDocumento}',[
        'uses'=>'FilesSDocumentosController@show',
        'middleware'=>'permission:files_s_documentos.files_s_documento.show',
        'as'=>'files_s_documentos.files_s_documento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{filesSDocumento}/edit',[
        'uses'=>'FilesSDocumentosController@edit',
        'middleware'=>'permission:files_s_documentos.files_s_documento.edit',
        'as'=>'files_s_documentos.files_s_documento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'FilesSDocumentosController@store',
        'middleware'=>'permission:files_s_documentos.files_s_documento.store',
        'as'=>'files_s_documentos.files_s_documento.store'
    ])->middleware('auth');
               
    Route::put('files_s_documento/{filesSDocumento}', [
        'uses'=>'FilesSDocumentosController@update',
        'middleware'=>'permission:files_s_documentos.files_s_documento.update',
        'as'=>'files_s_documentos.files_s_documento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/files_s_documento/{filesSDocumento}',[
        'uses'=>'FilesSDocumentosController@destroy',
        //'middleware'=>'permission:files_s_documentos.files_s_documento.destroy',
        'as'=>'files_s_documentos.files_s_documento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    Route::post('/cargaArchivo', [
        'uses'=>'FilesSDocumentosController@cargaArchivo',
        //'middleware'=>'permission:files_customers.files_customer.cargaArchivo',
        'as'=>'files_s_documentos.files_s_documento.cargaArchivo'
    ])->middleware('auth');
    Route::get('/GetFiles',[
        'uses'=>'FilesSDocumentosController@getFiles',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'files_s_documentos.files_s_documento.getFiles'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 's_comentarios_documentos',
], function () {

    Route::get('/', [
        'uses'=>'SComentariosDocumentosController@index',
        'middleware'=>'permission:s_comentarios_documentos.s_comentarios_documento.index',
        'as'=>'s_comentarios_documentos.s_comentarios_documento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'SComentariosDocumentosController@create',
        'middleware'=> 'permission:s_comentarios_documentos.s_comentarios_documento.create',
        'as'=>'s_comentarios_documentos.s_comentarios_documento.create'
    ])->middleware('auth');

    Route::get('/show/{sComentariosDocumento}',[
        'uses'=>'SComentariosDocumentosController@show',
        'middleware'=>'permission:s_comentarios_documentos.s_comentarios_documento.show',
        'as'=>'s_comentarios_documentos.s_comentarios_documento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{sComentariosDocumento}/edit',[
        'uses'=>'SComentariosDocumentosController@edit',
        'middleware'=>'permission:s_comentarios_documentos.s_comentarios_documento.edit',
        'as'=>'s_comentarios_documentos.s_comentarios_documento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'SComentariosDocumentosController@store',
        'middleware'=>'permission:s_comentarios_documentos.s_comentarios_documento.store',
        'as'=>'s_comentarios_documentos.s_comentarios_documento.store'
    ])->middleware('auth');
               
    Route::put('s_comentarios_documento/{sComentariosDocumento}', [
        'uses'=>'SComentariosDocumentosController@update',
        'middleware'=>'permission:s_comentarios_documentos.s_comentarios_documento.update',
        'as'=>'s_comentarios_documentos.s_comentarios_documento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/s_comentarios_documento/{sComentariosDocumento}',[
        'uses'=>'SComentariosDocumentosController@destroy',
        'middleware'=>'permission:s_comentarios_documentos.s_comentarios_documento.destroy',
        'as'=>'s_comentarios_documentos.s_comentarios_documento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/GetComentarios',[
        'uses'=>'SComentariosDocumentosController@getComentarios',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'s_comentarios_documentos.s_comentarios_documento.getComentarios'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'comentarios_bs',
], function () {

    Route::get('/', [
        'uses'=>'ComentariosBsController@index',
        'middleware'=>'permission:comentarios_bs.comentarios_b.index',
        'as'=>'comentarios_bs.comentarios_b.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ComentariosBsController@create',
        'middleware'=> 'permission:comentarios_bs.comentarios_b.create',
        'as'=>'comentarios_bs.comentarios_b.create'
    ])->middleware('auth');

    Route::get('/show/{comentariosB}',[
        'uses'=>'ComentariosBsController@show',
        'middleware'=>'permission:comentarios_bs.comentarios_b.show',
        'as'=>'comentarios_bs.comentarios_b.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{comentariosB}/edit',[
        'uses'=>'ComentariosBsController@edit',
        'middleware'=>'permission:comentarios_bs.comentarios_b.edit',
        'as'=>'comentarios_bs.comentarios_b.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ComentariosBsController@store',
        'middleware'=>'permission:comentarios_bs.comentarios_b.store',
        'as'=>'comentarios_bs.comentarios_b.store'
    ])->middleware('auth');
               
    Route::put('comentarios_b/{comentariosB}', [
        'uses'=>'ComentariosBsController@update',
        'middleware'=>'permission:comentarios_bs.comentarios_b.update',
        'as'=>'comentarios_bs.comentarios_b.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/comentarios_b/{comentariosB}',[
        'uses'=>'ComentariosBsController@destroy',
        'middleware'=>'permission:comentarios_bs.comentarios_b.destroy',
        'as'=>'comentarios_bs.comentarios_b.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/GetComentarios',[
        'uses'=>'ComentariosBsController@getComentarios',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'comentarios_bs.comentarios_b.getComentarios'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 's_comentarios_procedimientos',
], function () {

    Route::get('/', [
        'uses'=>'SComentariosProcedimientosController@index',
        'middleware'=>'permission:s_comentarios_procedimientos.s_comentarios_procedimiento.index',
        'as'=>'s_comentarios_procedimientos.s_comentarios_procedimiento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'SComentariosProcedimientosController@create',
        'middleware'=> 'permission:s_comentarios_procedimientos.s_comentarios_procedimiento.create',
        'as'=>'s_comentarios_procedimientos.s_comentarios_procedimiento.create'
    ])->middleware('auth');

    Route::get('/show/{sComentariosProcedimiento}',[
        'uses'=>'SComentariosProcedimientosController@show',
        'middleware'=>'permission:s_comentarios_procedimientos.s_comentarios_procedimiento.show',
        'as'=>'s_comentarios_procedimientos.s_comentarios_procedimiento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{sComentariosProcedimiento}/edit',[
        'uses'=>'SComentariosProcedimientosController@edit',
        'middleware'=>'permission:s_comentarios_procedimientos.s_comentarios_procedimiento.edit',
        'as'=>'s_comentarios_procedimientos.s_comentarios_procedimiento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'SComentariosProcedimientosController@store',
        'middleware'=>'permission:s_comentarios_procedimientos.s_comentarios_procedimiento.store',
        'as'=>'s_comentarios_procedimientos.s_comentarios_procedimiento.store'
    ])->middleware('auth');
               
    Route::put('s_comentarios_procedimiento/{sComentariosProcedimiento}', [
        'uses'=>'SComentariosProcedimientosController@update',
        'middleware'=>'permission:s_comentarios_procedimientos.s_comentarios_procedimiento.update',
        'as'=>'s_comentarios_procedimientos.s_comentarios_procedimiento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/s_comentarios_procedimiento/{sComentariosProcedimiento}',[
        'uses'=>'SComentariosProcedimientosController@destroy',
        'middleware'=>'permission:s_comentarios_procedimientos.s_comentarios_procedimiento.destroy',
        'as'=>'s_comentarios_procedimientos.s_comentarios_procedimiento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/GetComentarios',[
        'uses'=>'SComentariosProcedimientosController@getComentarios',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'s_comentarios_procedimientos.s_comentarios_procedimiento.getComentarios'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 's_comentarios_registros',
], function () {

    Route::get('/', [
        'uses'=>'SComentariosRegistrosController@index',
        'middleware'=>'permission:s_comentarios_registros.s_comentarios_registro.index',
        'as'=>'s_comentarios_registros.s_comentarios_registro.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'SComentariosRegistrosController@create',
        'middleware'=> 'permission:s_comentarios_registros.s_comentarios_registro.create',
        'as'=>'s_comentarios_registros.s_comentarios_registro.create'
    ])->middleware('auth');

    Route::get('/show/{sComentariosRegistro}',[
        'uses'=>'SComentariosRegistrosController@show',
        'middleware'=>'permission:s_comentarios_registros.s_comentarios_registro.show',
        'as'=>'s_comentarios_registros.s_comentarios_registro.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{sComentariosRegistro}/edit',[
        'uses'=>'SComentariosRegistrosController@edit',
        'middleware'=>'permission:s_comentarios_registros.s_comentarios_registro.edit',
        'as'=>'s_comentarios_registros.s_comentarios_registro.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'SComentariosRegistrosController@store',
        'middleware'=>'permission:s_comentarios_registros.s_comentarios_registro.store',
        'as'=>'s_comentarios_registros.s_comentarios_registro.store'
    ])->middleware('auth');
               
    Route::put('s_comentarios_registro/{sComentariosRegistro}', [
        'uses'=>'SComentariosRegistrosController@update',
        'middleware'=>'permission:s_comentarios_registros.s_comentarios_registro.update',
        'as'=>'s_comentarios_registros.s_comentarios_registro.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/s_comentarios_registro/{sComentariosRegistro}',[
        'uses'=>'SComentariosRegistrosController@destroy',
        'middleware'=>'permission:s_comentarios_registros.s_comentarios_registro.destroy',
        'as'=>'s_comentarios_registros.s_comentarios_registro.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/GetComentarios',[
        'uses'=>'SComentariosRegistrosController@getComentarios',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'s_comentarios_registros.s_comentarios_registro.getComentarios'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'files_s_procedimientos',
], function () {

    Route::get('/', [
        'uses'=>'FilesSProcedimientosController@index',
        'middleware'=>'permission:files_s_procedimientos.files_s_procedimiento.index',
        'as'=>'files_s_procedimientos.files_s_procedimiento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'FilesSProcedimientosController@create',
        'middleware'=> 'permission:files_s_procedimientos.files_s_procedimiento.create',
        'as'=>'files_s_procedimientos.files_s_procedimiento.create'
    ])->middleware('auth');

    Route::get('/show/{filesSProcedimiento}',[
        'uses'=>'FilesSProcedimientosController@show',
        'middleware'=>'permission:files_s_procedimientos.files_s_procedimiento.show',
        'as'=>'files_s_procedimientos.files_s_procedimiento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{filesSProcedimiento}/edit',[
        'uses'=>'FilesSProcedimientosController@edit',
        'middleware'=>'permission:files_s_procedimientos.files_s_procedimiento.edit',
        'as'=>'files_s_procedimientos.files_s_procedimiento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'FilesSProcedimientosController@store',
        'middleware'=>'permission:files_s_procedimientos.files_s_procedimiento.store',
        'as'=>'files_s_procedimientos.files_s_procedimiento.store'
    ])->middleware('auth');
               
    Route::put('files_s_procedimiento/{filesSProcedimiento}', [
        'uses'=>'FilesSProcedimientosController@update',
        'middleware'=>'permission:files_s_procedimientos.files_s_procedimiento.update',
        'as'=>'files_s_procedimientos.files_s_procedimiento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/files_s_procedimiento/{filesSProcedimiento}',[
        'uses'=>'FilesSProcedimientosController@destroy',
        'middleware'=>'permission:files_s_procedimientos.files_s_procedimiento.destroy',
        'as'=>'files_s_procedimientos.files_s_procedimiento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::post('/cargaArchivo', [
        'uses'=>'FilesSProcedimientosController@cargaArchivo',
        //'middleware'=>'permission:files_customers.files_customer.cargaArchivo',
        'as'=>'files_s_procedimientos.files_s_procedimiento.cargaArchivo'
    ])->middleware('auth');
    Route::get('/GetFiles',[
        'uses'=>'FilesSProcedimientosController@getFiles',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'files_s_procedimientos.files_s_procedimiento.getFiles'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'files_s_registros',
], function () {

    Route::get('/', [
        'uses'=>'FilesSRegistrosController@index',
        'middleware'=>'permission:files_s_registros.files_s_registro.index',
        'as'=>'files_s_registros.files_s_registro.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'FilesSRegistrosController@create',
        'middleware'=> 'permission:files_s_registros.files_s_registro.create',
        'as'=>'files_s_registros.files_s_registro.create'
    ])->middleware('auth');

    Route::get('/show/{filesSRegistro}',[
        'uses'=>'FilesSRegistrosController@show',
        'middleware'=>'permission:files_s_registros.files_s_registro.show',
        'as'=>'files_s_registros.files_s_registro.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{filesSRegistro}/edit',[
        'uses'=>'FilesSRegistrosController@edit',
        'middleware'=>'permission:files_s_registros.files_s_registro.edit',
        'as'=>'files_s_registros.files_s_registro.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'FilesSRegistrosController@store',
        'middleware'=>'permission:files_s_registros.files_s_registro.store',
        'as'=>'files_s_registros.files_s_registro.store'
    ])->middleware('auth');
               
    Route::put('files_s_registro/{filesSRegistro}', [
        'uses'=>'FilesSRegistrosController@update',
        'middleware'=>'permission:files_s_registros.files_s_registro.update',
        'as'=>'files_s_registros.files_s_registro.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/files_s_registro/{filesSRegistro}',[
        'uses'=>'FilesSRegistrosController@destroy',
        'middleware'=>'permission:files_s_registros.files_s_registro.destroy',
        'as'=>'files_s_registros.files_s_registro.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::post('/cargaArchivo', [
        'uses'=>'FilesSRegistrosController@cargaArchivo',
        //'middleware'=>'permission:files_customers.files_customer.cargaArchivo',
        'as'=>'files_s_registros.files_s_registro.cargaArchivo'
    ])->middleware('auth');
    Route::get('/GetFiles',[
        'uses'=>'FilesSRegistrosController@getFiles',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'files_s_registros.files_s_registro.getFiles'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'a_comentarios_procedimientos',
], function () {

    Route::get('/', [
        'uses'=>'AComentariosProcedimientosController@index',
        'middleware'=>'permission:a_comentarios_procedimientos.a_comentarios_procedimiento.index',
        'as'=>'a_comentarios_procedimientos.a_comentarios_procedimiento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AComentariosProcedimientosController@create',
        'middleware'=> 'permission:a_comentarios_procedimientos.a_comentarios_procedimiento.create',
        'as'=>'a_comentarios_procedimientos.a_comentarios_procedimiento.create'
    ])->middleware('auth');

    Route::get('/show/{aComentariosProcedimiento}',[
        'uses'=>'AComentariosProcedimientosController@show',
        'middleware'=>'permission:a_comentarios_procedimientos.a_comentarios_procedimiento.show',
        'as'=>'a_comentarios_procedimientos.a_comentarios_procedimiento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aComentariosProcedimiento}/edit',[
        'uses'=>'AComentariosProcedimientosController@edit',
        'middleware'=>'permission:a_comentarios_procedimientos.a_comentarios_procedimiento.edit',
        'as'=>'a_comentarios_procedimientos.a_comentarios_procedimiento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AComentariosProcedimientosController@store',
        'middleware'=>'permission:a_comentarios_procedimientos.a_comentarios_procedimiento.store',
        'as'=>'a_comentarios_procedimientos.a_comentarios_procedimiento.store'
    ])->middleware('auth');
               
    Route::put('a_comentarios_procedimiento/{aComentariosProcedimiento}', [
        'uses'=>'AComentariosProcedimientosController@update',
        'middleware'=>'permission:a_comentarios_procedimientos.a_comentarios_procedimiento.update',
        'as'=>'a_comentarios_procedimientos.a_comentarios_procedimiento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/a_comentarios_procedimiento/{aComentariosProcedimiento}',[
        'uses'=>'AComentariosProcedimientosController@destroy',
        'middleware'=>'permission:a_comentarios_procedimientos.a_comentarios_procedimiento.destroy',
        'as'=>'a_comentarios_procedimientos.a_comentarios_procedimiento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/GetComentarios',[
        'uses'=>'AComentariosProcedimientosController@getComentarios',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'a_comentarios_procedimientos.a_comentarios_procedimiento.getComentarios'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'files_a_procedimientos',
], function () {

    Route::get('/', [
        'uses'=>'FilesAProcedimientosController@index',
        'middleware'=>'permission:files_a_procedimientos.files_a_procedimiento.index',
        'as'=>'files_a_procedimientos.files_a_procedimiento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'FilesAProcedimientosController@create',
        'middleware'=> 'permission:files_a_procedimientos.files_a_procedimiento.create',
        'as'=>'files_a_procedimientos.files_a_procedimiento.create'
    ])->middleware('auth');

    Route::get('/show/{filesAProcedimiento}',[
        'uses'=>'FilesAProcedimientosController@show',
        'middleware'=>'permission:files_a_procedimientos.files_a_procedimiento.show',
        'as'=>'files_a_procedimientos.files_a_procedimiento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{filesAProcedimiento}/edit',[
        'uses'=>'FilesAProcedimientosController@edit',
        'middleware'=>'permission:files_a_procedimientos.files_a_procedimiento.edit',
        'as'=>'files_a_procedimientos.files_a_procedimiento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'FilesAProcedimientosController@store',
        'middleware'=>'permission:files_a_procedimientos.files_a_procedimiento.store',
        'as'=>'files_a_procedimientos.files_a_procedimiento.store'
    ])->middleware('auth');
               
    Route::put('files_a_procedimiento/{filesAProcedimiento}', [
        'uses'=>'FilesAProcedimientosController@update',
        'middleware'=>'permission:files_a_procedimientos.files_a_procedimiento.update',
        'as'=>'files_a_procedimientos.files_a_procedimiento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/files_a_procedimiento/{filesAProcedimiento}',[
        'uses'=>'FilesAProcedimientosController@destroy',
        'middleware'=>'permission:files_a_procedimientos.files_a_procedimiento.destroy',
        'as'=>'files_a_procedimientos.files_a_procedimiento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::post('/cargaArchivo', [
        'uses'=>'FilesAProcedimientosController@cargaArchivo',
        //'middleware'=>'permission:files_customers.files_customer.cargaArchivo',
        'as'=>'files_a_procedimientos.files_a_procedimiento.cargaArchivo'
    ])->middleware('auth');
    Route::get('/GetFiles',[
        'uses'=>'FilesAProcedimientosController@getFiles',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'files_a_procedimientos.files_a_procedimiento.getFiles'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'a_comentarios_archivos',
], function () {

    Route::get('/', [
        'uses'=>'AComentariosArchivosController@index',
        'middleware'=>'permission:a_comentarios_archivos.a_comentarios_archivo.index',
        'as'=>'a_comentarios_archivos.a_comentarios_archivo.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AComentariosArchivosController@create',
        'middleware'=> 'permission:a_comentarios_archivos.a_comentarios_archivo.create',
        'as'=>'a_comentarios_archivos.a_comentarios_archivo.create'
    ])->middleware('auth');

    Route::get('/show/{aComentariosArchivo}',[
        'uses'=>'AComentariosArchivosController@show',
        'middleware'=>'permission:a_comentarios_archivos.a_comentarios_archivo.show',
        'as'=>'a_comentarios_archivos.a_comentarios_archivo.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aComentariosArchivo}/edit',[
        'uses'=>'AComentariosArchivosController@edit',
        'middleware'=>'permission:a_comentarios_archivos.a_comentarios_archivo.edit',
        'as'=>'a_comentarios_archivos.a_comentarios_archivo.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AComentariosArchivosController@store',
        'middleware'=>'permission:a_comentarios_archivos.a_comentarios_archivo.store',
        'as'=>'a_comentarios_archivos.a_comentarios_archivo.store'
    ])->middleware('auth');
               
    Route::put('a_comentarios_archivo/{aComentariosArchivo}', [
        'uses'=>'AComentariosArchivosController@update',
        'middleware'=>'permission:a_comentarios_archivos.a_comentarios_archivo.update',
        'as'=>'a_comentarios_archivos.a_comentarios_archivo.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/a_comentarios_archivo/{aComentariosArchivo}',[
        'uses'=>'AComentariosArchivosController@destroy',
        'middleware'=>'permission:a_comentarios_archivos.a_comentarios_archivo.destroy',
        'as'=>'a_comentarios_archivos.a_comentarios_archivo.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/GetComentarios',[
        'uses'=>'AComentariosArchivosController@getComentarios',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'a_comentarios_archivos.a_comentarios_archivo.getComentarios'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'files_a_archivos',
], function () {

    Route::get('/', [
        'uses'=>'FilesAArchivosController@index',
        'middleware'=>'permission:files_a_archivos.files_a_archivo.index',
        'as'=>'files_a_archivos.files_a_archivo.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'FilesAArchivosController@create',
        'middleware'=> 'permission:files_a_archivos.files_a_archivo.create',
        'as'=>'files_a_archivos.files_a_archivo.create'
    ])->middleware('auth');

    Route::get('/show/{filesAArchivo}',[
        'uses'=>'FilesAArchivosController@show',
        'middleware'=>'permission:files_a_archivos.files_a_archivo.show',
        'as'=>'files_a_archivos.files_a_archivo.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{filesAArchivo}/edit',[
        'uses'=>'FilesAArchivosController@edit',
        'middleware'=>'permission:files_a_archivos.files_a_archivo.edit',
        'as'=>'files_a_archivos.files_a_archivo.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'FilesAArchivosController@store',
        'middleware'=>'permission:files_a_archivos.files_a_archivo.store',
        'as'=>'files_a_archivos.files_a_archivo.store'
    ])->middleware('auth');
               
    Route::put('files_a_archivo/{filesAArchivo}', [
        'uses'=>'FilesAArchivosController@update',
        'middleware'=>'permission:files_a_archivos.files_a_archivo.update',
        'as'=>'files_a_archivos.files_a_archivo.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/files_a_archivo/{filesAArchivo}',[
        'uses'=>'FilesAArchivosController@destroy',
        'middleware'=>'permission:files_a_archivos.files_a_archivo.destroy',
        'as'=>'files_a_archivos.files_a_archivo.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::post('/cargaArchivo', [
        'uses'=>'FilesAArchivosController@cargaArchivo',
        //'middleware'=>'permission:files_customers.files_customer.cargaArchivo',
        'as'=>'files_a_archivos.files_a_archivo.cargaArchivo'
    ])->middleware('auth');
    Route::get('/GetFiles',[
        'uses'=>'FilesAArchivosController@getFiles',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'files_a_archivos.files_a_archivo.getFiles'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'files_a_rr_ambientales',
], function () {

    Route::get('/', [
        'uses'=>'FilesARrAmbientalesController@index',
        'middleware'=>'permission:files_a_rr_ambientales.files_a_rr_ambientale.index',
        'as'=>'files_a_rr_ambientales.files_a_rr_ambientale.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'FilesARrAmbientalesController@create',
        'middleware'=> 'permission:files_a_rr_ambientales.files_a_rr_ambientale.create',
        'as'=>'files_a_rr_ambientales.files_a_rr_ambientale.create'
    ])->middleware('auth');

    Route::get('/show/{filesARrAmbientale}',[
        'uses'=>'FilesARrAmbientalesController@show',
        'middleware'=>'permission:files_a_rr_ambientales.files_a_rr_ambientale.show',
        'as'=>'files_a_rr_ambientales.files_a_rr_ambientale.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{filesARrAmbientale}/edit',[
        'uses'=>'FilesARrAmbientalesController@edit',
        'middleware'=>'permission:files_a_rr_ambientales.files_a_rr_ambientale.edit',
        'as'=>'files_a_rr_ambientales.files_a_rr_ambientale.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'FilesARrAmbientalesController@store',
        'middleware'=>'permission:files_a_rr_ambientales.files_a_rr_ambientale.store',
        'as'=>'files_a_rr_ambientales.files_a_rr_ambientale.store'
    ])->middleware('auth');
               
    Route::put('files_a_rr_ambientale/{filesARrAmbientale}', [
        'uses'=>'FilesARrAmbientalesController@update',
        'middleware'=>'permission:files_a_rr_ambientales.files_a_rr_ambientale.update',
        'as'=>'files_a_rr_ambientales.files_a_rr_ambientale.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/files_a_rr_ambientale/{filesARrAmbientale}',[
        'uses'=>'FilesARrAmbientalesController@destroy',
        'middleware'=>'permission:files_a_rr_ambientales.files_a_rr_ambientale.destroy',
        'as'=>'files_a_rr_ambientales.files_a_rr_ambientale.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::post('/cargaArchivo', [
        'uses'=>'FilesARrAmbientalesController@cargaArchivo',
        //'middleware'=>'permission:files_customers.files_customer.cargaArchivo',
        'as'=>'files_a_rr_ambientales.files_a_rr_ambientale.cargaArchivo'
    ])->middleware('auth');
    Route::get('/GetFiles',[
        'uses'=>'FilesARrAmbientalesController@getFiles',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'files_a_rr_ambientales.files_a_rr_ambientale.getFiles'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'a_comentarios_rrs',
], function () {

    Route::get('/', [
        'uses'=>'AComentariosRrsController@index',
        'middleware'=>'permission:a_comentarios_rrs.a_comentarios_rrs.index',
        'as'=>'a_comentarios_rrs.a_comentarios_rrs.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AComentariosRrsController@create',
        'middleware'=> 'permission:a_comentarios_rrs.a_comentarios_rrs.create',
        'as'=>'a_comentarios_rrs.a_comentarios_rrs.create'
    ])->middleware('auth');

    Route::get('/show/{aComentariosRrs}',[
        'uses'=>'AComentariosRrsController@show',
        'middleware'=>'permission:a_comentarios_rrs.a_comentarios_rrs.show',
        'as'=>'a_comentarios_rrs.a_comentarios_rrs.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aComentariosRrs}/edit',[
        'uses'=>'AComentariosRrsController@edit',
        'middleware'=>'permission:a_comentarios_rrs.a_comentarios_rrs.edit',
        'as'=>'a_comentarios_rrs.a_comentarios_rrs.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AComentariosRrsController@store',
        'middleware'=>'permission:a_comentarios_rrs.a_comentarios_rrs.store',
        'as'=>'a_comentarios_rrs.a_comentarios_rrs.store'
    ])->middleware('auth');
               
    Route::put('a_comentarios_rrs/{aComentariosRrs}', [
        'uses'=>'AComentariosRrsController@update',
        'middleware'=>'permission:a_comentarios_rrs.a_comentarios_rrs.update',
        'as'=>'a_comentarios_rrs.a_comentarios_rrs.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/a_comentarios_rrs/{aComentariosRrs}',[
        'uses'=>'AComentariosRrsController@destroy',
        'middleware'=>'permission:a_comentarios_rrs.a_comentarios_rrs.destroy',
        'as'=>'a_comentarios_rrs.a_comentarios_rrs.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/GetComentarios',[
        'uses'=>'AComentariosRrsController@getComentarios',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'a_comentarios_rrs.a_comentarios_rrs.getComentarios'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'files_rev_documental_lns',
], function () {

    Route::get('/', [
        'uses'=>'FilesRevDocumentalLnsController@index',
        'middleware'=>'permission:files_rev_documental_lns.files_rev_documental_ln.index',
        'as'=>'files_rev_documental_lns.files_rev_documental_ln.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'FilesRevDocumentalLnsController@create',
        'middleware'=> 'permission:files_rev_documental_lns.files_rev_documental_ln.create',
        'as'=>'files_rev_documental_lns.files_rev_documental_ln.create'
    ])->middleware('auth');

    Route::get('/show/{filesRevDocumentalLn}',[
        'uses'=>'FilesRevDocumentalLnsController@show',
        'middleware'=>'permission:files_rev_documental_lns.files_rev_documental_ln.show',
        'as'=>'files_rev_documental_lns.files_rev_documental_ln.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{filesRevDocumentalLn}/edit',[
        'uses'=>'FilesRevDocumentalLnsController@edit',
        'middleware'=>'permission:files_rev_documental_lns.files_rev_documental_ln.edit',
        'as'=>'files_rev_documental_lns.files_rev_documental_ln.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'FilesRevDocumentalLnsController@store',
        'middleware'=>'permission:files_rev_documental_lns.files_rev_documental_ln.store',
        'as'=>'files_rev_documental_lns.files_rev_documental_ln.store'
    ])->middleware('auth');
               
    Route::put('files_rev_documental_ln/{filesRevDocumentalLn}', [
        'uses'=>'FilesRevDocumentalLnsController@update',
        'middleware'=>'permission:files_rev_documental_lns.files_rev_documental_ln.update',
        'as'=>'files_rev_documental_lns.files_rev_documental_ln.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/files_rev_documental_ln/{filesRevDocumentalLn}',[
        'uses'=>'FilesRevDocumentalLnsController@destroy',
        'middleware'=>'permission:files_rev_documental_lns.files_rev_documental_ln.destroy',
        'as'=>'files_rev_documental_lns.files_rev_documental_ln.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::post('/cargaArchivo', [
        'uses'=>'FilesRevDocumentalLnsController@cargaArchivo',
        //'middleware'=>'permission:files_customers.files_customer.cargaArchivo',
        'as'=>'files_rev_documental_lns.files_rev_documental_ln.cargaArchivo'
    ])->middleware('auth');
    
});
Route::group(
[
    'prefix' => 'cubos',
], function () {

    Route::get('/getFuenteFija', [
        'uses'=>'CubosController@getFuentefija',
        'middleware'=>'permission:cubos.cubo.getFuentefija',
        'as'=>'cubos.cubo.getFuentefija'
    ])->middleware('auth');

    Route::get('/getPlanta',[
        'uses'=>'CubosController@getPlanta',
        'middleware'=> 'permission:cubos.cubo.getPlanta',
        'as'=>'cubos.cubo.getPlanta'
    ])->middleware('auth');

    Route::get('/getResiduo',[
        'uses'=>'CubosController@getResiduo',
        'middleware'=>'permission:cubos.cubo.getResiduo',
        'as'=>'cubos.cubo.getResiduo'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/getConsumible',[
        'uses'=>'CubosController@getConsumible',
        'middleware'=>'permission:cubos.cubo.getConsumible',
        'as'=>'cubos.cubo.getConsumible'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/getNoConformidades', [
        'uses'=>'CubosController@getNoConformidades',
        'middleware'=>'permission:cubos.cubo.getNoConformidades',
        'as'=>'cubos.cubo.getNoConformidades'
    ])->middleware('auth');
    Route::get('/getAccidentes', [
        'uses'=>'CubosController@getAccidentes',
        'middleware'=>'permission:cubos.cubo.getAccidentes',
        'as'=>'cubos.cubo.getAccidentes'
    ])->middleware('auth');
    Route::get('/getEnfermedades', [
        'uses'=>'CubosController@getEnfermedades',
        'middleware'=>'permission:cubos.cubo.getEnfermedades',
        'as'=>'cubos.cubo.getEnfermedades'
    ])->middleware('auth');
    
});
Route::group(
[
    'prefix' => 'consultas',
], function () {

    Route::get('/getFuenteFija', [
        'uses'=>'ConsultasController@getFuentefija',
        'middleware'=>'permission:consultas.consulta.getFuentefija',
        'as'=>'consultas.consulta.getFuentefija'
    ])->middleware('auth');
    
    Route::post('/postFuenteFija', [
        'uses'=>'ConsultasController@postFuentefija',
        'middleware'=>'permission:consultas.consulta.getFuentefija',
        'as'=>'consultas.consulta.postFuentefija'
    ])->middleware('auth');

    Route::get('/getPlanta',[
        'uses'=>'ConsultasController@getPlanta',
        'middleware'=> 'permission:consultas.consulta.getPlanta',
        'as'=>'consultas.consulta.getPlanta'
    ])->middleware('auth');
    
    Route::post('/postPlanta',[
        'uses'=>'ConsultasController@postPlanta',
        'middleware'=> 'permission:consultas.consulta.getPlanta',
        'as'=>'consultas.consulta.postPlanta'
    ])->middleware('auth');

    Route::get('/getResiduo',[
        'uses'=>'ConsultasController@getResiduo',
        'middleware'=>'permission:consultas.consulta.getResiduo',
        'as'=>'consultas.consulta.getResiduo'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/postResiduo',[
        'uses'=>'ConsultasController@postResiduo',
        'middleware'=>'permission:consultas.consulta.getResiduo',
        'as'=>'consultas.consulta.postResiduo'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    Route::get('/getConsumible',[
        'uses'=>'ConsultasController@getConsumible',
        'middleware'=>'permission:consultas.consulta.getConsumible',
        'as'=>'consultas.consulta.getConsumible'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    Route::post('/postConsumible',[
        'uses'=>'ConsultasController@postConsumible',
        'middleware'=>'permission:consultas.consulta.getConsumible',
        'as'=>'consultas.consulta.postConsumible'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/getNoConformidades', [
        'uses'=>'ConsultasController@getNoConformidades',
        'middleware'=>'permission:consultas.consulta.getNoConformidades',
        'as'=>'consultas.consulta.getNoConformidades'
    ])->middleware('auth');
    
    Route::post('/postNoConformidades', [
        'uses'=>'ConsultasController@postNoConformidades',
        'middleware'=>'permission:consultas.consulta.getNoConformidades',
        'as'=>'consultas.consulta.postNoConformidades'
    ])->middleware('auth');
    
    Route::get('/getAccidentes', [
        'uses'=>'ConsultasController@getAccidentes',
        'middleware'=>'permission:consultas.consulta.getAccidentes',
        'as'=>'consultas.consulta.getAccidentes'
    ])->middleware('auth');
    
    Route::post('/postAccidentes', [
        'uses'=>'ConsultasController@postAccidentes',
        'middleware'=>'permission:consultas.consulta.getAccidentes',
        'as'=>'consultas.consulta.postAccidentes'
    ])->middleware('auth');
    
    Route::get('/getEnfermedades', [
        'uses'=>'ConsultasController@getEnfermedades',
        'middleware'=>'permission:consultas.consulta.getEnfermedades',
        'as'=>'consultas.consulta.getEnfermedades'
    ])->middleware('auth');
    
    Route::post('/postEnfermedades', [
        'uses'=>'ConsultasController@postEnfermedades',
        'middleware'=>'permission:consultas.consulta.getEnfermedades',
        'as'=>'consultas.consulta.postEnfermedades'
    ])->middleware('auth');
    
    Route::get('/getReqReg', [
        'uses'=>'ConsultasController@getReqReg',
        'middleware'=>'permission:consultas.consulta.getReqReg',
        'as'=>'consultas.consulta.getReqReg'
    ])->middleware('auth');
    
    Route::post('/postReqReg', [
        'uses'=>'ConsultasController@postReqReg',
        'middleware'=>'permission:consultas.consulta.getReqReg',
        'as'=>'consultas.consulta.postReqReg'
    ])->middleware('auth');
});
Route::group(
[
    'prefix' => 'bit_doc_accidentes',
], function () {

    Route::get('/', [
        'uses'=>'BitDocAccidentesController@index',
        'middleware'=>'permission:bit_doc_accidentes.bit_doc_accidente.index',
        'as'=>'bit_doc_accidentes.bit_doc_accidente.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'BitDocAccidentesController@create',
        'middleware'=> 'permission:bit_doc_accidentes.bit_doc_accidente.create',
        'as'=>'bit_doc_accidentes.bit_doc_accidente.create'
    ])->middleware('auth');

    Route::get('/show/{bitDocAccidente}',[
        'uses'=>'BitDocAccidentesController@show',
        'middleware'=>'permission:bit_doc_accidentes.bit_doc_accidente.show',
        'as'=>'bit_doc_accidentes.bit_doc_accidente.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{bitDocAccidente}/edit',[
        'uses'=>'BitDocAccidentesController@edit',
        'middleware'=>'permission:bit_doc_accidentes.bit_doc_accidente.edit',
        'as'=>'bit_doc_accidentes.bit_doc_accidente.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'BitDocAccidentesController@store',
        'middleware'=>'permission:bit_doc_accidentes.bit_doc_accidente.store',
        'as'=>'bit_doc_accidentes.bit_doc_accidente.store'
    ])->middleware('auth');
               
    Route::put('bit_doc_accidente/{bitDocAccidente}', [
        'uses'=>'BitDocAccidentesController@update',
        'middleware'=>'permission:bit_doc_accidentes.bit_doc_accidente.update',
        'as'=>'bit_doc_accidentes.bit_doc_accidente.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/bit_doc_accidente/{bitDocAccidente}',[
        'uses'=>'BitDocAccidentesController@destroy',
        'middleware'=>'permission:bit_doc_accidentes.bit_doc_accidente.destroy',
        'as'=>'bit_doc_accidentes.bit_doc_accidente.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::post('/cargaArchivo', [
        'uses'=>'BitDocAccidentesController@cargaArchivo',
        //'middleware'=>'permission:files_customers.files_customer.cargaArchivo',
        'as'=>'bit_doc_accidentes.bit_doc_accidente.cargaArchivo'
    ])->middleware('auth');
    Route::get('/GetFiles',[
        'uses'=>'BitDocAccidentesController@getFiles',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'bit_doc_accidentes.bit_doc_accidente.getFiles'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'bit_doc_enfermedades',
], function () {

    Route::get('/', [
        'uses'=>'BitDocEnfermedadesController@index',
        'middleware'=>'permission:bit_doc_enfermedades.bit_doc_enfermedade.index',
        'as'=>'bit_doc_enfermedades.bit_doc_enfermedade.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'BitDocEnfermedadesController@create',
        'middleware'=> 'permission:bit_doc_enfermedades.bit_doc_enfermedade.create',
        'as'=>'bit_doc_enfermedades.bit_doc_enfermedade.create'
    ])->middleware('auth');

    Route::get('/show/{bitDocEnfermedade}',[
        'uses'=>'BitDocEnfermedadesController@show',
        'middleware'=>'permission:bit_doc_enfermedades.bit_doc_enfermedade.show',
        'as'=>'bit_doc_enfermedades.bit_doc_enfermedade.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{bitDocEnfermedade}/edit',[
        'uses'=>'BitDocEnfermedadesController@edit',
        'middleware'=>'permission:bit_doc_enfermedades.bit_doc_enfermedade.edit',
        'as'=>'bit_doc_enfermedades.bit_doc_enfermedade.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'BitDocEnfermedadesController@store',
        'middleware'=>'permission:bit_doc_enfermedades.bit_doc_enfermedade.store',
        'as'=>'bit_doc_enfermedades.bit_doc_enfermedade.store'
    ])->middleware('auth');
               
    Route::put('bit_doc_enfermedade/{bitDocEnfermedade}', [
        'uses'=>'BitDocEnfermedadesController@update',
        'middleware'=>'permission:bit_doc_enfermedades.bit_doc_enfermedade.update',
        'as'=>'bit_doc_enfermedades.bit_doc_enfermedade.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/bit_doc_enfermedade/{bitDocEnfermedade}',[
        'uses'=>'BitDocEnfermedadesController@destroy',
        'middleware'=>'permission:bit_doc_enfermedades.bit_doc_enfermedade.destroy',
        'as'=>'bit_doc_enfermedades.bit_doc_enfermedade.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::post('/cargaArchivo', [
        'uses'=>'BitDocEnfermedadesController@cargaArchivo',
        //'middleware'=>'permission:files_customers.files_customer.cargaArchivo',
        'as'=>'bit_doc_enfermedades.bit_doc_enfermedade.cargaArchivo'
    ])->middleware('auth');
    Route::get('/GetFiles',[
        'uses'=>'BitDocEnfermedadesController@getFiles',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'bit_doc_enfermedades.bit_doc_enfermedade.getFiles'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'files_cs_normas',
], function () {

    Route::get('/', [
        'uses'=>'FilesCsNormasController@index',
        'middleware'=>'permission:files_cs_normas.files_cs_norma.index',
        'as'=>'files_cs_normas.files_cs_norma.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'FilesCsNormasController@create',
        'middleware'=> 'permission:files_cs_normas.files_cs_norma.create',
        'as'=>'files_cs_normas.files_cs_norma.create'
    ])->middleware('auth');

    Route::get('/show/{filesCsNorma}',[
        'uses'=>'FilesCsNormasController@show',
        'middleware'=>'permission:files_cs_normas.files_cs_norma.show',
        'as'=>'files_cs_normas.files_cs_norma.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{filesCsNorma}/edit',[
        'uses'=>'FilesCsNormasController@edit',
        'middleware'=>'permission:files_cs_normas.files_cs_norma.edit',
        'as'=>'files_cs_normas.files_cs_norma.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'FilesCsNormasController@store',
        'middleware'=>'permission:files_cs_normas.files_cs_norma.store',
        'as'=>'files_cs_normas.files_cs_norma.store'
    ])->middleware('auth');
               
    Route::put('files_cs_norma/{filesCsNorma}', [
        'uses'=>'FilesCsNormasController@update',
        'middleware'=>'permission:files_cs_normas.files_cs_norma.update',
        'as'=>'files_cs_normas.files_cs_norma.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/files_cs_norma/{filesCsNorma}',[
        'uses'=>'FilesCsNormasController@destroy',
        'middleware'=>'permission:files_cs_normas.files_cs_norma.destroy',
        'as'=>'files_cs_normas.files_cs_norma.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::post('/cargaArchivo', [
        'uses'=>'FilesCsNormasController@cargaArchivo',
        //'middleware'=>'permission:files_customers.files_customer.cargaArchivo',
        'as'=>'files_cs_normas.files_cs_norma.cargaArchivo'
    ])->middleware('auth');
    Route::get('/GetFiles',[
        'uses'=>'FilesCsNormasController@getFiles',
        //'middleware'=>'permission:ln_impactos.ln_impacto.getByEnc',
        'as'=>'files_cs_normas.files_cs_norma.getFiles'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'a_st_rrs',
], function () {

    Route::get('/', [
        'uses'=>'AStRrsController@index',
        'middleware'=>'permission:a_st_rrs.a_st_rr.index',
        'as'=>'a_st_rrs.a_st_rr.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AStRrsController@create',
        'middleware'=> 'permission:a_st_rrs.a_st_rr.create',
        'as'=>'a_st_rrs.a_st_rr.create'
    ])->middleware('auth');

    Route::get('/show/{aStRr}',[
        'uses'=>'AStRrsController@show',
        'middleware'=>'permission:a_st_rrs.a_st_rr.show',
        'as'=>'a_st_rrs.a_st_rr.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aStRr}/edit',[
        'uses'=>'AStRrsController@edit',
        'middleware'=>'permission:a_st_rrs.a_st_rr.edit',
        'as'=>'a_st_rrs.a_st_rr.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AStRrsController@store',
        'middleware'=>'permission:a_st_rrs.a_st_rr.store',
        'as'=>'a_st_rrs.a_st_rr.store'
    ])->middleware('auth');
               
    Route::put('a_st_rr/{aStRr}', [
        'uses'=>'AStRrsController@update',
        'middleware'=>'permission:a_st_rrs.a_st_rr.update',
        'as'=>'a_st_rrs.a_st_rr.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/a_st_rr/{aStRr}',[
        'uses'=>'AStRrsController@destroy',
        'middleware'=>'permission:a_st_rrs.a_st_rr.destroy',
        'as'=>'a_st_rrs.a_st_rr.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'tipo_entities',
], function () {

    Route::get('/', [
        'uses'=>'TipoEntitiesController@index',
        'middleware'=>'permission:tipo_entities.tipo_entity.index',
        'as'=>'tipo_entities.tipo_entity.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'TipoEntitiesController@create',
        'middleware'=> 'permission:tipo_entities.tipo_entity.create',
        'as'=>'tipo_entities.tipo_entity.create'
    ])->middleware('auth');

    Route::get('/show/{tipoEntity}',[
        'uses'=>'TipoEntitiesController@show',
        'middleware'=>'permission:tipo_entities.tipo_entity.show',
        'as'=>'tipo_entities.tipo_entity.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{tipoEntity}/edit',[
        'uses'=>'TipoEntitiesController@edit',
        'middleware'=>'permission:tipo_entities.tipo_entity.edit',
        'as'=>'tipo_entities.tipo_entity.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'TipoEntitiesController@store',
        'middleware'=>'permission:tipo_entities.tipo_entity.store',
        'as'=>'tipo_entities.tipo_entity.store'
    ])->middleware('auth');
               
    Route::put('tipo_entity/{tipoEntity}', [
        'uses'=>'TipoEntitiesController@update',
        'middleware'=>'permission:tipo_entities.tipo_entity.update',
        'as'=>'tipo_entities.tipo_entity.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/tipo_entity/{tipoEntity}',[
        'uses'=>'TipoEntitiesController@destroy',
        'middleware'=>'permission:tipo_entities.tipo_entity.destroy',
        'as'=>'tipo_entities.tipo_entity.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'a_rr_amb_leyes',
], function () {

    Route::get('/', [
        'uses'=>'ARrAmbLeyesController@index',
        'middleware'=>'permission:a_rr_amb_leyes.a_rr_amb_leye.index',
        'as'=>'a_rr_amb_leyes.a_rr_amb_leye.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ARrAmbLeyesController@create',
        'middleware'=> 'permission:a_rr_amb_leyes.a_rr_amb_leye.create',
        'as'=>'a_rr_amb_leyes.a_rr_amb_leye.create'
    ])->middleware('auth');

    Route::get('/show/{aRrAmbLeye}',[
        'uses'=>'ARrAmbLeyesController@show',
        'middleware'=>'permission:a_rr_amb_leyes.a_rr_amb_leye.show',
        'as'=>'a_rr_amb_leyes.a_rr_amb_leye.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{aRrAmbLeye}/edit',[
        'uses'=>'ARrAmbLeyesController@edit',
        'middleware'=>'permission:a_rr_amb_leyes.a_rr_amb_leye.edit',
        'as'=>'a_rr_amb_leyes.a_rr_amb_leye.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ARrAmbLeyesController@store',
        'middleware'=>'permission:a_rr_amb_leyes.a_rr_amb_leye.store',
        'as'=>'a_rr_amb_leyes.a_rr_amb_leye.store'
    ])->middleware('auth');
               
    Route::put('a_rr_amb_leye/{aRrAmbLeye}', [
        'uses'=>'ARrAmbLeyesController@update',
        'middleware'=>'permission:a_rr_amb_leyes.a_rr_amb_leye.update',
        'as'=>'a_rr_amb_leyes.a_rr_amb_leye.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/a_rr_amb_leye/{aRrAmbLeye}',[
        'uses'=>'ARrAmbLeyesController@destroy',
        'middleware'=>'permission:a_rr_amb_leyes.a_rr_amb_leye.destroy',
        'as'=>'a_rr_amb_leyes.a_rr_amb_leye.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    Route::get('a_rr_amb_leye/generar', [
        'uses'=>'ARrAmbLeyesController@generar',
        'middleware'=>'permission:a_rr_amb_leyes.a_rr_amb_leye.generar',
        'as'=>'a_rr_amb_leyes.a_rr_amb_leye.generar'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    
});
