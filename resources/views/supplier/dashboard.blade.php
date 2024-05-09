@extends('layouts.supplier')

@section('content')
    <div class="container-xl px-4 mt-5">
        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
            <div class="me-4 mb-3 mb-sm-0">
                <h1 class="mb-0">Dashboard</h1>
                <div class="small">
                    <span class="fw-500 text-primary">{{ date('l') }}</span>
                    &middot;
                    {{ date('F d, Y') }}
                    &middot;
                    {{ date('h:i A') }}
                </div>
            </div>
        </div>
        <!-- Illustration dashboard card example-->
        <div class="card card-waves mb-4 mt-5">
            <div class="card-body p-5">
                <div class="row align-items-center justify-content-between">
                    <div class="col">
                        <h2 class="text-primary">Selamat datang kembali <b>{{ auth()->user()->name }}</b> !</h2>
                        <p class="text-gray-700">Dapatkan pengalaman terbaik dengan MITRA.ID! Dashboard Supplier Anda telah disiapkan dengan fitur-fitur hebat. Mulai dari manajemen produk, pelacakan
                            stok, dan pesanan penjualan, hingga riwayat penjualan, ulasan dan penilaian produk, manajemen member, dan fitur chat yang mudah digunakan.</p>
                        <a class="btn btn-primary p-3" href="{{ route('supplier.index') }}">
                            Get Started
                            <i class="ms-1" data-feather="arrow-right"></i>
                        </a>
                    </div>
                    <div class="col d-none d-lg-block mt-xxl-n4"><img class="img-fluid px-xl-4 mt-xxl-n5" src="{{ asset('images/statistics.svg') }}" /></div>
                </div>
            </div>
        </div>
    </div>
@endsection
