<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DownloadController;
use App\Models\Author;
use App\Models\Book;
use App\Models\comment;
use Illuminate\Support\Facades\Route;

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

Route::get('/lang','Controller@lang')->name('lang');
Route::get('download/{filename}', 'DownloadController')->name('download');

Route::get('/', 'HomeController')->name('main');

Route::get('/author/{id}', [AuthorController::class,'author'])->name('author');
Route::get('/authors', [AuthorController::class,'authors'])->name('authors');
Route::get('/authors/search','AuthorController@authors_search')->name('authors_scearch');


Route::get('/book/{id}',[BookController::class,'book'])->name('book');
Route::get('/books', [BookController::class,'books'])->name('books');
Route::get('/books/search','BookController@books_search')->name('books_scearch');


Route::get('/contact', [\App\Http\Controllers\ContactController::class,'index'])->name('contact');
Route::post('/contact/post','ContactController@store')->name('contact.save');

Route::post('/comment/post','CommentController@store')->name('comment.save')->middleware('auth');

Route::view('/login','auth.login')->middleware('guest');


Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
    Route::view('/','admin.home')->name('home');

    Route::view('/user/register', 'admin.users.user_register')->name('user.register');
    Route::post('/users/register','Admin\User@register_users')->name('users.register');

    Route::get('/user','Admin\User@admin_user')->name('user');
    Route::view('/users','admin.users.users')->name('users');

    Route::get('/users/update/{id}',function($id){
        return view('admin.users.user_update',compact('id'));
    })->name('user.update');
    Route::post('/users/update','Admin\User@update_users')->name('user.updated');

    Route::post('/users','Admin\User@search')->name('users.search');
    Route::get('/users/delete/{id}','Admin\User@delete_users')->name('user.delete');

    Route::get('/books/create','Admin\Book@admin_book_create_view')->name('books.create');
    Route::view('/book/create', 'admin.book.book_create')->name('book.create');
    Route::post('/books/create','Admin\Book@create_books')->name('books.create');

    Route::get('/book','Admin\Book@admin_book')->name('book');
    Route::view('/books','admin.book.books')->name('books');

    Route::get('/books/update/{id}','Admin\Book@admin_book_update_view')->name('book.update');
    Route::post('/books/update','Admin\Book@update_books')->name('book.updated');

    Route::post('/books','Admin\book@search')->name('books.search');
    Route::get('/books/delete/{id}','Admin\Book@delete_books')->name('book.delete');

    // Route::get('/authors/create','Admin\author@admin_author_create_view')->name('authors.create');
    Route::view('/author/create', 'admin.author.author_create')->name('author.create');
    Route::post('/authors/create','Admin\Author@create_authors')->name('authors.create');

    Route::get('/author','Admin\Author@admin_author')->name('author');
    Route::view('/authors','admin.author.authors')->name('authors');

    Route::get('/authors/update/{id}',function($id){
        return view('admin.author.author_update',compact('id'));
    })->name('author.update');
    Route::post('/authors/update','Admin\author@update_authors')->name('author.updated');

    Route::post('/authors','Admin\Author@search')->name('authors.search');
    Route::get('/authors/delete/{id}','Admin\Author@delete_authors')->name('author.delete');

    Route::get('contact','Admin\Contact@admin_contact')->name('contact');
    Route::view('/contacts','admin.contacts')->name('contacts');
    Route::post('/contact/search','Admin\Contact@contact_search')->name('contact.search');
    Route::get('/contact/delete/{id}','Admin\Contact@contact_delete')->name('contact.delete');

});;

Auth::routes();


