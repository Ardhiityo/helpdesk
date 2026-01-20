<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Faq::insert(
            [
                [
                    'question' => 'How to change data for students who have graduated?',
                    'answer' =>
                    "<ol>
                        <li>Select the data you want to change.</li>
                        <li>Attach a PDF file with the following document types:
                            <ul>
                                <li>The relevant Identity Card (KTP)</li>
                                <li>The relevant Family Card (KK)</li>
                                <li>The relevant Birth Certificate (Akte Kelahiran)</li>
                                <li>Latest ijazah (Ijazah Terakhir)</li>
                            </ul>
                        </li>
                    </ol>"
                ],
                [
                    'question' => 'How to change data for students who have not graduated',
                    'answer' =>
                    "<ol>
                        <li>Select the data you want to change.</li>
                        <li>Attach a PDF file with the following document types:
                            <ul>
                                <li>The relevant Identity Card (KTP)</li>
                                <li>The relevant Family Card (KK)</li>
                                <li>The relevant Birth Certificate (Akta Kelahiran)</li>
                                <li>Student ID card/active student certificate (Kartu Tanda Mahasiswa/Surat Keterangan Mahasiswa Aktif)</li>
                            </ul>
                        </li>
                    </ol>"
                ]
            ]
        );
    }
}
