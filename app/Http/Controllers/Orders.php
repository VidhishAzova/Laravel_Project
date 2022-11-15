<?php

namespace App\Http\Controllers;
use App\Models\Orders as ModelsOrders;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Orders extends Controller
{
    public function store(Request $r,$pid)
    {
        $storeorder=new ModelsOrders();
        $storeorder->uid=Auth::user()->uid;
        $storeorder->pid=$r->pid;
        $storeorder->totalquantity=$r->totalquantity;
        if($r->totalquantity == 1)
        {
           $storeorder->totalprice=$r->perprice;
           $productfind=Products::find($pid)->decrement('productquantity');
        }
        else
        {
            $storeorder->totalprice=$r->perprice * $r->totalquantity;
            $productfind=Products::find($pid)->decrement('productquantity', $r->totalquantity);
        }
        $storeorder->save();
        // $newquantity=[];
        $productdetails=Products::find($pid);
        return ['status'=>1, 'message'=>'saved successfully','newquantity'=>$productdetails->productquantity];
    }

    public function createPDF($pdfid)
    {
        $show=ModelsOrders::select('orders.*', 'products.*', DB::raw('SUM(orders.totalquantity) as totalq'), DB::raw('SUM(orders.totalprice) as totalp'))->leftJoin('products', 'orders.pid', '=', 'products.pid')->where('uid', '=', $pdfid)->groupBy('products.pid')->withTrashed()->get();
        $html = view('pdfview',compact('show'))->render();
        $pdf =PDF::loadHTML($html);
        return $pdf->download('orders.pdf');
        //setoptions(['font'=>'sans-serif']);
    }

    public function viewallcustomerorder(Request $r)
    {
        $pdfid=Auth::user()->uid;
        $listallorders=ModelsOrders::select('orders.oid', 'products.*', DB::raw('SUM(orders.totalquantity) as totalq'), DB::raw('SUM(orders.totalprice) as totalp'))->leftJoin('products', 'orders.pid', '=', 'products.pid')->where('uid', '=', Auth::user()->uid)->groupBy('products.pid')->withTrashed()->get();
        return view('viewallcustomerorder')->with(compact('listallorders','pdfid'));
    }

    public function allordersview()
    {
        $listallcustomersorders=ModelsOrders::select('orders.*', 'products.*', 'user.*', DB::raw('SUM(orders.totalquantity) as totalq'), DB::raw('SUM(orders.totalprice) as totalp'))->leftJoin('products', 'orders.pid', '=', 'products.pid')->leftJoin('user', 'orders.uid', '=', 'user.uid')->groupBy('orders.uid','products.pid')->withTrashed()->get();
        return view('allorders')->with(compact('listallcustomersorders'));
    }

    public function softdeletion()
    {
        $getid=Auth::user()->uid;
        $query=ModelsOrders::where('uid',$getid)->delete();
        //print_r($query);
    }
    public function ajaxorders(Request $request)
    {
        $draw=$request->get("draw");
        $start=$request->get("start");
        $rowperpage=$request->get("length");
        //For Total Records
        $totalrecords=ModelsOrders::select('count(*) as allcount')->count();
        $records=ModelsOrders::select('orders.*')->skip($start)->take($rowperpage)->get();
        $data_arr=array();
        foreach($records as $record)
        {
            $id=$record->id;
            $productname=$record->productname;
            $productquantity=$record->productquantity;
            $productprice=$record->productprice;

        $data_arr[]=array(
            "productid"=>$id,
            "productname"=>$productname,
            "quantity"=>$productquantity,
            "price"=>$productprice
        );
        }
        $response=array(
            "draw"=>intval($draw),
            "itotalrecord"=>$totalrecords,
            "aadata"=>$data_arr
        );
        return response()->json($response);
    }
}
