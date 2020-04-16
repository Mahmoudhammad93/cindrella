<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\User;
use App\models\Supplier;
use App\models\Product;
use App\models\Invoice;
use App\models\Box;
class Dashboard extends Controller
{
    public function index()
    {
        $users     = User::all();
        $suppliers = Supplier::all();
        $products  = Product::all();
        $totalGard = 0;
        $totalAlert = 0;
        foreach($products as $progard){
           $totalGard = $totalGard + ( $progard->sell_price * $progard->quantity ) ;
           if($progard->quantity < $progard->alert_quantity ){
              $totalAlert = $totalAlert + 1;
           }
        }

        $box  = Box::orderBy('id','desc')->first();
        $purchaseInvoice = Invoice::where('invoice_type','=',0)->get();
        $sellInvoice = Invoice::where('invoice_type','=',1)->get();
        $totalgainToday = Invoice::where('invoice_type','=',1)->where('date','=',date('Y-m-d'))->get();
        $todayTotalGain = 0 ;
        foreach($totalgainToday as $toGa){
           $todayTotalGain = $todayTotalGain + $toGa->total_gain ;
        }

        $PageTitle = trans('main.dashboard');
        $headerLevelProcessTitle1 = "Dashboard ( لوحة التحكم )";
        $headerLevelProcessTitle2 = "Statidtics ( احصائيات )";
        $buttonsRoutsname = $modelViewName = "dashboard";

        return View('Admin.dashboard',compact('totalAlert','totalGard','todayTotalGain','box','sellInvoice','purchaseInvoice','products','suppliers','users','PageTitle','buttonsRoutsname','headerLevelProcessTitle1','headerLevelProcessTitle2'));

    }
}
