<?php

Route::get('/', function () {
    return redirect()->route('m.login');
});

Route::any('/login', 'AccountController@login')->name('m.login');

Route::any('/logout', 'AccountController@logout')->name('m.logout');

Route::get('/welcome', 'SiteController@welcome')->name('m.welcome');

//users

Route::any('/users', 'UserController@users')->name('m.users');

Route::any('/users/add', 'UserController@addUser')->name('m.addUser');

Route::any('/users/{id}/disable', 'UserController@disable')->name('m.disableUser');

Route::any('/users/{id}/delete', 'UserController@delete')->name('m.deleteUser');

Route::any('/users/{id}/edit', 'UserController@editUser')->name('m.editUser');

Route::any('/users/{id}/api', 'UserController@api')->name('m.userApi');

//roles
Route::any('/permission/secrets','RoleController@secrets')->name('m.secrets');

Route::any('/permission/secrets/add','RoleController@addSecret')->name('m.addSecret');

Route::any('/permission/secrets/{id}/delete','RoleController@deleteSecret')->name('m.deleteSecrets');

Route::any('/permission/roles', 'RoleController@roles')->name('m.roles');

Route::any('/permission/roles/add', 'RoleController@addRole')->name('m.addRole');

Route::any('/permission/roles/{id}/edit', 'RoleController@editRole')->name('m.editRole');

Route::any('/permission/roles/{id}/api', 'RoleController@api')->name('m.roleApi');

Route::any('/permission/roles/{id}/delete', 'RoleController@deleteRole')->name('m.deleteRole');


//inspections

Route::any('/ydbg/inspections', 'InspectionController@inspections')->name('m.inspections');

Route::any('/ydbg/inspections/{id}', 'InspectionController@inspection')->name('m.inspection');

Route::any('/ydbg/es', 'InspectionController@es')->name('m.es');

Route::any('/ydbg/es/manual', 'InspectionController@esManual')->name('m.esManual');

Route::any('/ydbg/es/{id}/download', 'InspectionController@esDownload')->name('m.esDownload');