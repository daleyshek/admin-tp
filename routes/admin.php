<?php

Route::get('/', 'SiteController@index');

Route::any('/login', 'AccountController@login')->name('a.login');

Route::any('/logout', 'AccountController@logout')->name('a.logout');

Route::get('/welcome', 'SiteController@welcome')->name('a.welcome');

//users

Route::any('/users', 'UserController@users')->name('a.users');

Route::any('/users/add', 'UserController@addUser')->name('a.addUser');

Route::any('/users/{id}/disable', 'UserController@disable')->name('a.disableUser');

Route::any('/users/{id}/delete', 'UserController@delete')->name('a.deleteUser');

Route::any('/users/{id}/edit', 'UserController@editUser')->name('a.editUser');

Route::any('/users/{id}/api', 'UserController@api')->name('a.userApi');

//roles
Route::any('/permission/secrets','RoleController@secrets')->name('a.secrets');

Route::any('/permission/secrets/add','RoleController@addSecret')->name('a.addSecret');

Route::any('/permission/secrets/{id}/delete','RoleController@deleteSecret')->name('a.deleteSecrets');

Route::any('/permission/roles', 'RoleController@roles')->name('a.roles');

Route::any('/permission/roles/add', 'RoleController@addRole')->name('a.addRole');

Route::any('/permission/roles/{id}/edit', 'RoleController@editRole')->name('a.editRole');

Route::any('/permission/roles/{id}/api', 'RoleController@api')->name('a.roleApi');

Route::any('/permission/roles/{id}/delete', 'RoleController@deleteRole')->name('a.deleteRole');
