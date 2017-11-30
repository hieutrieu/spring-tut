<?php
use Framework\Route;
/** FRONTEND */
Route::action('GET', '/', 'Admin\AuthController@login');


/** BACKEND */
Route::action('GET', '/admin/errors/exception', 'Admin\ErrorsController@exception');
Route::action('GET', '/admin/errors/access', 'Admin\ErrorsController@access');
Route::action('GET', '/admin/auth/logout', 'Admin\AuthController@logout');
Route::action('GET', '/admin/auth/login', 'Admin\AuthController@login');
Route::action('POST', '/admin/auth/login', 'Admin\AuthController@login');
Route::action('GET', '/admin', 'Admin\AuthController@login');

Route::action('GET', '/admin/filescan', 'Admin\FilescanController@index');

Route::action('GET', '/admin/scan', 'Admin\ScanController@scanFolder');
Route::action('GET', '/admin/scan/importThread', 'Admin\ScanController@importThread');
Route::action('GET', '/admin/scan/importFile', 'Admin\ScanController@importFile');

Route::action('GET', '/admin/groups', 'Admin\GroupsController@index');
Route::action('GET', '/admin/groups/edit/{id}', 'Admin\GroupsController@edit');
Route::action('POST', '/admin/groups/save', 'Admin\GroupsController@save');
Route::action('GET', '/admin/groups/delete/{id}', 'Admin\GroupsController@delete');
Route::action('GET', '/admin/groups/info/{id}', 'Admin\GroupsController@info');
Route::action('GET', '/admin/groups/report/{id}', 'Admin\GroupsController@report');

Route::action('GET', '/admin/users/admin', 'Admin\UsersController@admin');
Route::action('GET', '/admin/users', 'Admin\UsersController@index');
Route::action('GET', '/admin/users/export', 'Admin\UsersController@export_index');
Route::action('GET', '/admin/users/edit/{id}', 'Admin\UsersController@edit');
Route::action('POST', '/admin/users/save', 'Admin\UsersController@save');
Route::action('GET', '/admin/users/delete/{id}', 'Admin\UsersController@delete');
Route::action('GET', '/admin/users/info/{id}', 'Admin\UsersController@info');
Route::action('GET', '/admin/users/report/{id}', 'Admin\UsersController@report');

Route::action('GET', '/admin/config', 'Admin\ConfigController@edit');
Route::action('POST', '/admin/config/save', 'Admin\ConfigController@save');