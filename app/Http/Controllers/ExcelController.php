<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{

    function exportexcel(){

        return Excel::download(new ExportExcel,'user.xlsx');
    }
}
