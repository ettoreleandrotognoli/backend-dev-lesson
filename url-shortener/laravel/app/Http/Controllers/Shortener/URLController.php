<?php

namespace App\Http\Controllers\Shortener;
use App\ShortUrl;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class URLController extends BaseController{

    public function home(){
        return view('home');
    }

    public function show($code){
        $shortUrl = ShortUrl::where('code','=',$code)->firstOrFail();
        return view('shorted',[
            'url'=>$shortUrl->url,
            'shortUrl'=>$shortUrl,
            'baseUrl' => config('app.url'),
        ]);
    }

    public function shorten(Request $request){
        $validator = Validator::make($request->all(),[
            'url' => 'required'
        ]);
        $validator->validate();
        $url = $request->input('url');
        $shortUrl = ShortUrl::shorten($url);
        return redirect('/preview/'.$shortUrl->code);
    }

    public function redirect($code){
        $shortUrl = ShortUrl::where('code','=',$code)->firstOrFail();
        return redirect($shortUrl->getUrl());
    }

}