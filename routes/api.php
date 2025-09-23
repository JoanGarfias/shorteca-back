<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sanctum/csrf-cookie', function (Request $request) {
    // Obtenemos el token CSRF de la sesión
    $token = $request->session()->token();

    // Creamos la cookie manualmente con los atributos correctos
    $cookie = [
        'XSRF-TOKEN',
        $token,
        0, // Duración (0 = hasta que se cierre el navegador)
        '/',
        null, // Dominio, déjalo en null para que funcione en localhost
        false, // Secure (HTTP)
        false, // httpOnly
        false, // raw
        'None' // sameSite
    ];

    // Devolvemos una respuesta vacía con la cookie adjunta
    return response()->noContent()->cookie($cookie);
});
