<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


// Route::view('/', 'posts.index')->name('home');
Route::redirect('/','posts');
Route::resource('posts',PostController::class);

Route::get('/{users}/posts',[DashboardController::class, 'userPosts'])->name('user.posts');

// Route::get('/show',[PostController::class, 'show'])->name('show.posts');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index']
    )->name('dashboard');
    
    Route::post('/logout', [AuthController::class, 'logout']
    )->name('logout');   
});

Route::middleware('guest')->group(function(){
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register',[AuthController::class,'register']);
    
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login',[AuthController::class,'login']);
});



