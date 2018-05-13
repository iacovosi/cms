<?php

Route::post('/subscribe', function(){
    $email = request('email');

    Newsletter::subscribe($email);

    Session::flash('subscribed', 'Successfully subscribed.');
    return redirect()->back();
});


Route::get('/', [
    'uses' => 'FrontEndController@index',
    'as' => 'index'
]);

Route::get('/sigmalive', [
    'uses' => 'FrontEndController@sigmalive',
    'as' => 'sigmalive'
]);

Route::get('/post/single/{id}', [
    'uses' => 'FrontEndController@showArticle',
    'as' => 'post.single'
]);

Route::get('/results', function(){
        $posts = \App\Post::where('title','like',  '%' . request('query') . '%')->get();

        return view('results')->with('posts', $posts)
                              ->with('title', 'Search results : ' . request('query'))
                              ->with('categories', \App\Category::take(5)->get())
                              ->with('query', request('query'));
});


Auth::routes();



Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

    Route::get('/dashboard', [
        'uses' => 'HomeController@index',
        'as' => 'home'
    ]);

    Route::get('/post/create', [
        'uses' => 'PostsController@create',
        'as' => 'post.create'
    ]);

    Route::post('/post/store', [
        'uses' => 'PostsController@store',
        'as' => 'post.store'
    ]);

    Route::get('/post/delete/{id}', [
        'uses' => 'PostsController@destroy',
        'as' => 'post.delete'
    ]);

    Route::get('/posts', [
        'uses' => 'PostsController@index',
        'as' => 'posts'
    ]);

    Route::get('/draglist', [
        'uses' => 'PostsController@draglist',
        'as' => 'draglist'
    ]);

    Route::get('/posts/edit/{id}', [
        'uses' => 'PostsController@edit',
        'as' => 'post.edit'
    ]);

    Route::post('/post/update/{id}', [
        'uses' => 'PostsController@update',
        'as' => 'post.update'
    ]);

    Route::get('/category/create', [
        'uses' => 'CategoriesController@create',
        'as' => 'category.create'
    ]);

    Route::get('/categories', [
        'uses' => 'CategoriesController@index',
        'as' => 'categories'
    ]);
    
    Route::post('/category/store', [
        'uses' => 'CategoriesController@store',
        'as' => 'category.store'
    ]);

    Route::get('/category/edit/{id}', [
        'uses' => "CategoriesController@edit",
        'as' => 'category.edit'
    ]);

    Route::get('/category/delete/{id}', [
        'uses' => "CategoriesController@destroy",
        'as' => 'category.delete'
    ]);

    Route::post('/category/update/{id}', [
        'uses' => 'CategoriesController@update',
        'as' => 'category.update'
    ]);


    

    Route::get('/users', [
        'uses' => 'UsersController@index',
        'as' => 'users'
    ]);

    Route::get('/user/create', [
        'uses' => 'UsersController@create',
        'as' => 'user.create'
    ]);

    Route::post('/user/store', [
        'uses' => 'UsersController@store',
        'as' => 'user.store'
    ]);

    Route::get('user/admin/{id}', [
        'uses' => 'UsersController@admin',
        'as' => 'user.admin'
    ]);

    Route::get('user/not-admin/{id}', [
        'uses' => 'UsersController@not_admin',
        'as' => 'user.not.admin'
    ]);


    Route::get('user/delete/{id}', [
        'uses' => 'UsersController@destroy',
        'as' => 'user.delete'
    ]);

    
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
