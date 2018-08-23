<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    protected $data=[];

    public function __construct()
    {
        $this->data['title']='MyProject';
    }

    public function index()
    {
        //$this->data['title'] = 'Home';
        $newsData=News::all();
        return view('home',compact('newsData'));
    }

    public function about()
    {
        $this->data['title'] = 'About';
        return view('about',$this->data);
    }
    public function contact()
    {

        return view('contact',$this->data);
    }

    public function addUser(Request $request)
    {
        if($request->isMethod('get')){
            return redirect()->back();
        }
        if($request->isMethod('post')){
            $data['username']=$request->username;
            $data['email']=$request->email;
            $data['password']=$request->password;
            if(DB::table('useraccounts')->insert($data)){
                return redirect()->route('home')->with('success','Record is inserted');
            }
        }
    }
}
