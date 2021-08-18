<?php

use Illuminate\Http\Request;

// $this->get('categories','Api\CategoryController@index');
// $this->post('categories','Api\CategoryController@store');
// $this->put('categories/{id}','Api\CategoryController@update');
// $this->delete('categories/{id}','Api\CategoryController@destroy');

$this->post('auth', 'Auth\AuthApiController@authenticate');
$this->post('auth-refresh', 'Auth\AuthApiController@RefreshToken');
$this->get('me', 'Auth\AuthApiController@getAuthenticatedUser');
 
$this->group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function (){

    

    $this->apiResource('categories','CategoryController');

    $this->apiResource('products', 'ProductController');

    $this->get('categories/{id}/products', 'CategoryController@products');

});
