@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->

    <div class="d-flex justify-content-between">
        <h1 class="h3 mb-3 text-gray-800">Info Asset</h1>
        <a href="{{ route('asset.show', $penyusutan->id) }}" class="btn btn-default mb-3"><i class="fas fa-fw fa-arrow-left"></i> Detail</a>
    </div>

    <table class="table table-bordered table-stripped ">
        <thead>
            <tr>
                <th>No</th>
                <th>Asset</th>
                <th>Harga Beli</th>
                <th>Umur Ekonomis</th>
                <th>Nilai Residu</th>
            </tr>
        </thead>
        <tbody>

                @php
                    $no= 1;
                @endphp

                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $penyusutan->asset }}</td>
                    <td>Rp. {{number_format($penyusutan->harga) }}</td>
                    <td>{{ $penyusutan->umurekonomis  }} Tahun</td>
                    <td>Rp. {{number_format($penyusutan->nilairesidu) }}</td>
                </tr>

        </tbody>
    </table>
    <br><br>

    <!-- Main Content goes here -->

    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>
    
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped ">
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Penyusutan / Tahun</th>
                <th>Penyusutan Akumulasi</th>
                <th>Harga Akhir</th>
            </tr>
        </thead>
        <tbody>

            @for ($year = 1; $year <= $penyusutan->umurekonomis; $year++)
                @php
                    $totalpenyusutan = ($penyusutan->harga-$penyusutan->nilairesidu) / $penyusutan->umurekonomis;
                    $penyusutanakumulasi = ($totalpenyusutan * $year);
                    $hargaakhirsetelahpenyusutan = ($penyusutan->harga - $penyusutanakumulasi);

                    // echo "Tahun ke-$year:<br>";
                    // echo "Nilai penyusutan tahunan: Rp $penyusutantahunan<br>";
                    // echo "Penyusutan akumulasi: Rp $penyusutanakumulasi<br>";
                    // echo "Nilai aset setelah penyusutan: Rp $hargaakhirsetelahpenyusutan<br><br>";
                @endphp

                <tr>
                    <td>{{ $year }}</td>
                    <td>{{ $penyusutan->tahunbeli++ }}</td>
                    <td>Rp. {{number_format($totalpenyusutan) }}</td>
                    <td>Rp. {{number_format($penyusutanakumulasi) }}</td>
                    <td>Rp. {{number_format($hargaakhirsetelahpenyusutan) }}</td>
                </tr>
            @endfor

        </tbody>
    </table>

    {{-- {{ $penyusutan->links() }} --}}

    <!-- End of Main Content -->
    @endsection

    @push('notif')
    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @endpush
