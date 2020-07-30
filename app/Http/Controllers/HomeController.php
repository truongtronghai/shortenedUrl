<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Url;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if($this->ignoreGuestAccount())
            return redirect('/');        

        if(Auth::user()->role<=1){
            return view('admin.home',[
                'totalUsers'=>User::where('role','>', 1)->count(),
                'totalUrls'=>Url::count(),
                'totalPendingUrls'=>Url::where([
                    ['expired_at','<', now()],
                    ['kept_to','>=', now()],
                ])->count(),
                'totalActiveUrls'=>Url::where('expired_at','>', now())->count(),
                'totalCustomUrls'=>Url::where([
                    ['expired_at','>', now()],
                    ['is_custom',1]
                ])->count(),
                'totalRandomUrls'=>Url::where([
                    ['expired_at','>', now()],
                    ['is_custom',0]
                ])->count(),
                'totalInactiveUrls'=>Url::where('kept_to','<', now())->count(),
                ]);
        }
        else{
            return view('admin.home',[
                'totalActiveUrls'=>Url::where([
                    ['expired_at','>', now()],
                    ['user_id',Auth::user()->id],
                ])->count(),
                'totalCustomUrls'=>Url::where([
                    ['expired_at','>', now()],
                    ['is_custom',1],
                    ['user_id',Auth::user()->id],
                ])->count(),
                'totalRandomUrls'=>Url::where([
                    ['expired_at','>', now()],
                    ['is_custom',0],
                    ['user_id',Auth::user()->id],
                ])->count(),
                'nCustomUrls'=>User::where('id',Auth::user()->id)->first()->branded,
            ]);
        }
    }

    public function users(Request $req){
        if($this->ignoreGuestAccount())
            return redirect('/');

        $constrain = [];
        if($req->isMethod('post')){
            if($req->input('name'))
                array_push($constrain,['name','like',"%".$req->input('name')."%"]);
            if($req->input('email'))
                array_push($constrain,['email','like',"%".$req->input('email')."%"]);
            if(!is_null($req->input('role'))) // vi role co gia tri = 0 nen xet null de khong danh gia 0 la null
                array_push($constrain,['role',$req->input('role')]);
        }
        
        if(Auth::user()->role<=1){
            return view('admin.users',[
                'users'=>User::where($constrain)->paginate(50),
                ]);
        }

        return redirect('home');
    }

    public function urls(Request $req){
        if($this->ignoreGuestAccount())
            return redirect('/');

        $constrain = [];

        if(Auth::user()->role<=1){
            // neu la tai khoan System admin va Guest thi tam thoi de trong
            
        }else{
            array_push($constrain,['user_id',Auth::user()->id]);
            array_push($constrain,['expired_at','>',now()]);    
        }

        if($req->isMethod('post')){ // nhan du lieu duoc submit tu form
            if($req->input('original'))
                array_push($constrain,['url','like',"%".$req->input('original')."%"]);
            if($req->input('short'))
                array_push($constrain,['shortened','like',"%".$req->input('short')."%"]);
            if(!is_null($req->input('sort'))) // neu co yeu cau sap xep
                return view('admin.urls',[
                    'urls'=>Url::where($constrain)->orderBy('count',$req->input('sort'))->paginate(50),
                    ]);
        }

        return view('admin.urls',[
            'urls'=>Url::where($constrain)->paginate(50),
            ]);
    }

    public function changeUsername(Request $req){
        if (!Auth::check()) {
            // The user is not logged in...
            return 'No back door for bag guy!';
        }

        $u = User::where('id',$req->userid)->first();
        if(is_null($u))
            return '';
        else{
            try{
                $u->name = $req->username;
                $u->save();
                return $req->username;
            }catch(\Exception $e){
                Log::debug('HomeController::changeUsername('.$req->username.') : '.$e->getMessage());
                return '';
            }
        }
        
    }
    /**
     * Bo qua tai khoan Guest muon xem trang admin. Chen ham nay truoc moi method.
     * Co the su dung Authorization thay cho cach nay khong ?
     */
    protected function ignoreGuestAccount(){
        if(Auth::user()->role == 1) 
        {
            auth()->logout();
            return true;
        }

        return false;
    }
}
