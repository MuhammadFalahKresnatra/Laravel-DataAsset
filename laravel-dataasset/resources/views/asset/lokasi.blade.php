@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between">
        <h1 class="h3 mb-3 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>
        <a href="{{ route('asset.show', $lokasi->id) }}" class="btn btn-default mb-3"><i class="fas fa-fw fa-arrow-left"></i> Detail</a>
    </div>
    

    <!-- Main Content goes here -->

    <div id="map" style="height: 420px;"></div>
    
    <script>
        var map = L.map('map').setView([{{ $lokasi->latitude }}, {{ $lokasi->longtitude }}], 100);

        var marker = L.marker([{{ $lokasi->latitude }}, {{ $lokasi->longtitude }}]).addTo(map);

        marker.bindPopup(`{{ $lokasi->asset }}`).openPopup();

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: `Lokasi {{ $lokasi->asset }}`
        }).addTo(map);
    </script>
    


    {{-- @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif --}}

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
