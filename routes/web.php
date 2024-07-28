<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\StudentsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/login','pages.login')->middleware('guest');
Route::view('/forgot-password','pages.forgot_password')->middleware('guest');
Route::post('/login',[UsersController::class, 'userLogin'])->name('login');

Route::middleware(['auth'])->group(function () {
Route::redirect('/', '/home');
Route::get('/home',[StudentsController::class, 'getStudents'])->name('students');
//Route::post('/create-user',[UsersController::class, 'createUser'])->name('create-user');
Route::post('/create-student',[StudentsController::class, 'createStudent'])->name('create-student');
Route::delete('/delete-student/{studentId}',[StudentsController::class, 'deleteStudent'])->name('delete-student');

Route::post('/logout',[UsersController::class, 'logout'])->name('logout');

});
