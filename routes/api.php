<?php

use Illuminate\Http\Request;

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
//
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

$this->resource('/lists', 'MailchimpListController')->except([
    'create', 'edit',
]);

$this->resource('/lists/{list}/members', 'MailchimpListMemberController')
    ->only(['index', 'store',]);

$this->resource('/members', 'MailchimpListMemberController')
    ->only(['show', 'update', 'destroy']);
