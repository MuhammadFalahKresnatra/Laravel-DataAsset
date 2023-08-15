@extends('layouts.admin')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

<!-- Main Content goes here -->
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <button class="btn btn-sm btn-default">
                            <a href="{{ route('asset.index') }}" class="btn btn-default"><i class="fas fa-fw fa-arrow-left"></i>  Kembali</a>
                        </button>
                        <div class="row">
                            <div class="col-12">
                                <img src="{{ asset('storage/assets/'.$asset->image) }}" class="w-100 rounded">
                            </div>
                        </div>
                        <hr><br>
                        <div class="row">
                            <div class="col">
                                Nama Asset : <h4>{{ $asset->asset }}</h4>
                                <br>
                                Merk : <h4>{{ $asset->merk }}</h4>
                                <br>
                                Kategori : <h4>{{ $asset->kategori }}</h4>
                                <br>
                                Spesifikasi : <h4>{{ $asset->spek }}</h4>
                            </div>
                            <div class="col">
                                Tahun Beli : <h4>{{ $asset->tahunbeli }}</h4>
                                <br>
                                Harga : <h4>Rp. {{number_format($asset->harga) }}</h4>
                                <br>
                                Umur Ekonomis : <h4>{{ $asset->umurekonomis }} Tahun</h4>
                                <br>
                                Nilai Residu : <h4>Rp. {{ number_format($asset->nilairesidu) }}</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h4 class="text-center">Laporan Asset : {{ $asset->asset }}</h4>
                                <div class="text-center">
                                    <a href="{{ route('asset.perbaikan', $asset->id) }}" class="btn btn-md btn-warning mr-2">Perbaikan</a>    
                                    <a href="{{ route('asset.penyusutan', $asset->id) }}" class="btn btn-md btn-danger">Penyusutan</a>    
                                    <a href="{{ route('asset.lokasi', $asset->id) }}" class="btn btn-md btn-success ml-2">Lokasi</a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#exampleModal">
                                        QR Code
                                    </button>
                                    <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">QR Code</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="visible-print text-center">
                                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate(Request::url())) !!} ">
                                                    </div>
                                                    <br>
                                                    <h5 class="text-center">{{ $asset->asset }}</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-primary" href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate(Request::url())) !!} " download>Download</a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    <!-- End Modal -->
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- End of Main Content -->
@endsection