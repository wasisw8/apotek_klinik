@extends('template.app')

@section('content')
<div class="container-fluid">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">{{$title}}</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item ">{{$title}}</li>
                </ol>
            </div>
        </div>

        <!-- Responsive Datatable -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="text-end">
                            <button id="tambah" class="btn btn-success btn-sm">
                                Tambah
                            </button>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <table id="obatDatatable" class="table table-bordered table-bordered dt-responsive nowrap" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">no</th>
                                    <th width="20%">Nama</th>
                                    <th width="10%">Sediaan</th>
                                    <th width="20%">Jenis</th>
                                    <th width="20%">Kategori</th>
                                    <th width="20%">Distributor</th>
                                    <th width="5%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
    @include('master.obat.modal.index')
@endsection
@section('js')
    @include('master.obat.js.index')
@endsection
