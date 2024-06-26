<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Employee;
use App\Models\Member;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserController
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
            Employee::where($request->usernameOrEmail, $request->usernameOrEmailResult)->first() :
            Member::where($request->usernameOrEmail, $request->usernameOrEmailResult)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($request->role !== 'member')
                    Employee::where(
                        $request->usernameOrEmail,
                        $request->usernameOrEmailResult
                    )->update(['status' => 1]);
                else
                    Member::where(
                        $request->usernameOrEmail,
                        $request->usernameOrEmailResult
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

        $profile = [
            'profile' => [
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'username' => $user->username,
                'email' => $user->email,
                'phone' => $user->phone,
                'gender' => $user->sex
            ]
        ];

        if ($user->role !== null)
            $profile['profile']['role'] = $user->role;
        if ($user->sub_dist_id !== null)
            $profile['address'] = [
                'address'
            ];

        // $profile = [
        //     'profile' => [
        //         'firstname' =>  $user->firstname,
        //         'lastname' => $user->lastname,
        //         'username'  => $user->username,
        //         'email' => $user->email,
        //         'phone' => $user->phone,
        //         'role' => $user->role,
        //         'gender' => $user->sex
        //     ],
        //     'address' => [
        //         'address' => [$user->address],
        //         'region' => [
        //             $user->sub_district->district->province->region
        //         ],
        //         'province' => [
        //             $user->sub_district->district->province
        //         ],
        //         'district' => [
        //             $user->sub_district->district
        //         ],
        //         'sub_district' => [
        //             $user->sub_district
        //         ],
        //         'post_code' => [$user->sub_district->post_code]
        //     ]
        // ];

        return response()->json($profile);
    }

    // method: PUT
    // Request: Employee|Member Data, Token
    // Response: User Profile
    public function update(Request $request)
    {
    }

    // method: PUT
    // Request: Employee|Member Address Data, Token
    // Response: successful | failed
    public function updateAddress(Request $request)
    {
        Log::info($request);
    }

    // method: GET
    // Request: none
    // Response: Region, Province, District, Sub district data
    public function getAllAddress()
    {
        $address = Region::all();

        foreach ($address as $adr) {
            foreach ($adr->provinces as $province) {
                foreach ($province->districts as $district) {
                    foreach ($district->sub_districts as $sub_district) {
                        break;
                    }
                }
            }
        }

        return response()->json(['address' => $address]);
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
