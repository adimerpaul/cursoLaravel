<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class UsersController extends Controller
{
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import() 
    {
        Excel::import(new UsersImport, 'users.xlsx');

        return 'Import completed';
    }
    public function test() 
    {
        Mail::to("adimer101@gmail.com")->send(new TestMail());
        return "Hola";
    }

    public function qr(Request $req) 
    {
        $payload = "Adimer Paul Chambi Ajata";
        return view('qrs.single', compact('payload'));
    }
}
