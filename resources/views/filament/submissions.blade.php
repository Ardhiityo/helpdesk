<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submissions - {{ $record->code }}</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td style="padding-right: 10px; display: flex; align-items: center;">
                    <img src="{{ asset('assets/unival.jpg') }}" alt="unival" width="100px">
                </td>
                <td style="text-align: center">
                    <p style="font-weight: bold; font-size: 20px;">Kementerian Pendidikan Tinggi, Sains dan Teknologi
                        <br>
                        Universitas Al-Khairiyah <br>
                        {{ $record->faculty }}
                    </p>
                    <p style="font-weight: normal; font-size: 15px;">
                        Alamat : Jl.K.H.Enggus Arja No.1 Citangkil Kota Cilegon, Banten 42441 <br>
                        No. telepon: (0254) 7877057 Website: unival-cilegon.ac.id</h1>
                    </p>
                </td>
            </tr>
        </thead>
    </table>

    <div style="border-bottom: 2px double black;"></div>

    <br>

    <main style="font-size: 15px">
        <h3 style="font-weight: bold; text-align: center;">Surat Permohonan Perbaikan Data SIAKAD</h3>
        <br>

        <p style="text-align: right">Cilegon,
            {{ $record->created_at->locale('id')->translatedFormat('d F Y') }}</p>
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
            <a href="https://unival.siakadcloud.com/gate/login">https://helpdesk.unival-cilegon.ac.id/</a> sebagai
            berikut:
        </p>

        <table style="text-align: center; border-collapse: collapse;">
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
                        <td style="border: 1px solid black; padding: 0px 10px 0 10px;">{{ $loop->iteration }}.</td>
                        <td style="border: 1px solid black; padding: 0px 10px 0 10px;">{{ $fieldType->name }}</td>
                        <td style="border: 1px solid black; padding: 0px 10px 0 10px;">
                            {{ $fieldType->pivot->old_value }}</td>
                        <td style="border: 1px solid black; padding: 0px 10px 0 10px;">
                            {{ $fieldType->pivot->new_value }}</td>
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
