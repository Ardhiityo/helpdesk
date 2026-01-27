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
                <td class="px-4"><img src="{{ asset('assets/unival.jpg') }}" alt="unival" width="100px"></td>
                <td class="text-center">
                    <section class="font-bold text-center">
                        <h1>Kementerian Pendidikan Tinggi, Sains dan Teknologi</h1>
                        <h1>Universitas Al-Khairiyah</h1>
                        <h1>{{ $record->faculty }}</h1>
                    </section>
                    <section class="text-[16px]">
                        <p>Alamat : Jl.K.H.Enggus Arja No.1 Citangkil Kota Cilegon, Banten 42441</p>
                        <p>No. telepon: (0254) 7877057 Website: unival-cilegon.ac.id</p>
                    </section>
                </td>
            </tr>
        </thead>
    </table>

    <div style="border-bottom: 2px double black;"></div>

    <br>
    <br>
    <h3 class="font-bold text-center">TENTANG <br> SURAT PERMOHONAN PERBAIKAN DATA SIAKAD </h3>
    <main>
        <br>
        <br>
        <p class="text-right">Cilegon, {{ $record->created_at->format('d F Y') }}</p>
        <br>
        <p>Yang Terhormat,</p>
        <p>Rektor Universitas Al-Khairiyah</p>
        <p>Cq. Bagian Administrasi Akademik</p>
        <p>Universitas Al-Khairiyah</p>
        <p>Di Cilegon</p>
        <br>
        <p>
            <i>Assalamualaikum Warahmatullahi Wabarakatuh</i> <br>
            Saya yang bertanda tangan dibawah ini:
        </p>
        <br>
        <table>
            <tr>
                <td class="px-4">Nama</td>
                <td class="px-4">: {{ $record->name }}</td>
            </tr>
            <tr>
                <td class="px-4">NPM</td>
                <td class="px-4">: {{ $record->nim }}</td>
            </tr>
            <tr>
                <td class="px-4">Program Studi</td>
                <td class="px-4">: {{ $record->study_program }}</td>
            </tr>
        </table>
        <br>
        <p>Mengajukan permohonan perbaikan data nama di laman
            <a href="https://unival.siakadcloud.com/gate/login">Helpdesk Universitas Al-Khairiyah</a> sebagai
            berikut:
        </p>
        <br>
        <table class="text-center">
            <thead>
                <tr>
                    <td class="px-2 border border-black">No</td>
                    <td class="px-4 border border-black">Tipe</td>
                    <td class="px-4 border border-black">Kesalahan</td>
                    <td class="px-4 border border-black">Perbaikan</td>
                </tr>
            </thead>
            @foreach ($record->fieldTypes as $fieldType)
                <tbody>
                    <tr>
                        <td class="px-2 border border-black">{{ $loop->iteration }}.</td>
                        <td class="px-2 border border-black">{{ $fieldType->name }}</td>
                        <td class="px-4 border border-black">{{ $fieldType->pivot->old_value }}</td>
                        <td class="px-4 border border-black">{{ $fieldType->pivot->new_value }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>
        <br>
        <p>Demikian permohonan ini disampaikan, atas perhatiannya diucapkan terimakasih.</p>
        <p><i>Wasalamualaikum Warahmatullahi Wabarakatuh</i></p>
        <br>
        <p>Pemohon,</p>
        <br>
        <br>
        <br>
        <p>{{ $record->name }}</p>
    </main>
</body>

</html>