<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submissions - {{ $record->code }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <table>
        <thead>
            <tr>
                <td style="padding-right: 20px; display: flex; align-items: center;">
                    <img src="{{ asset('assets/unival.jpg') }}" alt="unival" width="100px">
                </td>
                <td class="text-center">
                    <section class="text-center" style="font-weight: bold; font-size: 14pt;">
                        <h1>Kementerian Pendidikan Tinggi, Sains dan Teknologi</h1>
                        <h1>Universitas Al-Khairiyah</h1>
                        <h1>{{ $record->faculty }}</h1>
                    </section>
                    <section style="font-weight: normal; font-size: 12pt;">
                        <p>Alamat : Jl.K.H.Enggus Arja No.1 Citangkil Kota Cilegon, Banten 42441</p>
                        <p>No. telepon: (0254) 7877057 Website: unival-cilegon.ac.id</p>
                    </section>
                </td>
            </tr>
        </thead>
    </table>

    <div style="border-bottom: 2px double black;"></div>

    <br>

    <main style="font-size: 12pt">
        <h3 class="text-center" style="font-weight: bold">SURAT PERMOHONAN PERBAIKAN DATA SIAKAD </h3>
        <br>

        <p class="text-right">Cilegon, {{ $record->created_at->locale('id')->translatedFormat('d F Y') }}</p>
        <p>Yang Terhormat, <br>
            Rektor Universitas Al-Khairiyah <br>
            Cq. Bagian Administrasi Akademik <br>
            Universitas Al-Khairiyah <br>
            Di Cilegon
        </p>
        <p>
            <i>Assalamualaikum Warahmatullahi Wabarakatuh</i> <br>
            Saya yang bertanda tangan dibawah ini:
        </p>
        <table>
            <tr>
                <td>Nama</td>
                <td>: {{ $record->name }}</td>
            </tr>
            <tr>
                <td>NPM</td>
                <td>: {{ $record->nim }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>: {{ $record->study_program }}</td>
            </tr>
        </table>

        <p>Mengajukan permohonan perbaikan data nama di laman
            <a href="https://unival.siakadcloud.com/gate/login">Helpdesk Universitas Al-Khairiyah</a> sebagai
            berikut:
        </p>

        <table class="text-center">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 0 10px 0 10px;">No</th>
                    <th style="border: 1px solid black; padding: 0 10px 0 10px;">Tipe</th>
                    <th style="border: 1px solid black; padding: 0 10px 0 10px;">Kesalahan</th>
                    <th style="border: 1px solid black; padding: 0 10px 0 10px;">Perbaikan</th>
                </tr>
            </thead>
            @foreach ($record->fieldTypes as $fieldType)
                <tbody>
                    <tr>
                        <td style="border: 1px solid black">{{ $loop->iteration }}.</td>
                        <td style="border: 1px solid black">{{ $fieldType->name }}</td>
                        <td style="border: 1px solid black">{{ $fieldType->pivot->old_value }}</td>
                        <td style="border: 1px solid black">{{ $fieldType->pivot->new_value }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>

        <p>Demikian permohonan ini disampaikan, atas perhatiannya diucapkan terimakasih. <br>
            <i>Wasalamualaikum Warahmatullahi Wabarakatuh</i>
        </p>
        <br>
        <p>Pemohon</p>
        <br>
        <br>
        <br>
        <p>{{ $record->name }}</p>
    </main>
</body>

</html>
