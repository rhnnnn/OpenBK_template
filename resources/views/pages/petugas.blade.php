@extends('layouts.app',['title'=>'Petugas'])
@section('content')
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-6">
                    <h2>Admin <b> Panel</b></h2>
                </div>
                <div class="col-6">
                    <a href="#" class="btn btn-success" data-bs-toggle="modal"data-bs-target="#addPetugasModal" id="addPetugasBtn">Add New Petugass</a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Petugasname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($petugass as $petugas)
                    <tr>
                        <td>{{$petugas->id}}</td>
                        <td>
                            @if ($petugas->photo)
                            <img src="{{$petugas->photo}}" alt="" width="75" height="75" style="border-radius: 5px">
                            @else
                            <img src="{{ asset('img/defpfp/OIP.jpeg') }}" alt="" width="75" height="75" style="border-radius: 5px">
                            @endif
                        </td>
                        <td>{{ $petugas->name }} </td>
                        <td>{{ $petugas->petugasname }}</td>
                        <td>{{ $petugas->email }}</td>
                        <td>{{ $petugas->phone }}</td>
                        <td>
                            @foreach ($petugas->roles as $usro)
                            {{ $usro->name}}
                            @if (!$loop->last)
                            ,
                            @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#editPetugasModal-{{ $petugas->id }}" data-petugas-id="{{ $petugas->id }}">
                                <i class="ri-pencil-line" data-bs-toggle="tooltip" title="Edit"></i>
                            </a>
                            <a href="#" class="delete" data-bs-toggle="modal" data-bs-target="#deletePetugasModal" data-petugas-id="{{ $petugas->id }}">
                                <i class="ri-delete-bin-line" data-bs-toggle="tooltip" title="Delete"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="hint-text">Showing <b>{{ $petugass->firstItem() }}</b> to <b>{{ $petugass->lastItem() }}</b> of
                <b>{{ $petugass->total() }}</b> entries</div>
            <ul class="pagination">
                @if ($petugass->currentPage() > 1)
                    <li class="page-item">
                        <a href="{{ $petugass->previousPageUrl() }}" class="page-link">Previous</a>
                    </li>
                @endif
                @for ($i = 1; $i <= $petugass->lastPage(); $i++)
                    <li class="page-item{{ $petugass->currentPage() == $i ? ' active' : '' }}">
                        <a href="{{ $petugass->url($i) }}" class="page-link">{{ $i }}</a>
                    </li>
                @endfor
                @if ($petugass->currentPage() < $petugass->lastPage())
                    <li class="page-item">
                        <a href="{{ $petugass->nextPageUrl() }}" class="page-link">Next</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endsection