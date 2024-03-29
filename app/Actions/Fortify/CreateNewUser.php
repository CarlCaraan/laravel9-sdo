<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Generete Tracking Id
        $check_user_exist = User::orderBy('id', 'DESC')->first();
        if ($check_user_exist == NULL) {
            $first_register = 0;
            $user_id = $first_register + 1;
            if ($user_id < 10) {
                $tracking_id = '0000' . $user_id;
            } elseif ($user_id < 100) {
                $tracking_id = '000' . $user_id;
            } elseif ($user_id < 1000) {
                $tracking_id = '00' . $user_id;
            } elseif ($user_id < 10000) {
                $tracking_id = '0' . $user_id;
            } else {
                $tracking_id = $user_id;
            }
        } else {
            $exist_user = User::orderBy('id', 'DESC')->first()->id;
            $user_id = $exist_user + 1;
            if ($user_id < 10) {
                $tracking_id = '0000' . $user_id;
            } elseif ($user_id < 100) {
                $tracking_id = '000' . $user_id;
            } elseif ($user_id < 1000) {
                $tracking_id = '00' . $user_id;
            } elseif ($user_id < 10000) {
                $tracking_id = '0' . $user_id;
            } else {
                $tracking_id = $user_id;
            }
        }

        return User::create([
            'first_name' => ucfirst($input['first_name']),
            'last_name' => ucfirst($input['last_name']),
            'gender' => $input['gender'],
            'email' => $input['email'],
            'user_type' => "User",
            'identifier' => "local",
            'tracking_id' => date('Y') . "-" . $tracking_id,
            'password' => Hash::make($input['password']),
        ]);
    }
}
