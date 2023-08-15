@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <style>
        .swal-text{
            text-align: center;
            color: #333333;
        }
        .swal-button--confirm{
            background-color:#4E73DF;
        }
    </style>

    <!-- Main Content goes here -->

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div id="reader" width="600px"></div>
                </div>
            </div>
        </div>
        <div class="col-2">

        </div>
    </div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        // console.log(`Code matched = ${decodedText}`, decodedResult);
        // $("#result").val(decodedText)
        swal({
            title: "INFO",
            text: "Anda akan dialihkan ke halaman " + decodedText,
            icon: "info",
            buttons: true,
            })
            .then((willHref) => {
            if (willHref) {
                window.location.href = decodedText;
            } else {
                swal("Scan Ulang QR Code");
            }
            });
        }

        function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 300, height: 250} },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>

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
