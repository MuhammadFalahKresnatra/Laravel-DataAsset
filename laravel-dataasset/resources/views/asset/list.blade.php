@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->
    <a href="{{ route('asset.create') }}" class="btn btn-primary mb-3">Tambah Asset</a>

    <div class="row">
        <div class="col-md-10">
            <form  action="{{ route('search') }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" name="q" class="form-control border-1 small hover:border-primary" placeholder="Cari Asset..." aria-label="Search" aria-describedby="basic-addon2" required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <form action="{{ route('asset.select') }}" method="get">
                <select class="form-control mb-3" name="idkategori" onchange="this.form.submit()">
                    <option value="" selected disabled>Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                    @endforeach
                </select>
            </form>
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
                <th>Asset</th>
                <th>Kategori</th>
                <th>Merk</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($assets as $asset)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $asset->asset }}</td>
                    <td>{{ $asset->kategori }}</td>
                    <td>{{ $asset->merk }}</td>
                    <td>Rp. {{number_format($asset->harga) }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('asset.show', $asset->id) }}" class="btn btn-sm btn-info mr-2">Detail</a>
                            <a href="{{ route('asset.edit', $asset->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <form action="{{ route('asset.destroy', $asset->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <div class="alert alert-danger text-center">
                    Asset Tidak Tersedia.
                </div>
            @endforelse 
        </tbody>
    </table>

    {{ $assets->links() }}

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
