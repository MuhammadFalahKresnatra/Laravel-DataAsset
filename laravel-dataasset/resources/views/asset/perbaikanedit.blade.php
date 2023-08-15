@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('asset.perbaikanupdate', $perbaikan->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

            <div class="form-group" hidden>
                <label for="idasset">Id Asset</label>
                <input type="number" class="form-control @error('idasset') is-invalid @enderror" name="idasset" id="idasset" autocomplete="off" value="{{ old('idasset') ?? $perbaikan->idasset }}">
            @error('tgl')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>

            <div class="form-group">
                <label for="tgl">Tanggal</label>
                <input type="date" class="form-control @error('tgl') is-invalid @enderror" name="tgl" id="tgl" autocomplete="off" value="{{ old('tgl') ?? $perbaikan->tgl }}">
            @error('tgl')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>

            <div class="form-group">
                <label for="jenis">Jenis</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis" id="inlineRadio1" value="Perawatan" {{ $perbaikan->jenis == "Perawatan" ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio1">Perawatan</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis" id="inlineRadio2" value="Perbaikan" {{ $perbaikan->jenis == "Perbaikan" ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio2">Perbaikan</label>
                </div>
                {{-- @error('jenis')
                    <span class="text-danger">{{ $message }}</span>
                @enderror --}}
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" placeholder="Keterangan" autocomplete="off" value="">{{ old('keterangan') ?? $perbaikan->keterangan }}</textarea>
            @error('keterangan')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>

            <div class="form-group">
                <label for="vendor">Vendor</label>
                <input type="text" class="form-control @error('vendor') is-invalid @enderror" name="vendor" id="vendor" placeholder="Vendor" autocomplete="off" value="{{ old('vendor') ?? $perbaikan->vendor }}">
            @error('vendor')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" placeholder="Harga" autocomplete="off" value="{{ old('harga') ?? $perbaikan->harga }}">
            @error('harga')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <button class="btn btn-default">
                    <a href="{{ route('asset.perbaikan', $perbaikan->idasset) }}" class="btn btn-default">Kembali ke list</a>
                </button>

            </form>
        </div>
    </div>

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

    @if (session('warning'))
        <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
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
