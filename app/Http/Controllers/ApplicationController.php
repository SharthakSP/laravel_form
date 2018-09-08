<?php

namespace App\Http\Controllers;

use App\UserAccounts;
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
       // $userData=UserAccounts::all();
        $userData=UserAccounts::orderBy('id','desc')->paginate(5);
        return view('home',compact('userData'));

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
            $this->validate($request, [
                'username'=>'required|min:3|max:50',
                'email'=>'email',
                'password'=>'required|confirmed|min:6',
                'image'=>'mimes:jpeg,jpg,png,dng,gif',
            ]);
            $data['username']=$request->username;
            $data['email']=$request->email;
            $data['password']=bcrypt($request->password);
            if($request->hasFile('image')){
                $image = $request->file('image');
                $ext=$image->getClientOriginalExtension();
                $imageName=str_random().'.'.$ext;
                $uploadPath=public_path('public/lib/images');
                if(!$image->move($uploadPath,$imageName))
                {
                    return redirect()->back;
                }
                $data['image']=$imageName;
            }

            /*if(DB::table('useraccounts')->insert($data)){
                return redirect()->route('home')->with('success','Record is inserted');
            }*/
            if(UserAccounts::create($data)){
                return redirect()->route('home')->with('success','Record is inserted');
            }
        }
    }

    public function deleteUser(Request $request)
    {
        $id=$request->user_id;
        if($this->deleteImage($id) && UserAccounts::where('id',$id)->delete())
        {
            return redirect()->route('home')->with('success','Record is deleted');
        }
    }

    public function deleteImage($id)
    {
        $deleteRecord=UserAccounts::findOrFail($id);
        $imageName=$deleteRecord->image;
        $delete_path = public_path('public/lib/images/'.$imageName);
        if(file_exists($delete_path)){
            return unlink($delete_path);
        }
        return true;
    }

    public function editUser(Request $request)
    {
        $id=$request->user_id;
        $editRecord=UserAccounts::findOrFail($id);
        return view('edit_user',compact('editRecord'));
    }

    public function editAction(Request $request)
    {
        $this->validate($request, [
            'username'=>'required|min:3|max:50',
            'email'=>'email',
            'image'=>'mimes:jpeg,jpg,png,dng,gif',
        ]);
        $id=$request->user_id;
        $data['username']=$request->username;
        $data['email']=$request->email;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $ext=$image->getClientOriginalExtension();
            $imageName=str_random().'.'.$ext;
            $uploadPath=public_path('public/lib/images');
            if($this->deleteImage($id) && $image->move($uploadPath,$imageName))
            {
                $data['image']=$imageName;
            }
        }
        if(UserAccounts::where('id',$id)->update($data)){
            return redirect()->route('home')->with('success','Record is updated');
        }
    }
}
