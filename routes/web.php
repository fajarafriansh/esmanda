<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\LessonsController;
use App\Http\Controllers\Admin\QuestionsController;
use App\Http\Controllers\Admin\QuestionOptionController;
use App\Http\Controllers\Admin\TestsController;
use App\Http\Controllers\Auth\ChangePasswordController;

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

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);

    // Courses
    Route::delete('courses/destroy', [CoursesController::class, 'massDestroy'])->name('courses.massDestroy');
    Route::post('courses/media', [CoursesController::class, 'storeMedia'])->name('courses.storeMedia');
    Route::post('courses/ckmedia', [CoursesController::class, 'storeCKEditorImages'])->name('courses.storeCKEditorImages');
    Route::resource('courses', CoursesController::class);

    // Lessons
    Route::delete('lessons/destroy', [LessonsController::class, 'massDestroy'])->name('lessons.massDestroy');
    Route::post('lessons/media', [LessonsController::class, 'storeMedia'])->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', [LessonsController::class, 'storeCKEditorImages'])->name('lessons.storeCKEditorImages');
    Route::resource('lessons', LessonsController::class);

    // Questions
    Route::delete('questions/destroy', [QuestionsController::class, 'massDestroy'])->name('questions.massDestroy');
    Route::post('questions/media', [QuestionsController::class, 'storeMedia'])->name('questions.storeMedia');
    Route::post('questions/ckmedia', [QuestionsController::class, 'storeCKEditorImages'])->name('questions.storeCKEditorImages');
    Route::resource('questions', QuestionsController::class);

    // Question Option
    Route::delete('question-options/destroy', [QuestionOptionController::class, 'massDestroy'])->name('question-options.massDestroy');
    Route::resource('question-options', QuestionOptionController::class);

    // Tests
    Route::delete('tests/destroy', [TestsController::class, 'massDestroy'])->name('tests.massDestroy');
    Route::resource('tests', TestsController::class);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('/', [ChangePasswordController::class, 'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
    }
});
