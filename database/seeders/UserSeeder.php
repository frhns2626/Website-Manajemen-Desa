<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => '1',
            'name' => 'Admin Desa',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => '1',
        ]);

        User::create([
            'id' => '2',
            'name' => 'Penduduk 1',
            'email' => 'penduduk1@gmail.com',
            'password' => '123',
            'status' => 'approved',
            'role_id' => '2',
        ]);

        Penduduk::create([
            'user_id' => '2',
            'nik' => '1234567891234567',
            'kk' => '1234567890123456',
            'name'  => 'Bayu',
            'jenis_kelamin' => 'Laki-Laki',
            'tempat_lahir' => 'Demak',
            'tanggal_lahir' => '2004-01-08',
            'alamat' => 'Demak',
            'status_perkawinan' => 'kawin',
        ]);
    }
}
