<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use App\Url;

class UrlController extends Controller
{
    public function __construct(){
        
    }

    public function index(){
        //dump(session()->all());
        return view('url');
    }
    
    public function store(Request $req){
        $url = new Url();
        // tim xem URL nay da co trong DB chua
        $url = $url->where([
            ['url',$req->input('originalUrl')],
            //['expired_at','<=',date('Y-m-d H:i:s')]
            ])->first();

        if(isset($url)){ // neu da co trong DB thi thong bao ra URL rut gon
            $resultUrl = $url->shortened;
        }else{
            $resultUrl = $this->shorteningUrlV2(); // neu chua co thi tien hanh tao URL rut gon
            // save vao db
            try{
                $url = new Url([
                    'url'=> $req->input('originalUrl'),
                    'shortened' => $resultUrl,
                    'user_id'=>auth()->check()?auth()->id:0
                ]);
                $url->save();
            }catch(\Exception $e){
                Log::debug($e->getMessage());
                $req->session()->flash('sessionNotification',__('messages.textErrorDb')); // khong luu duoc vao db
                return view('url');
            }
        }
        
        return view('url')->with('resultUrls',['result'=>$resultUrl,'original'=>$req->input('originalUrl')]);
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

}
