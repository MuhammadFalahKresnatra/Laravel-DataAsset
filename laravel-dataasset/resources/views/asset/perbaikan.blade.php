@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    

    <!-- Main Content goes here -->
    
    <div class="row">
        <div class="col-md-10">
            <a href="{{ route('asset.perbaikancreate', $idasset) }}" class="btn btn-primary mb-3">Tambah Perbaikan / Perawatan</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('asset.show', $idasset) }}" class="btn btn-default mb-3"><i class="fas fa-fw fa-arrow-left"></i>  Kembali ke Detail</a>
        </div>
    </div>
    

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped ">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Keterangan</th>
                <th>Vendor</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($perbaikans as $perbaikan)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $perbaikan->tgl }}</td>
                    <td>{{ $perbaikan->jenis }}</td>
                    <td>{{ $perbaikan->keterangan }}</td>
                    <td>{{ $perbaikan->vendor }}</td>
                    <td>Rp. {{number_format($perbaikan->harga) }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('asset.perbaikanedit', $perbaikan->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <form action="{{ route('asset.perbaikandestroy', $perbaikan->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <div class="alert alert-danger text-center">
                    Perbaikan & Perawatan Tidak Tersedia.
                </div>
            @endforelse 
        </tbody>
    </table>

    {{ $perbaikans->links() }}

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
