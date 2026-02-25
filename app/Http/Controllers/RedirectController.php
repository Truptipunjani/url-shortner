<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;

class RedirectController extends Controller
{
    public function redirect($code){
    $url=ShortUrl::where('short_code',$code)->firstOrFail();
        return redirect($url->original_url);
    }
}
