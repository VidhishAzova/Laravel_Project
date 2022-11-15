<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Availableproductcategory;
use App\Models\Products as ModelsProducts;

class Products extends Controller
{
    public function addproducts()
    {
        $listcategory=Availableproductcategory::all();
        return view('addingproducts')->with(compact('listcategory'));
    }

    public function addingproduct(Request $r)
    {
        $products=new ModelsProducts();
        $products->productname=$r->get('productname');
        $products->productdescription=$r->get('productdescription');
        $products->productcategory=$r->get('productcategory');
        $products->productimage=$r->get('productimage');
        if($files=$r->file('productimage'))
        {
            $name=$files->getClientOriginalName();
            $products->productimage=$name;
            $files->move('productimages',$name);
        }
        $products->productquantity=$r->get('productqauntity');
        $products->productprice=$r->get('productprice');
        $products->save();
        return redirect()->back()->with('message', 'productadded');
    }

    public function deleteproduct($pid)
    {
        $deleteproduct=ModelsProducts::where('pid',$pid);
        $deleteproduct->delete();
        return redirect()->back()->with('messagedel', 'productdeleted');
    }

    public function updateproduct(Request $r,$pid)
    {
        $updateproduct=ModelsProducts::find($pid);
        $updateproduct->productname=$r->get('productname');
        $updateproduct->productcategory=$r->get('productcategory');
        if($r->hasFile('productimage'))
        {
            $updateproduct->productimage=$r->get('productimage');
            $files=$r->file('productimage');
            $name=$files->getClientOriginalName();
            $updateproduct->productimage=$name;
            $files->move('productimages',$name);
        }
        else
        {
            echo $r->get('productimage');
        }
        $updateproduct->productquantity=$r->get('productqauntity');
        $updateproduct->productprice=$r->get('productprice');
        $updateproduct->save();
        return redirect()->back()->with('messageupt','productupdated');
    }
}
