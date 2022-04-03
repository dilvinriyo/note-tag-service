<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;

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

// team related routes
Route::get('team', [TeamController::class, 'getAllTeams']); // route to get all available teams
Route::post('team', [TeamController::class, 'createTeam']); // route to create a team

// user related routes
Route::get('user', [UserController::class, 'getAllUsers']); // route to get all available users
Route::post('user', [UserController::class, 'createUser']); // route to create a user
Route::put('user', [UserController::class, 'updateUser']); // route to update a user
Route::delete('user', [UserController::class, 'deleteUser']); // route to delete a user

// note related routes
Route::get('note', [NoteController::class, 'getAllNotes']); // route to get all available notes
Route::post('note', [NoteController::class, 'createNote']); // route to create a note
Route::delete('note', [NoteController::class, 'deleteNote']); // route to delete a note

// tag related routes
Route::get('tag', [NoteController::class, 'getAllTags']); // route to get all avaiable note user tags
Route::post('tag', [NoteController::class, 'tagNoteToUser']); // route to assign or tag a note to a user

