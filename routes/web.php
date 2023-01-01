<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------¬
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//  All listings
Route::get('/', [ListingController::class, "index"]);

// Show create form
Route::get("/listings/create", [ListingController::class, "create"])->middleware("auth");

// Store created listing
Route::post("/listings", [ListingController::class, "store"])->middleware("auth");

// Show edit form
Route::get("/listings/{listing}/edit", [ListingController::class, "edit"])->middleware("auth");

// Show updated listing
Route::put("/listings/{listing}", [ListingController::class, "update"])->middleware("auth");

// Delete listing
Route::delete("/listings/{listing}", [ListingController::class, "destroy"])->middleware("auth");

// Manage listings
Route::get("/listings/manage", [ListingController::class, "manage"])->middleware("auth");

// Single listing
Route::get("/listings/{listing}", [ListingController::class, "show"]);

//
// Users
//
//
// Show register create form
Route::get("/register", [UserController::class, "create"])->middleware("guest");

// Logout user
Route::post("/logout", [UserController::class, "logout"])->middleware("auth");

// Store user
Route::post("/users", [UserController::class, "store"]);

// Show login form
Route::get("/login", [UserController::class, "login"])->name("login")->middleware("guest");

// Log in user
Route::post("/users/authenticate", [UserController::class, "authenticate"]);

/*
Route::get("/hello", function () {
return response("<h1>Hello World</h1>", 200)
->header("Content-Type", "text/plain")
->header("pringao", "si");
});

Route::get("/posts/{id}", function ($id) {
// ddd($id);
return response("Post " . $id);
})->where("id", "[0-9]+");

Route::get("/search", function (Request $request) {
return $request->name . " " . $request->city;
});
 */
