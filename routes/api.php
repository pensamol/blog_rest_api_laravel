<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\{
    UserController,
    CategoryController,
    SubCategoryController,
    RoleController,
    PostController,
    LoginController
};
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware'=>'cors'], function() { // 

    Route::group(['prefix'=>'v1'], function() {

        Route::controller(LoginController::class)->group(function () {
            Route::post('auth/login', 'login');
        });

        Route::group(['middleware'=>'jwt.verify'], function() {
            
            Route::controller(UserController::class)->group(function () {
                Route::group(['prefix'=>'users'], function() {
                    Route::get('/', 'getUsers');
                    Route::post('/', 'createUser');
                    Route::put('/{id}', 'updateUser');
                    Route::get('/{id}', 'getUser');
                    Route::delete('/{id}', 'deleteUser');
                });
            });
            Route::controller(CategoryController::class)->group(function () {
                Route::group(['prefix'=>'categories'], function() {
                    Route::get('/', 'getCategories');
                    Route::post('/', 'newCategory');
                    Route::put('/{id}', 'updateCategory');
                    Route::delete('/{id}', 'deleteCategory');
                    Route::get('/{id}', 'getCategory');
                });
            });

            Route::controller(SubCategoryController::class)->group(function () {
                Route::group(['prefix'=>'sub-categories'], function() {
                    Route::get('/', 'getSubCategories');
                    Route::post('/', 'createSubCategory');
                    Route::put('/{id}', 'updateSubCategory');
                    Route::get('/{id}', 'getSubCategory');
                    Route::delete('/{id}', 'deleteSubCategory');
                });
            });

            Route::controller(RoleController::class)->group(function () {
                Route::group(['prefix'=>'roles'], function() {
                    Route::get('/', 'getRoles');
                    Route::post('/', 'createRole');
                    Route::put('/{id}', 'updateRole');
                    Route::get('/{id}', 'getRole');
                    Route::delete('/{id}', 'deleteRole');
                });
            });

            Route::controller(PostController::class)->group(function () {
                Route::group(['prefix'=>'posts'], function() {
                    Route::get('/', 'getPosts');
                    Route::post('/', 'createPost');
                    Route::post('/{id}', 'updatePost');
                    Route::get('/{id}', 'getPost');
                    Route::delete('/{id}', 'deletePost');
                });
            });
        });
    });
});

