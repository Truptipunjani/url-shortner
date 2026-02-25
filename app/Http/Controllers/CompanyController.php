<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function createCompanyForm(){
        return view('company.create');
    }

    public function storeCompany(Request $request){

    $company=Company::create([
    'name'=>$request->company_name
    ]);

    User::create([
        'name' => $request->admin_name,
        'email' => $request->admin_email,
        'password'=>Hash::make($request->password),
        'role' => 'Admin',
        'company_id' => $company->id
    ]);

    return redirect('/dashboard');
}
}
