@extends('layouts.app',['title'=>'Pelanggaran']) @section('content')
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-6">
                    <h2>Data <b> Pelanggaran</b></h2>
                </div>
                <div class="col-6">
                    <button href="#addpelanggaranModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPelanggaran">Add New Data</button>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <div class="row">
                <div class="col-md-2">
                    <span>Rows :</span>
                    <select class="custom-select form-select" onchange="changePaginationLength(this.value)">
                        <option value="10" {{ $pelanggarans->perPage() == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $pelanggarans->perPage() == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $pelanggarans->perPage() == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $pelanggarans->perPage() == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <span>Filter by Kelas:</span>
                    <select class="form-select" id="filter-kelas" name="filter-kelas">
                        <option value="" {{ request()->input('filter-kelas') == '' ? 'selected' : '' }}>All Kelas </option>
                        {{-- @foreach ($ams as $am)
                        <option value="{{ $am }}" {{ request()->input('filter-am') == $am ? 'selected' : '' }}> {{ $am }} </option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="col-md-2 pb-2 pt-2"></div>

                <div class="col-md-5 form-inline">
                    <label>Search: </label>
                    <input type="text" class="form-control mr-sm-2" id="search" name="search" oninput="liveSearch()" placeholder="Search by Name or NIS" />
                </div>
            </div>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Foto</th>
                    <th>NIS</th>
                    <th>Siswa</th>
                    <th>Kelas</th>
                    <th>ID Pelanggaran</th>
                    <th>Tanggal Pelanggaran</th>
                    <th>Isi Pelanggaran</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @php $no=1; @endphp @foreach ($pelanggarans as $pelanggaran)
                <tr>
                    <td>{{$no++}}</td>
                    <td>foto</td>
                    <td>{{ $pelanggaran->nis }}</td>
                    <td>{{ $pelanggaran->siswa->nama }}</td>
                    <td>{{ $pelanggaran->siswa->kelas }}</td>
                    <td>{{$pelanggaran->id_pelanggaran}}</td>
                    <td>{{$pelanggaran->tgl_pelanggaran}}</td>
                    <td>{{$pelanggaran->isi_pelanggaran}}</td>

                    <td>
                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#ubahPelanggaran-{{$pelanggaran->id}}">
                            <i class="fa-regular fa-pen-to-square" title="Edit" data-bs-toggle="tooltip"></i>
                        </a>
                        <a href="#" class="delete" data-bs-toggle="modal" data-bs-target="#hapusPelanggaran-{{$pelanggaran->id}}">
                            <i class="fa-regular fa-trash-can" title="Delete" data-bs-toggle="tooltip"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="hint-text">Showing <b>{{ $pelanggarans->firstItem() }}</b> to <b>{{ $pelanggarans->lastItem() }}</b> of <b>{{ $pelanggarans->total() }}</b> entries</div>
            <ul class="pagination">
                @if ($pelanggarans->currentPage() > 1)
                <li class="page-item">
                    <a href="{{ $pelanggarans->previousPageUrl() }}" class="page-link">Previous</a>
                </li>
                @endif @for ($i = 1; $i <= $pelanggarans->lastPage(); $i++)
                <li class="page-item{{ $pelanggarans->currentPage() == $i ? ' active' : '' }}">
                    <a href="{{ $pelanggarans->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
                @endfor @if ($pelanggarans->currentPage() < $pelanggarans->lastPage())
                <li class="page-item">
                    <a href="{{ $pelanggarans->nextPageUrl() }}" class="page-link">Next</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>

{{-- Add Modal --}}
<x-modal id="tambahPelanggaran" idTitle="tambahPelanggaranTitle" title="Add Pelanggaran" formAction="/siswa/store" method="POST" classHeader="bg-success text-white">
    <div class="mb-3">
        <label class="form-label">NIS</label>
        <input type="number" pattern="^[0-9]+$" min="1" max="99999" class="form-control" name="nis" placeholder="masukkan nis siswa" />
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" class="form-control" name="nama" placeholder="masukkan nama siswa" />
    </div>
    <div class="mb-3">
        <label class="form-label">Kelas</label>
        <select name="kelas" class="form-select">
            <option>Pilih KElas</option>
            <option value="XII-Abydos">XII-Abydos</option>
            <option value="XII-Millenium">XII-Millenium</option>
        </select>
    </div>
</x-modal>
@endsection