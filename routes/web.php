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

Route::get('/','Web\HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/user', 'UserController@getUsers')->name('users');
    Route::get('/recipes-admin', 'RecipeController@getRecipesForAdmin')->name('recipes.admin');

    Route::delete('/user/{id}', 'UserController@removeUser')->name('remove-user');

    Route::group(['prefix' => 'competition'], function (){
        Route::get('/','CompetitionController@getCompetitions')->name('competitions');
        Route::post('/','CompetitionController@addCompetition')->name('competition.create');
        Route::get('{id}','CompetitionController@findCompetition')->name('competition.details');
        Route::post('{id}','CompetitionController@updateCompetition')->name('competition.update');
        Route::delete('{id}','CompetitionController@deleteCompetition')->name('competition.delete');
    });
});
Route::group(['prefix' => 'search'], function (){
    Route::get('/recipes','Web\RecipeController@getRecipes')->name('search-recipes');
    Route::get('/users','Web\UserController@getUsers')->name('search-users');
    Route::get('/competitions','Web\CompetitionController@getCompetitions')->name('search-competitions');
});
Route::get('/recipe-view/{id}', 'Web\RecipeController@findRecipe')->name('get-recipe-view');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/recipe/{id}/comments/', 'Web\RecipeController@getCommentsByRecipeId')->name('get-comments-recipe');
    Route::post('/recipe/{id}/comment/', 'Web\RecipeController@createCommentByRecipe')->name('create-comment-recipe');

    Route::post('/like-recipe/{id}', 'Web\RecipeController@likeRecipe')->name('like-recipe');
    Route::post('/unlike-recipe/{id}', 'Web\RecipeController@unlikeRecipe')->name('unlike-recipe');

    Route::get('/profile', 'UserController@getProfile')->name('profile');
    Route::post('/user/{id}', 'UserController@updateUser')->name('user-update');

    Route::get('/change-role/', 'Web\UserController@changeRole')->name('change-role');

    Route::get('/get-recipes-participate/{competitionId}', 'web\RecipeController@getRecipesParticipate')->name('get-recipes-participate');
    Route::post('/participate/{competitionId}/{recipeId}', 'web\RecipeController@participate')->name('participate');

    Route::get('/get-recipes', 'RecipeController@getRecipes')->name('get-recipes');
    Route::delete('/recipe/{id}', 'RecipeController@removeRecipe')->name('remove-recipe');
    Route::post('/recipe', 'RecipeController@createRecipe')->name('create-recipe');
    Route::get('/recipe/{id}', 'Web\RecipeController@findRecipe')->name('find-recipe');
    Route::post('/recipe/{id}', 'RecipeController@updateRecipe')->name('update-recipe');
    Route::get('/tags', 'TagController@getTags')->name('tags');

    Route::get('/comments-recipes', 'CommentController@getCommentsRecipes')->name('comments-recipes');
    Route::delete('/comment/{id}', 'CommentController@removeComment')->name('remove-comment');

    Route::get('/ranking', 'RankingController@getRanking')->name('ranking');
    Route::get('/ranking/{id}', 'RankingController@getRankingByCompetition')->name('ranking-competition');

});