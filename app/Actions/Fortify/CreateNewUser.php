<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
            'name' => ['required', 'string', 'max:255', 'unique:users', 'regex:/(^([a-zA-Z_]+)(\d+)?$)/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ],[
            'terms.required' => 'Kullanım Şartlarını kabul etmeden şurdan şuraya salmam.',
            'name.regex' => 'Kullanıcı Adında Türkçe harf, özel karakter (boşluk, nokta vs.) kullanamazsın. Yalnızca alt tire (_).'
        ], [
            'name' => 'Kullanıcı adı',
            'email' => 'E-Posta',
            'password' => 'Şifre',
            'terms' => 'Koşullar ve Şartlar',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
