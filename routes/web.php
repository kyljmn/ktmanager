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
    if(auth()->user()){
      return redirect('/projects');
    } else {
      return view('welcome');
    }
});

Route::patch('/tasks/{task}', 'ProjectTasksController@statusChange');

Route::resource('projects', 'ProjectsController', ['except'=> ['create']]);

Route::resource('projects.task', 'ProjectTasksController', ['except'=> ['index','create']]);

Route::post('/projects/{project}/notes', 'NotesController@fromprojects');

Route::post('/tasks/{task}/notes', 'NotesController@fromtasks');

Route::get('/dashboard','ProjectsController@dashboard');

Route::post('fromdashboard','ProjectTasksController@fromdashboard')

Auth::routes();
