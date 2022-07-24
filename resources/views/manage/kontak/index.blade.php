@extends('layouts.be.app')

@push('title')
    <title>Dasibana - Kontak</title>
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endpush

@section('content')
    <?php
        use App\Models\Profil;
    ?>
    <div class="row gap-20 pos-r">
        <div class="masonry-item col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                @if(session('status'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="text-success">
                        <span class="icon-holder">
                            <i class="c-green-500 ti-check-box"></i>
                        </span>
                        Success
                    </h3>
                    {{ session('status') }}
                </div>
                @endif
                <div class="grid_layouts --two-auto">
                    <div class="head-lst">
                        <h3 class="page-title text-uppercase">Data Kontak</h3>
                    </div>
                    <?php
                        $profil    =   Profil::selectRaw('*')->get();
                    ?>
                    @if(count($profil) < 1)
                    <div class="mn-rght">
                        <button class="addbsnt --pluses">
                            <a href="{{ route('kontak.add')}}">
                                <i class="ti-plus"></i>
                            </a>
                        </button>
                    </div>
                    @endif
                </div>

                <table id="KontakTable" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="20px">No</th>
                            <th width="150px">Nama Bisnis</th>
                            <th width="150px">Pemilik</th>
                            <th>Deskripsi</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal View -->
    <div class="modal fade" role="dialog" id="modalViewKontak">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center">Data Kontak - <span id="namekontak"></span></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Nama Bisnis</label>
                        </div>
                        <div class="col-md-9">
                            <p class="form-control-static">:  <span id="nama_bisnis"></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Pemilik</label>
                        </div>
                        <div class="col-md-9">
                            <p class="form-control-static">:  <span id="pemilik"></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Tahun</label>
                        </div>
                        <div class="col-md-9">
                            <p class="form-control-static">:  <span id="tahun"></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Alamat</label>
                        </div>
                        <div class="col-md-9">
                            <p class="form-control-static">:  <span id="alamat"></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Deskripsi</label>
                        </div>
                        <div class="col-md-9">
                            <p class="form-control-static">:  <span id="deskripsi"></span></p>
                        </div>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal View -->
@endsection


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
        var KontakTable = $('#KontakTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 50,
                language: {
                    search: '<i class="fas fa-search" aria-hidden="true"></i>',
                    searchPlaceholder: 'Cari Data Perusahaan'
                },
                ajax: {
                    url: "{{ route('kontak.getdata') }}",
                    dataType: "json",
                    type: "POST",
                    data: { _token: "{{ csrf_token() }}" }
                },
                columns: [
                    { data: "no" },
                    { data: "nama_bisnis"},
                    { data: "pemilik"},
                    { data: "deskripsi" },
                    { data: "action",
                        orderable : false,
                        className : "text-center",
                    },
                ],
                rowCallback: function (row, data, index) {
                    /*
                    * function ini digunakan untuk memanipulasi data 1 row, sebelum menjadi row pada table di html
                    * contoh: mengubah nomor menjadi bold
                    */
                    $('td:eq(0)', row).html('<b>'+data.no+'</b>');
                }
            });
        });

        function openKontak(kontak_id) {
            $.ajax({
                type: 'GET',
                url : '{{ route("kontak.view") }}',
                data: {
                    id     : kontak_id,
                    _token : "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function (data) {
                    if (data.success) {
                        var html = '';
                        $('#modalViewKontak #nama_bisnis').html(data.nama_bisnis);
                        $('#modalViewKontak #pemilik').html(data.pemilik);
                        $('#modalViewKontak #tahun').html(data.tahun);
                        $('#modalViewKontak #alamat').html(data.alamat);
                        $('#modalViewKontak #deskripsi').html(data.deskripsi);
                        $('#modalViewKontak').modal();
                    }
                },
                error: function (data) {
                    console.log('data kontak');
                    console.log(data);
                }
            });
        }
    </script>
@endpush
