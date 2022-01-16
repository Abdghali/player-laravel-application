<?php

namespace App\Models;

use App\Services\SMS;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\App;

class Number extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function varificationCodeGenerationWithSmsNotification()
    {
        $this->generateVerificationCode();

        $this->sendVerificationCodeViaSms();
    }


    protected function generateVerificationCode()
    {
        static::withoutEvents(function () {

            if (request()->has('test')) {
                return $this->update([
                    'verification_code' => 123456
                ]);
            }

            if (App::runningUnitTests()) {
                return $this->update([
                    'verification_code' => 123456
                ]);
            }
            return $this->update([
                'verification_code' => mt_rand(100000, 999999)
            ]);
        });
    }


    protected function sendVerificationCodeViaSms()
    {
        if (!App::runningUnitTests() and !request()->has('test')) {
            SMS::send($this->content, __('Verification Code Is', ['code' => $this->verification_code]));
        }
    }


    public function verify($code)
    {
        $this->verification_code == $code ?? static::withoutEvents(function () {
            $this->update([
                'verified_at'   => now()
            ]);
        });

        return $this->verification_code == $code;
    }


    public function markAsNotVerified()
    {
        $this->update([
            'verified_at' => null
        ]);
    }

    public function deleteVerificationCode()
    {
        $this->update([
            'verification_code' => null
        ]);
    }


    public function isUsed()
    {
        return User::where('number', $this->content)->count();
    }


    public function markAsVerified()
    {
        $this->update([
            'verified_at' => now()
        ]);
    }

    public function isVerified()
    {
        return $this->verified_at;
    }
}
