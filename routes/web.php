<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CoursesController as AdminCoursesController;
use App\Http\Controllers\Admin\LessonsController as AdminLessonsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\QuestionsController;
use App\Http\Controllers\Admin\QuestionOptionController;
use App\Http\Controllers\Admin\TestsController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\LessonsController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('courses', [CoursesController::class, 'index'])->name('courses');
Route::get('course/{slug}', [CoursesController::class, 'show'])->name('courses.show');
Route::get('lesson/{slug}', [LessonsController::class, 'show'])->name('lessons.show');
Route::get('about', function() {
    return view('about');
})->name('about');
Route::get('contact', function() {
    return view('contact');
})->name('contact');

Route::post('course/enrol', [CoursesController::class, 'enrol'])->name('courses.enrol');

// Route::redirect('/admin', '/login');
Route::get('home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => true]);
Route::get('auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'callback']);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
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
    Route::delete('courses/destroy', [AdminCoursesController::class, 'massDestroy'])->name('courses.massDestroy');
    Route::post('courses/media', [AdminCoursesController::class, 'storeMedia'])->name('courses.storeMedia');
    Route::post('courses/ckmedia', [AdminCoursesController::class, 'storeCKEditorImages'])->name('courses.storeCKEditorImages');
    Route::resource('courses', AdminCoursesController::class);

    // Categories
    Route::delete('categories/destroy', [CategoriesController::class, 'massDestroy'])->name('categories.massDestroy');
    Route::resource('categories', CategoriesController::class);

    // Lessons
    Route::delete('lessons/destroy', [AdminLessonsController::class, 'massDestroy'])->name('lessons.massDestroy');
    Route::post('lessons/media', [AdminLessonsController::class, 'storeMedia'])->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', [AdminLessonsController::class, 'storeCKEditorImages'])->name('lessons.storeCKEditorImages');
    Route::resource('lessons', AdminLessonsController::class);

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


