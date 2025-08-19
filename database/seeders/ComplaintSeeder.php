<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Complaint::create([
            'penduduk_id' => 1,
            'title' => 'Sampah Menumpuk',
            'content' => 'Sampah Di RT 03 / RW 01 belum di ambil dan mengakibatkan penumpukan dan bau menyengat'
        ]);
    }
}
