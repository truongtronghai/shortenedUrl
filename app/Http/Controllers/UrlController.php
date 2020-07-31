<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use App\Url;
use App\User;

class UrlController extends Controller
{
    public function __construct(){
        session([
            'n_urls' => Url::count(),
            'n_users' => User::where('role','>',1)->count(),
            'n_using'=> Url::sum('count')
        ]);
    }

    public function index(){
        return view('url');
    }
    
    public function store(Request $req){
        $user_id = 2; // neu khong auth() se mac dinh la Guest (user_id=2)
        $resultUrl = "";
        
        if(auth()->check()){
            $user_id = auth()->user()->id;
            // khi la 1 logged in user thi moi xet toi customString
            $tmp = $req->input('customString');
            // neu chuoi custom nay dang duoc su dung
            if($this->checkDuplicateCustomString($tmp)){
                $req->session()->flash('sessionNotification',$tmp.' '.__('messages.textDuplicateCustomString'));
                return view('url'); // ve trang chinh de thong bao loi
            }

            if(isset($tmp)){ // Neu user co su dung customString hoan toan moi
                if($this->getNumberOfBrandedString($user_id)){ // kiem tra xem nguoi nay con so luong branded (>0) de su dung hay khong
                    $resultUrl = $tmp;
                    // tao mot record moi trong url table va luu no. Dong thoi cap nhat giam so luong branded string cua user
                    try{

                        $url = new Url([
                            'url'=> $req->input('originalUrl'),
                            'shortened' => $resultUrl,
                            'user_id'=>$user_id, 
                            'count'=>0,
                            'is_custom'=>true,
                        ]);
                        $url->save();

                        try{
                            $user = new User();
                            $user = $user->where('id',$user_id)->first();
                            $user->branded = $user->branded - 1;
                            $user->save();
                        }catch(\Exception $e){
                            Log::debug('UrlController::store()-update number of branded string of user : '.$e->getMessage());
                            $req->session()->flash('sessionNotification',__('messages.textErrorDb')); // khong luu duoc vao db
                            return view('url'); // ve trang chinh de thong bao loi
                        }
                        // tao va save thanh cong
                        return view('url')->with('resultUrls',['result'=>$resultUrl,'original'=>$req->input('originalUrl')]);
                    }catch(\Exception $e){
                        Log::debug('UrlController::store()-store new record with custome string to url table : '.$e->getMessage());
                        $req->session()->flash('sessionNotification',__('messages.textErrorDb')); // khong luu duoc vao db
                        return view('url'); // ve trang chinh de thong bao loi
                    }
                }else{
                    // neu khong con thi thong bao cho user
                    $req->session()->flash('sessionNotification',__('messages.textRunOutBrandedString'));
                    return view('url'); // ve trang chinh de thong bao loi
                }
                
            }
        } 
        
        $url = new Url();
        // tim xem co record nao trong bang url cua DB ma da het han
        $url = $url->where('kept_to','<=',date('Y-m-d H:i:s'))->orderby('id')->first();
        
        if(isset($url)){ // neu co mot record da het han thi tai su dung
            try{ // update vao db
                $url->user_id = $user_id;
                $url->url = $req->input('originalUrl');
                $url->count = 0;
                $url->is_custom = true; // khi tai su dung thi khong xem no la custom nua vi nguoi khac su dung thi chi la random
                // cap nhat lai ngay thang het han cua url
                switch($this->getRoleOfUser($user_id)){
                    case 0: // neu user la system admin (tam thoi cho giong loai user role=2)
                    case 2: // neu user la logged in
                        $dt = new \DateTime(now()); // dau '\' phia truoc la de Laravel biet ham nay cua PHP
                        $url->created_at = date_format($dt, 'Y-m-d h:m:s');
                        
                        $dt = $dt->add(new \DateInterval('P6M')); // het han sau 6 thang (P6M)
                        $url->expired_at = date_format($dt, 'Y-m-d h:m:s');
                        
                        $dt = $dt->add(new \DateInterval('P3M')); // them 3 thang de luu giu truoc khi tai su dung
                        $url->kept_to = date_format($dt, 'Y-m-d h:m:s');
                        break;
                    default: // mac dinh user la role=1 (guest)
                        $dt = new \DateTime(now());
                        $url->created_at = date_format($dt, 'Y-m-d h:m:s');
                        
                        $dt = $dt->add(new \DateInterval('P3M')); // het han mac dinh la 3 thang (P3M)
                        $url->expired_at = date_format($dt, 'Y-m-d h:m:s');
                        
                        $dt = $dt->add(new \DateInterval('P3M')); // them 3 thang de luu giu truoc khi tai su dung
                        $url->kept_to = date_format($dt, 'Y-m-d h:m:s');
                }

                $resultUrl = $url->shortened;// lay lai chuoi tai su dung
                $url->save();

                return view('url')->with('resultUrls',['result'=>$resultUrl,'original'=>$req->input('originalUrl')]);
            }catch(\Exception $e){
                Log::debug('UrlController::store()-update recycled record to url table : '.$e->getMessage());
                $req->session()->flash('sessionNotification',__('messages.textErrorDb')); // khong luu duoc vao db
                return view('url');
            }
        }else{ // neu khong co cai de tai su dung thi tao record moi
            $resultUrl = $this->shorteningUrlV2(); // neu chua co thi tien hanh tao URL rut gon
            // save vao db
            try{
                $url = new Url([
                    'url'=> $req->input('originalUrl'),
                    'shortened' => $resultUrl,
                    'user_id'=>$user_id, 
                    'count'=>0,
                    'is_custom'=>false,
                ]);
                $url->save();
                return view('url')->with('resultUrls',['result'=>$resultUrl,'original'=>$req->input('originalUrl')]);
            }catch(\Exception $e){
                
                Log::debug('UrlController::store()-store new record to db : '.$e->getMessage());
                $req->session()->flash('sessionNotification',__('messages.textErrorDb')); // khong luu duoc vao db
                return view('url');
            }
        }
        
    }

    public function run($short){
        
        // update vao db gia tri dem so lan truy cap thong qua URL rut gon
        try{
            $url = new Url();
            $url = $url->where([
                    ['shortened',$short],
                    ['expired_at','>=',date('Y-m-d H:i:s')] // cac url chua het han
                ])->first();
                
            $url->count = $url->count + 1;
            $url->save(); // neu dieu kien truy xuat tren khong dung ( khong co URL thoa dieu kien ) thi tai day se throw ra error
            return redirect()->away($url->url);
        }catch(\Exception $e){
            Log::debug('UrlController::run('.$short.') : '.$e->getMessage());
            session()->flash('sessionNotification',__('messages.textShortUrlErrorMessage'));
            return redirect('/');
        }
    }
    /**
     * Thuat toan dung de phat sinh chuoi rut gon cho URL.
     * - Lay ID lon nhat + 1 ( ID cho record moi ke tiep )
     * - Chuyen ID nay thanh chuoi
     * - map() | transform() chuoi ID nay thanh chuoi
     */
    protected function shorteningUrl(){
        $s = URL::max('id')+1; // lay ID cao nhat hien tai va tang len 1
        // chuyen S thanh collection de su dung ham transform() cua laravel
        $s = collect(str_split(strval($s)));

        $s->transform(function($item,$key){
            $transformCharacterCollection = [
                '0' => 'a',
                '1' => 'x',
                '2' => 't',
                '3' => 'g',
                '4' => 'j',
                '5' => 'G',
                '6' => 'i',
                '7' => 'L',
                '8' => 'X',
                '9' => 'B'
            ];

            return $transformCharacterCollection[$item];
        });
        
        $s = $s->all(); // chuyen S2 tu collection tro lai thanh array
        
        return implode($s);
    } 
    /**
     * Chua nghi ra thuat toan de su dung tat ca 58 ky tu de xay dung chuoi rut gon
     */
    protected function shorteningUrlV2(){
        /*
        $arr_letters = ['', // dem ky tu nay de cac ky tu phia sau bat dau o vi tri 1
            '0','1','2','3','4','5','6','7','8','0',
            'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
            'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'
        ]; // 58 ky tu dung de tao chuoi ngau nhien
        */
        $nLeters = 58; // tong so ky tu bao gom 10 so va 48 chu hoa va thuong
        $id = URL::max('id')+1; // lay ID cao nhat hien tai va tang len 1
        
        /**
         *  tim so ky tu cua chuoi shorten dua vao gia tri cua id
         *  neu chuoi 1 ky tu se co 58 truong hop
         *  neu chuoi 2 ky tu se co 58 * 58 truong hop
         *  neu chuoi 3 ky tu se co 58 * 58 * 58 truong hop
         *  neu chuoi n ky tu se co 58^n truong hop 
         */
        $n=0;
        do{
            $n++;
        }while($id>pow($nLeters,$n));
        // tao chuoi s la random voi so ky tu la $n
        
        $s = Str::random($n);
        // kiem tra xem chuoi shorten co ton tai hay chua
        $shortStr = new Url();
        while($shortStr->where('shortened',$s)->exists()){ // neu chuoi nay chua co trong DB
            $s = Str::random($n); // tao lai chuoi khac va tiep tuc kiem tra
        }
        // neu ra khoi vong while nghia la chuoi $s chua co trong DB. Co the dung tao chuoi moi duoc
        return $s;
    }
    /**
     * kiem tra so luong branded string cua user con hay khong
     */
    protected function getNumberOfBrandedString($user_id){
        $user = new User();
        $user = $user->where('id',$user_id)->first();
        return $user->branded;
    }
    /**
     * lay role cua user
     */
    protected function getRoleOfUser($user_id){
        
        $user = new User();
        $user = $user->where('id',$user_id)->first();
        return $user->role;
    }

    protected function checkDuplicateCustomString($s){
        $url = Url::where([
            ['shortened',$s],
            ['expired_at','>=',now()]
        ])->first();
        
        if(isset($url))
            return true;
        
        return false;
    }
}
