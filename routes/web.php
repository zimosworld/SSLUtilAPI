<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Api\V1\Controllers'], function ($api) {
    $api->post('decodeCertificate', 'DecodeController@decodeCertificate');

    $api->post('decodeCertificateRequest', 'DecodeController@decodeCertificateRequest');

    $api->post('certificateKeyMatch', 'MatchController@certificateKeyMatch');

    $api->post('certificateCsrMatch', 'MatchController@certificateCsrMatch');

    $api->post('checkSSL', 'CheckController@checkSSL');
});