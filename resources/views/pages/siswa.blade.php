@extends('layouts.app',['title'=>'Siswa']) @section('content') {{-- start table from aku_crud --}}
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-6">
                    <h2>Data <b> Siswa</b></h2>
                </div>
                <div class="col-6">
                    <button href="#addsiswaModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahSiswa">Add New Data</button>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <div class="row">
                <div class="col-md-2">
                    <span>Rows :</span>
                    <select class="custom-select form-select" onchange="changePaginationLength(this.value)">
                        <option value="10" {{ $siswas->perPage() == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $siswas->perPage() == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $siswas->perPage() == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $siswas->perPage() == 100 ? 'selected' : '' }}>100</option>
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
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @php $no=1; @endphp @foreach ($siswas as $siswa)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>
                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#ubahSiswa-{{$siswa->id}}">
                            <i class="fa-regular fa-pen-to-square" title="Edit" data-bs-toggle="tooltip"></i>
                        </a>
                        <a href="#" class="delete" data-bs-toggle="modal" data-bs-target="#hapusSiswa-{{$siswa->id}}">
                            <i class="fa-regular fa-trash-can" title="Delete" data-bs-toggle="tooltip"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="hint-text">Showing <b>{{ $siswas->firstItem() }}</b> to <b>{{ $siswas->lastItem() }}</b> of <b>{{ $siswas->total() }}</b> entries</div>
            <ul class="pagination">
                @if ($siswas->currentPage() > 1)
                <li class="page-item">
                    <a href="{{ $siswas->previousPageUrl() }}" class="page-link">Previous</a>
                </li>
                @endif @for ($i = 1; $i <= $siswas->lastPage(); $i++)
                <li class="page-item{{ $siswas->currentPage() == $i ? ' active' : '' }}">
                    <a href="{{ $siswas->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
                @endfor @if ($siswas->currentPage() < $siswas->lastPage())
                <li class="page-item">
                    <a href="{{ $siswas->nextPageUrl() }}" class="page-link">Next</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
{{-- emd table from aku_crud --}}

<!-- Modal tambah-->

<x-modal id="tambahSiswa" idTitle="tambahSiswaTitle" title="Add Siswa" formAction="/siswa/store" method="POST" classHeader="bg-success text-white">
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

@foreach ($siswas as $siswa) {{-- Modal Update --}}
<x-modal id="ubahSiswa-{{$siswa->id}}" idTitle="UbahSiswaTitle" title="Edit Siswa" formAction="/siswa/update/{{$siswa->id}}" method="post" classHeader="bg-warning">
    <div class="mb-3">
        <label for="" class="form-label">nis</label>
        <input type="number" pattern="^[0-9]+$" min="1" max="99999" class="form-control" name="nis" placeholder="masukkan nis siswa" value="{{$siswa->nis}}" />
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" id="" class="form-control" placeholder="masukkan nama siswa" value="{{$siswa->nama}}" />
    </div>
    <div class="mb-3">
        <label for="kelas" class="form-label">Kelas</label>
        <select name="kelas" class="form-select">
            <option>Pilih KElas</option>
            <option value="XII-Abydos">XII-Abydos</option>
            <option value="XII-Millenium">XII-Millenium</option>
        </select>
    </div>
</x-modal>

{{-- Modal hapus --}}

<x-modal id="hapusSiswa-{{$siswa->id}}" idTitle="hapusSiswaTitle" title="Delete Siswa" formAction="/siswa/delete/{{$siswa->id}}" method="DELETE" classHeader="bg-danger text-white">
    <h4 class="text-center">Apakah anda yakin untuk menghapus data <b class="text-danger">{{$siswa->nama}}</b> ?</h4>
</x-modal>
@endforeach 
@endsection
