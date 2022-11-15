<?php

namespace App\Http\Controllers;

use App\Jobs\Salescsvprocess;
use App\Models\Orders;
use App\Models\Sale;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Bus;

class SaleController extends Controller
{
    public function uploadrecords(Request $request)
    {
        if ($request->file('inputFile')) {
            $csv=file($request->file('inputFile'));
            $chunks=array_chunk($csv, 100);
            $csvrowscount=count($csv);
            $header=[];
            $batch=Bus::batch([])->dispatch();
            foreach ($chunks as $key => $chunks) {
                $data=array_map('str_getcsv', $chunks);
                if ($key==0) {
                    $header=$data[0];
                    unset($data[0]);
                }
                $batch->add(new Salescsvprocess($data, $header));
            }

        }
        return['status'=>1,'message'=>'uploaded successfully','csvrowscount'=>$csvrowscount];
    }
     public function fetchdata(Request $request)
     {

     $findall=Sale::all()->count();
     $getfilesize=$request->counts;
     $rr=(100*$findall)/($getfilesize-1);
     return ['status'=>1, 'total'=>$rr];
    }


}
