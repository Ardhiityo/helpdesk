<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentType::create([
            'name' => 'Kartu Tanda Penduduk',
        ]);

        DocumentType::create([
            'name' => 'Kartu Keluarga',
        ]);

        DocumentType::create([
            'name' => 'Akte Kelahiran',
        ]);

        DocumentType::create([
            'name' => 'Kartu Tanda Mahasiswa',
        ]);

        DocumentType::create([
            'name' => 'Ijazah Terakhir',
        ]);
    }
}
