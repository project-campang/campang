<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'nick_name' => 'admin'
            ,'password' => Hash::make('admin')
            ,'name' => '관리자'
            ,'tel' => '01021317878'
            ,'email' => 'lsl9787@naver.com'
        ];
        User::create($data);
    }
}