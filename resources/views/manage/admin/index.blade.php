@extends('layouts.be.app')

@push('title')
    <title>Dasibana - Admin</title>
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
    <div class="row gap-20 pos-r">
        <div class="masonry-item col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <div class="grid_layouts --two-auto">
                    <div class="head-lst">
                        <h3 class="page-title text-uppercase">data Admin</h3>
                    </div>
                    <div class="mn-rght">
                        <button class="addbsnt --pluses">
                            <a href="http://127.0.0.2/vim-fe/public/manage/supplier/tambah">
                                <i class="ti-plus"></i>
                            </a>
                        </button>
                    </div>
                </div>

                <table id="adminTable" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="5">No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th width="30px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal View -->
    <div class="modal fade" role="dialog" id="modalViewAdmin">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Admin</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <p class="form-control-static" id="nameadmin"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Username</label>
                                <p class="form-control-static" id="usernameadmin"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <p class="form-control-static" id="emailadmin"></p>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal View -->
@endsection


@push('scripts')
    <script type="text/javascript">
        var table;

        $(document).ready(function(){
            table= $('#adminTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 50,
                ajax: {
                    url: "{{ route('admin.getdata') }}",
                    dataType: "json",
                    type: "POST",
                    data: { _token: "{{ csrf_token() }}" }
                },
                columns: [
                    { data: "no" },
                    { data: "name"},
                    { data: "username"},
                    { data: "email" },
                    { data : "action",
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

        function openAdmin(admin_id) {
            $.ajax({
                type: 'GET',
                url : '{{ route("admin.view") }}',
                data: {
                    id     : admin_id,
                    _token : "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function (data) {
                    if (data.success) {
                        var html = '';
                        $('#modalViewAdmin #nameadmin').html(data.name);
                        $('#modalViewAdmin #usernameadmin').html(data.username);
                        $('#modalViewAdmin #emailadmin').html(data.email);
                        $('#modalViewAdmin').modal();
                    }
                },
                error: function (data) {
                    console.log('data admin');
                    console.log(data);
                }
            });
        }

        function deleteAdmin(id) {
            Swal.fire({
                type : "warning",
                title: "Ups!",
                text : "Anda yakin ingin menghapus data ini?",
                showCancelButton  : true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText : "Yes",
                cancelButtonText  : "No",
            }).then((result) => {
                if (result.value) {
                    document.getElementById(id).submit();
                }
            });
        }
    </script>
@endpush
