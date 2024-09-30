<?php

namespace App\Http\Controllers;

use App\Exports\ItemExcel;

// use Illuminate\Http\Request;
use App\Exports\ExportExcel;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{

    function exportexcel(){

        return Excel::download(new ExportExcel,'user.xlsx');
    }

}
