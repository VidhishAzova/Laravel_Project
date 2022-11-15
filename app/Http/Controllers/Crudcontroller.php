<?php

namespace App\Http\Controllers;

use App\Models\Availableproductcategory;
use App\Models\Crud;
use App\Models\Products;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Cookie as HttpFoundationCookie;

use Illuminate\Support\Facades\DB;
use App\Models\Qualification;
use App\Models\Regis_qualification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class Crudcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewandgetqualification()
    {
        $listallqualification=Qualification::all();
        return view('create',compact('listallqualification'));
       // $all=Cookie::make();
    }
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $crud=new Crud;
        $crud->first_name=$request->get('first_name');
        $crud->last_name=$request->get('last_name');
        $crud->gender=$request->get('gender');
        $crud->email=$request->get('email');
        $crud->states=$request->get('states');
        $crud->number=$request->get('number');
        if($files=$request->file('profilepic'))
        {
            $name=$files->getClientOriginalName();
            $files->move('uploads',$name);
            $crud->profilepic=$name;
        }
        // $crud->password=Crypt::encrypt($request->get('password'));
        $crud->password=bcrypt($request->get('password'));

        $crud->save();
        foreach($request->get('qualification') as $qualification_id)
        {
            $qualification=new Regis_qualification();
            $qualification->uid=$crud->uid;
            $qualification->qid=$qualification_id;
            $qualification->save();
        }

        return back()->with('success', 'Employee added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $listall=DB::select("SELECT *,user.uid,GROUP_CONCAT(DISTINCT qualification.qname) as total_qualification FROM user LEFT JOIN regis_has_qualification ON regis_has_qualification.uid=user.uid LEFT JOIN qualification ON qualification.qid=regis_has_qualification.qid GROUP BY user.uid");
        //$decrypt= Crypt::decrypt($data->password);
        return view('showall',compact('listall'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($crudid)
    {
        $crudid=Auth::user()->uid;
        $crud=Crud::find($crudid);
        $listall=Qualification::all();
        $checkedone=DB::select("SELECT qid FROM regis_has_qualification WHERE uid='$crudid'");
        //print_r(array_column($checkedone,'qid'));
        //exit;
        $crudprofile=Auth::user()->profilepic;
        return view('editemployee',compact('crud','crudid','listall','checkedone','crudprofile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $crudid)
    {
        $crud=Crud::find($crudid);
        $crud->first_name=$request->get('first_name');
        $crud->last_name=$request->get('last_name');
        $crud->gender=$request->get('gender');
        $crud->email=$request->get('email');
        $crud->states=$request->get('states');
        $crud->number=$request->get('number');
        if($files=$request->file('profilepic'))
        {
            $name=$files->getClientOriginalName();
            $files->move('uploads',$name);
            $crud->profilepic=$name;
        }

        $verifyquery=DB::select("SELECT qid FROM regis_has_qualification  WHERE uid='$crudid'");
        foreach($request->get('qualification') as $qualification_id)
        {
            $a[]=$qualification_id;
        }
        $array_verified=array_column($verifyquery,'qid');
        if($results=array_diff($a,$array_verified))
         {
             //print_r($results);
             foreach($results as $result)
             {
                $regis_qualification=new Regis_qualification;
                $values=array('uid'=>$crudid,'qid'=>$result);
                $regis_qualification->insert($values);
                //$regis_qualification=new Regis_qualification();
                //$regis_qualification=DB::insert('Insert into regis_has_qualification (uid,qid) values (?,?)', [$crud->uid, $result]);
                // $regis_qualification->timestamps();
                //$regis_qualification->save();
            }
         }
         if($resultss=array_diff($array_verified,$a))
         {
            print_r($resultss);
            foreach($resultss as $result)
            {
                $regis_qualification=Regis_qualification::where("uid","=",$crudid)->where("qid","=",$result);
                $regis_qualification->delete();
               //$regis_qualification->save();
            }
        }
        $crud->save();
        //return redirect('welcome')->with(compact('crudid'));

        $request->session()->pull('first_name');
        $users = DB::table('user')->select('first_name')->where('uid',Auth::user()->uid)->first();
        Session::put('first_name',$users->first_name );
        $crudid=Auth::user()->uid;
        $crudprofile=Auth::user()->profilepic;
        //this line not working
        echo "<script>window.alert('Profile Updated');</script>";
        return redirect('welcome')->with(compact('crudid','crudprofile'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid)
    {
        $crud=Crud::find($uid);
        $crud->delete();
        $delete_qualification=Regis_qualification::where("uid","=",$crud->uid);
        $delete_qualification->delete();
        //DB::delete('Delete from regis_has_qualification where uid = ?',[$uid]);
        $listall=Crud::all();
        return redirect('show')->with(compact('listall'));
    }
    public function viewlogin()
    {
    return view('login');
    }
    public function checklogin(Request $r)
    {
        if (Auth::attempt(['email' => $r->get('email'), 'password' => $r->get('password')]))
        {
            // Auth::user();
            // print_r(Auth::user());exit;
            //$firstname=Crud::select('firstname')->where('email',$r->get('email'));
            // echo Auth::user()->uid;exit;
            //$timeout = 2;
            //ini_set( "session.gc_maxlifetime", $timeout );
            echo "<script>window.alert('Welcome')</script>";
            $users = DB::table('user')->select('first_name')->where('uid',Auth::user()->uid)->first();
            Session::put('first_name',$users->first_name );
            return redirect('welcome');
        }
        else
        {
            echo "<script>window.alert('Invalid Login')</script>";
            return view('login');
        }
    }
    public function home()
    {
        $crudid=Auth::user()->uid;
        $crudprofile=Auth::user()->profilepic;
        $productss=Products::select('products.*','available_product_category.productcategoryname')->leftJoin('available_product_category','products.productcategory','=','available_product_category.pcid')->get();

        $listcategory=Availableproductcategory::all();

        return view('welcome')->with(compact('productss','crudid','crudprofile','listcategory'));
        //for model product id
        // $productid=Products::select('products.*','available_product_category.productcategoryname')->leftJoin('available_product_category','products.productcategory','=','available_product_category.pcid')->where('pid','=',$pid)->first();
    }
    public function showallcustomers()
    {
        $allcustomers=Crud::all();
        return view('showall')->with(compact('allcustomers'));
    }
    //for forgot password
    public function viewforgotpassword()
    {
        return view('viewforgotpassword');
    }
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
          ]);

        Mail::send('email.forgetpassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    //for resetpassword
    public function showResetPasswordForm(Request $r,$token)
    {
        return view('resetpasswordform', ['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->session()->pull('first_name');
        return view('login');
    }

}
