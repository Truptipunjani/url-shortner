<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;

class MemberController extends Controller
{
    
 public function createMemberForm()
    {
        return view('member.create');
    }


    public function storeMember(Request $request)
    {
        $authUser = auth()->user();


        // ========================
        // SUPERADMIN LOGIC
        // =========================
        if($authUser->role == 'SuperAdmin')
        {
            // Create new company
            $company = Company::create([
                'name' => $request->company_name
            ]);

            // Create Admin for that company
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('123456'),
                'role' => 'Admin',
                'company_id' => $company->id
            ]);
        }
        // MY ADMIN TEST LOGIC
        // elseif($authUser->role == 'Admin')
        // {
        //     User::create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => Hash::make('123456'),
        //         'role' => $request->role, // Admin or Member
        //         'company_id' => $authUser->company_id
        //     ]);
        // }
        elseif($authUser->role == 'Admin')
        {

            if(!$authUser->company_id)
            {
                return redirect('/dashboard')
                ->with('error','Admin has no company');
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('123456'),
                'role' => $request->role, // Admin and Member
                'company_id' => $authUser->company_id
            ]);
        }

        // =========================
        // MEMBER BLOCKED
        // =========================
        else
        {
            return redirect('/dashboard');
        }

        return redirect('/dashboard');
    }
    
}
