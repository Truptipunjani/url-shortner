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
        $data=ShortUrl::with('user.company')->get();
    }
    elseif($user->role=='Admin'){
        $data=ShortUrl::with('user')
            ->where('company_id',$user->company_id)
            ->get();
    }
    else{
        $data=ShortUrl::with('user')
        ->where('user_id',$user->id)
        ->get();
    }
        return view('dashboard',compact('data'));
    }
    // public function store(Request $request){
    // if(auth()->user()->role=='SuperAdmin'){
    //     return back();
    // }
    // ShortUrl::create([
    //     'company_id'=>auth()->user()->company_id,
    //     'user_id'=>auth()->id(),
    //     'original_url'=>$request->original_url,
    //     'short_code'=>Str::random(6)
    // ]);
    //     return back();
    // }

public function store(Request $request)
{
    $user = auth()->user();

    if($user->role == 'SuperAdmin')
    {
        return redirect('/dashboard')
        ->with('error','SuperAdmin cannot create Short URL');
    }
    if(!$user->company_id)
    {
        return redirect('/dashboard')
        ->with('error','No Company Assigned');
    }
    $request->validate([
        'original_url' => 'required|url'
    ]);
    ShortUrl::create([
        'company_id' => $user->company_id,
        'user_id' => $user->id,
        'original_url' => $request->original_url,
        'short_code' => Str::random(6)
    ]);

    return redirect('/dashboard')
    ->with('success','Short URL Created Successfully');
}    
}
