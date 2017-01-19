<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model{

    protected $fillable = ['url'];

    public $rules = [
        'url' => 'required'
    ];

    public function shorten($url){
        $shortUrl = $this->firstOrNew(['url'=>$url]);
        if($shortUrl->id){
            return $shortUrl;
        }
        $shortUrl->makeCode();
        $shortUrl->save();
        return $shortUrl;
    }

    public function makeCode(){
        $nextId = $this->with('id')->max('id') + 1;
        $this->code = base_convert($nextId,10,36);
    }

    public function getUrl(){
        if(strpos($this->url,'://')!==false){
            return $this->url;    
        }
        return 'http://'.$this->url;
    }

}
