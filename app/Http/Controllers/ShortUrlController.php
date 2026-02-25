<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;


class ShortUrlController extends Controller
{
    public function index(){
    $user=auth()->user();
    if($user->role=='SuperAdmin'){
        $data=ShortUrl::all();
    }
    elseif($user->role=='Admin'){
        $data=ShortUrl::where('company_id',$user->company_id)->get();
    }
    else{
        $data=ShortUrl::where('user_id',$user->id)->get();
    }
        return view('dashboard',compact('data'));
    }
    public function store(Request $request){
    if(auth()->user()->role=='SuperAdmin'){
        return back();
    }
    ShortUrl::create([
        'company_id'=>auth()->user()->company_id,
        'user_id'=>auth()->id(),
        'original_url'=>$request->original_url,
        'short_code'=>Str::random(6)
    ]);
        return back();
    }
}
