@extends('layouts.supplier')

@section('content')
    <header class="page-header page-header-dark pb-10 overlay overlay-10" style="background-color: rgb(0, 70, 128)">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked me-3 text-white"></i></div>
                            DAFTAR PRODUK
                        </h1>
                        <div class="page-header-subtitle mt-3 text-white">Temukan beragam pilihan produk berkualitas tinggi dari supplier kami, serta nikmati penawaran khusus dan diskon eksklusif untuk
                            produk
                            tertentu.
                            Manfaatkan fitur pencarian kami untuk menemukan produk yang Anda cari dengan cepat, sambil mendapatkan informasi detail tentang setiap produk termasuk deskripsi, spesifikasi,
                            dan gambar.</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center py-2">
                <nav class="mt-1 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Produk</li>
                        <li class="breadcrumb-item active">Daftar Produk</li>
                    </ol>
                </nav>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    + Tambah Produk
                </button>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-sm table-striped table-light">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Kategori Produk</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Harga Normal</th>
                            <th>Harga Member</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $data)
                            <tr>
                                <td>
                                    <div style="width: 150px; height: 100px; overflow: hidden;">
                                        <img src="{{ asset('images/' . $data->product_photo) }}" alt="{{ $data->product_name }}"
                                            style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                    </div>
                                </td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->product_name }}</td>
                                <td>{{ $data->product_quantity }}</td>
                                <td>Rp {{ number_format($data->product_normal_price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($data->product_member_price, 0, ',', '.') }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-success rounded-pill" data-bs-toggle="modal" data-bs-target="#viewModal{{ $data->product_id }}">Lihat</a>
                                    <a class="btn btn-sm btn-outline-orange rounded-pill" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->product_id }}">Edit</a>
                                    <a class="btn btn-sm btn-outline-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->product_id }}">Hapus</a>
                                </td>
                            </tr>

                            <!-- Modal Lihat -->
                            <div class="modal fade" id="viewModal{{ $data->product_id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Lihat Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ asset('images/' . $data->product_photo) }}" alt="{{ $data->product_name }}" width="200" class="mb-3">
                                            </div>
                                            <p><strong>Nama Produk :</strong> {{ $data->product_name }}</p>
                                            <p><strong>Deskripsi :</strong> {{ $data->product_description }}</p>
                                            <p><strong>Kategori :</strong> {{ $data->name }}</p>
                                            <p><strong>Stok :</strong> {{ $data->product_quantity }}</p>
                                            <p><strong>Harga Normal :</strong> Rp {{ number_format($data->product_normal_price, 0, ',', '.') }}</p>
                                            <p><strong>Harga Member :</strong> Rp {{ number_format($data->product_member_price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $data->product_id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('supplier.product.update', $data->product_id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Ubah Produk</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="product_photo" class="form-label">Ganti Foto Produk</label>
                                                    <input type="file" class="form-control" id="product_photo" name="product_photo">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="product_name" class="form-label">Nama Produk</label>
                                                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $data->product_name }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="product_description" class="form-label">Keterangan</label>
                                                    <textarea type="text" class="form-control" id="product_description" name="product_description" rows="3">{{ $data->product_description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="product_category_id" class="form-label">Kategori</label>
                                                    <select class="form-control" id="product_category_id" name="product_category_id" style="height: auto;">
                                                        @foreach ($categories as $kategori)
                                                            <option class="form-control" value="{{ $kategori->id }}" {{ $data->product_category_id == $kategori->id ? 'selected' : '' }}>
                                                                {{ $kategori->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-3">
                                                        <label for="product_quantity" class="form-label">Stok</label>
                                                        <input type="text" class="form-control" id="product_quantity" name="product_quantity" value="{{ $data->product_quantity }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="product_normal_price" class="form-label">Harga Normal</label>
                                                        <input type="number" class="form-control" id="product_normal_price" name="product_normal_price" value="{{ $data->product_normal_price }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="product_member_price" class="form-label">Harga Member</label>
                                                        <input type="number" class="form-control" id="product_member_price" name="product_member_price" value="{{ $data->product_member_price }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Hapus-->
                            <div class="modal fade" id="deleteModal{{ $data->product_id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus produk ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('supplier.product.destroy', $data->product_id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('supplier.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="product_photo" class="form-label">Ganti Foto Produk</label>
                            <input type="file" class="form-control" id="product_photo" name="product_photo">
                        </div>
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="product_name" name="product_name">
                        </div>
                        <div class="mb-3">
                            <label for="product_description" class="form-label">Keterangan</label>
                            <textarea type="text" class="form-control" id="product_description" name="product_description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="product_category_id" class="form-label">Kategori</label>
                            <select class="form-control" id="product_category_id" name="product_category_id" style="height: auto;">
                                @foreach ($categories as $kategori)
                                    <option class="form-control" value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-3">
                                <label for="product_quantity" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="product_quantity" name="product_quantity">
                            </div>
                            <div class="col">
                                <label for="product_normal_price" class="form-label">Harga Normal</label>
                                <input type="number" class="form-control" id="product_normal_price" name="product_normal_price">
                            </div>
                            <div class="col">
                                <label for="product_member_price" class="form-label">Harga Member</label>
                                <input type="number" class="form-control" id="product_product_member_price" name="product_member_price">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
