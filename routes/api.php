<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin\PermissionsApiController;
use App\Http\Controllers\Api\V1\Admin\RolesApiController;
use App\Http\Controllers\Api\V1\Admin\UsersApiController;
use App\Http\Controllers\Api\V1\Admin\CoursesApiController;
use App\Http\Controllers\Api\V1\Admin\LessonsApiController;
use App\Http\Controllers\Api\V1\Admin\QuestionsApiController;
use App\Http\Controllers\Api\V1\Admin\QuestionOptionApiController;
use App\Http\Controllers\Api\V1\Admin\TestsApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', PermissionsApiController::class);

    // Roles
    Route::apiResource('roles', RolesApiController::class);

    // Users
    Route::apiResource('users', UsersApiController::class);

    // Courses
    Route::post('courses/media', [CoursesApiController::class, 'storeMedia'])->name('courses.storeMedia');
    Route::apiResource('courses', CoursesApiController::class);

    // Lessons
    Route::post('lessons/media', [LessonsApiController::class, 'storeMedia'])->name('lessons.storeMedia');
    Route::apiResource('lessons', LessonsApiController::class);

    // Questions
    Route::post('questions/media', [QuestionsApiController::class, 'storeMedia'])->name('questions.storeMedia');
    Route::apiResource('questions', QuestionsApiController::class);

    // Question Option
    Route::apiResource('question-options', QuestionOptionApiController::class);

    // Tests
    Route::apiResource('tests', TestsApiController::class);
});
