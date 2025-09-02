<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->stream();
});

Route::get('/factura', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML(view('pdf.invoice'));
    return $pdf->stream('invoice.pdf');
});
