@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('asset.update', $asset->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                    <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" autocomplete="off" value="{{ old('image') ?? $asset->image }}">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                    <label for="asset">Asset</label>
                    <input type="text" class="form-control @error('asset') is-invalid @enderror" name="asset" id="asset" autocomplete="off" value="{{ old('asset') ?? $asset->asset }}">
                    @error('asset')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                    <label for="idkategori">Kategori</label>
                    <select class="form-control @error('idkategori') is-invalid @enderror" id="idkategori" name="idkategori" aria-label="Default select example">
                        @foreach ($kategoris as $kategori)
                            <option @selected($kategori->id==$asset->idkategori) value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                        @endforeach
                    </select>
                @error('idkategori')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>

                    <div class="form-group">
                    <label for="merk">Merk</label>
                    <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" id="merk" autocomplete="off" value="{{ old('merk') ?? $asset->merk }}">
                    @error('merk')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                    <label for="tahunbeli">Tahun Beli</label>
                    <input type="number" class="form-control @error('tahunbeli') is-invalid @enderror" name="tahunbeli" id="tahunbeli" placeholder="Tahun Beli" autocomplete="off" value="{{ old('tahunbeli') ?? $asset->tahunbeli }}">
                    @error('tahunbeli')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" autocomplete="off" value="{{ old('harga') ?? $asset->harga }}">
                    @error('harga')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                    <label for="umurekonomis">Umur Ekonomis</label>
                    <input type="text" class="form-control @error('umurekonomis') is-invalid @enderror" name="umurekonomis" id="umurekonomis" placeholder="Umur Ekonomis" autocomplete="off" value="{{ old('umurekonomis') ?? $asset->umurekonomis }}">
                    @error('umurekonomis')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                    <label for="nilairesidu">Nilai Residu</label>
                    <input type="text" class="form-control @error('nilairesidu') is-invalid @enderror" name="nilairesidu" id="nilairesidu" placeholder="Nilai Residu" autocomplete="off" value="{{ old('nilairesidu') ?? $asset->nilairesidu }}">
                    @error('nilairesidu')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                    <label for="spek">Spesifikasi</label>
                    <input type="text" class="form-control @error('spek') is-invalid @enderror" name="spek" id="spek" autocomplete="off" value="{{ old('spek') ?? $asset->spek }}">
                    @error('spek')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                    <label for="map">Map</label>
                    <div id="map" style="height: 300px; "></div>
                </div>
    
                <script>

                    var map = L.map('map').setView([ {{ $asset->latitude }}, {{ $asset->longtitude }} ], 100);

                    var marker = L.marker([{{ $asset->latitude }}, {{ $asset->longtitude }}]).addTo(map);
                    
                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: 'Lokasi Asset'
                    }).addTo(map);
            
                    map.on('click', function (e){
            
                        let latitude = e.latlng.lat.toString().substring(0,15);
                        let longtitude = e.latlng.lng.toString().substring(0,15);
            
                        document.querySelector("#latitude").value  = latitude;
                        document.querySelector("#longtitude").value  = longtitude;
            
                        var popup = L.popup()
                                .setLatLng(e.latlng)
                                .setContent("Anda mengklik " + e.latlng.toString())
                                .openOn(map);
                    })
            
                </script>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" placeholder="Latitude" autocomplete="off" value="{{ old('latitude') ?? $asset->latitude }}">
                        @error('latitude')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="longtitude">Longtitude</label>
                            <input type="text" class="form-control @error('longtitude') is-invalid @enderror" name="longtitude" id="longtitude" placeholder="Longtitude" autocomplete="off" value="{{ old('longtitude') ?? $asset->longtitude }}">
                        @error('longtitude')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button class="btn btn-default">
                        <a href="{{ route('asset.index') }}" class="btn btn-default">Kembali ke list</a>
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
