<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Employee;
use App\Models\Member;
use App\Models\Sub_District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // method: POST
    // Request: Member|Employee Data
    // Response: Redirect to Home|Employee Dashboard
    public function register(CreateUserRequest $request)
    {
        dd($request);
    }

    // method: POST
    // Request: Role, Email|Username, Password
    // Response: Token
    public function login(Request $request)
    {
        $error = [];
        $user = $request->role !== 'member' ?
            Employee::where($request->email_or_username_selected, $request->email_or_username_result)->first() :
            Member::where($request->email_or_username_selected, $request->email_or_username_result)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($request->role !== 'member')
                    Employee::where(
                        $request->email_or_username_selected,
                        $request->email_or_username_result
                    )->update(['status' => 1]);
                else
                    Member::where(
                        $request->email_or_username_selected,
                        $request->email_or_username_result
                    )->update(['status' => 1]);

                $token = $user->createToken(Str::random(10))->accessToken;

                if ($request->role === 'employee')
                    return response()->json(['token' => $token, 'post' => $user->role]);

                return response()->json(['token' => $token]);
            } else
                $error = [
                    'invalid password',
                    'รหัสผ่านไม่ถูกต้อง'
                ];
        } else
            $error = [
                'invalid ' . $request->email_or_username_selected,
                $request->email_or_username_selected !== 'email' ? 'ชื่อผู้ใช้ไม่ถูกต้อง' : 'อีเมลไม่ถูกต้อง'
            ];

        return response()->json(['message' => $error], 400);
    }

    // method: GET
    // Request: Token
    // Response: User Profile
    public function profile()
    {
        $user = auth()->user();
        $address = Employee::find($user->id);
        $adrs = [
            $address->address . ', ' .
                $address->sub_district->name_th . ', ' .
                $address->sub_district->district->name_th . ', ' .
                $address->sub_district->district->province->name_th . ', ' .
                $address->sub_district->post_code,
            $address->address . ', ' .
                $address->sub_district->name_en . ', ' .
                $address->sub_district->district->name_en . ', ' .
                $address->sub_district->district->province->name_en . ', ' .
                $address->sub_district->post_code
        ];

        $profile = [
            'Firstname' =>  $user->firstname,
            'Lastname' => $user->lastname,
            'Username'  => $user->username,
            'Email' => $user->email,
            'Phone' => $user->phone,
            'Role' => $this->emp_role[$user->role],
            'Gender' => $this->gender[$user->sex],
            'Address' => $adrs
        ];

        return response()->json(['profile' => $profile]);
    }

    // method: PUT
    // Request: Employee|Member Data, Token
    // Response: User Profile
    public function update(Request $request)
    {
    }

    // method: DELETE
    // Request: Token
    // Response: Redirect to Home|Employee Login
    public function logout()
    {
        DB::table(auth()->user()->getTable())->where('email', auth()->user()->email)->update([
            'status' => 0
        ]);
        auth()->user()->token()->revoke();
        return response()->json(['message' => 'logout success']);
    }
}
