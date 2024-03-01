<?php

namespace Database\Seeders;

use App\Models\AdminLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        AdminLog::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['nama' => 'admin',
            'no_telp' => '0821222845',
            'email' => 'zptra16@gmail.com',
            'password' => bcrypt('rahasia'),
            'alamat' => 'Denpasar',],

            ['nama' => 'admin 2',
            'no_telp' => '0823334645',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'alamat' => 'Badung',],
        ];

        foreach ($data as $value){
            AdminLog::insert([
            'nama' => $value['nama'],
            'no_telp' => $value['no_telp'],
            'email' =>  $value['email'],
            'password' => $value['password'],
            'alamat' => $value['alamat'],
        ]);
        }
    }
}
