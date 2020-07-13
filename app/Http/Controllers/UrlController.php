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
        //$this->setLocale();

        $url = new Url();
        $url = $url->where('url',$req->input('originalUrl'))->first();

        if(isset($url)){
            $resultUrl = $url->shortened;
        }else{
            $resultUrl = $this->shorteningUrl();
            // save vao db
            try{
                $url = new Url([
                    'url'=> $req->input('originalUrl'),
                    'shortened' => $resultUrl
                ]);
                $url->save();
            }catch(\Exception $e){
                Log::debug($e->getMessage());
                $req->session()->flash('sessionNotification',__('messages.textErrorDb'));
            }
        }
        
        return view('url')->with('resultUrls',['result'=>$resultUrl,'original'=>$req->input('originalUrl')]);
    }

    public function run($short){
        
        // update vao db
        try{
            $url = new Url();
            $url = $url->where('shortened',$short)->first();
            $url->count = $url->count + 1;
            $url->save();
            return redirect()->away($url->url);
        }catch(\Exception $e){
            Log::debug('UrlController::run('.$short.') : '.$e->getMessage());
            session()->flash('sessionNotification','
            Sorry! Your short URL does not exist. You need to check it or create new one with this app.
             | 
            Rất tiếc địa chỉ rút gọn của bạn cung cấp không tồn tại. Bạn nên kiểm tra lại với người cung cấp hoặc tạo cái mới với ứng dụng này.
            ');
            return redirect('/');
        }
    }
    /**
     * Thuat toan dung de phat sinh chuoi rut gon cho URL.
     * - Phat sinh chuoi 3 ky tu ngau nhien ( goi la S1 )
     * - Lay ID lon nhat + 1 ( ID cho record moi ke tiep )
     * - Chuyen ID nay thanh chuoi
     * - map() | transform() chuoi ID nay thanh chuoi khac ( goi la S2 )
     * - Tao ket qua la S = S1 + S2
     */
    protected function shorteningUrl(){
        $s1 = str_split(Str::random(3));
        $s2 = URL::max('id')+1; // lay ID cao nhat hien tai va tang len 1
        // chuyen S2 thanh collection de su dung ham transform() cua laravel
        $s2 = collect(str_split(strval($s2)));
        $s2->transform(function($item,$key){
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
        $s2 = $s2->all(); // chuyen S2 tu collection tro lai thanh array
        
        return implode(array_merge($s1,$s2));
    } 
    /**
     */
    protected function shorteningUrlV2(string $longUrl){
        $arr_letters = ['', // dem ky tu nay de cac ky tu phia sau bat dau o vi tri 1
            '0','1','2','3','4','5','6','7','8','0',
            'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
            'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'
        ]; // 58 ky tu dung de tao chuoi ngau nhien
        $nLeters = 58; // tong so ky tu bao gom 10 so va 48 chu hoa va thuong 
    }

}
