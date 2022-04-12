@extends('layouts.be.be')

@section('content')
<div id='mainContent'>
    <div class="container-fluid">
        <div class="grid_layouts --two-auto">
            <div class="head-lst">
                <h5 class="page-title">
                    Report Laba Rugi
                </h5>
            </div>
            <div class="mn-rght">
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)">Home</a></li>
                    <li class="active">
                        <a href="{{ route('be.report.laba_rugi') }}">
                            Report Laba Rugi
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row gap-20 pos-r">
        <div class="masonry-item col-md-12">
            <div class="bgc-white p-20 bd">
                <div class="row form-vegan">
                    <div class="col-md-4">
                        <label>Start Date</label>
                        <input type="text" data-provide="datepicker" class="form-control" name="first_date" id="first_date" placeholder="Date Start" id="first_date">
                    </div>
                    <div class="col-md-4">
                        <label>End Date</label>
                        <input type="text" data-provide="datepicker" class="form-control" name="last_date" id="last_date" placeholder="Date End" id="last_date">
                    </div>
                    <div class="col-md-4">
                        <button type="button" style="margin-top: 30px !important;" id="filter" onclick="location.reload();" class="btn btn-success">Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gap-20 pos-r">
        <div class="masonry-item col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <div class="grid_layouts --two-auto">
                </div>
                <h2 class="text-center">LABA / RUGI</h2>
                <table id="DataTable" class="table table-striped table-bordered" cellspacing="0" width="auto">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Pembelian</th>
                            <th>Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr>
                            <td><b>Penjualan</b></td>
                            <td></td>
                            <td id="penjualan" class="text-right"></td>
                        </tr>
                        <tr>
                            <td><b>Harga Pokok Penjualan</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>- Persediaan Awal</b></td>
                            <td></td>
                            <td id="persediaan_awal" class="text-right"></td>
                        </tr>
                        <tr>
                            <td><b>- Pembelian</b></td>
                            <td></td>
                            <td id="pembelian" class="text-right"></td>
                        </tr>
                         <tr>
                            <td></td>
                            <td></td>
                            <td id="total_pers_awal" class="text-right"></td>
                        </tr>
                        <tr>
                            <td><b>- Persediaan Akhir</b></td>
                            <td></td>
                            <td id="persediaan_akhir" class="text-right"></td>
                        </tr>
                        <tr>
                            <td><b>- HPP</b></td>
                            <td></td>
                            <td id="hpp" class="text-right"></td>
                        </tr>
                        <tr>
                            <td><b>Laba Kotor</b></td>
                            <td></td>
                            <td id="laba_kotor" class="text-right"></td>
                        </tr>
                        <tr>
                            <td><b> - Total Biaya / Beban</b></td>
                            <td></td>
                            <td id="biaya" class="text-right"></td>
                        </tr>
                        <tr>
                            <td><b>Laba Bersih</b></td>
                            <td></td>
                            <td id="laba_bersih" class="text-right"></td>
                        </tr>
                    </tbody>
                  
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(function(){
        getLabaRugi();
    });

    function getLabaRugi(){
        $.ajax({
                type: 'POST',
                data: {
                    token     : "{{ csrf_token() }}",
                    api_token : "{{ auth()->user()->api_token }}",
                    first_date: $('#first_date').val(),
                    last_date : $('#last_date').val()
                },
                dataType: "json",
                url: '{{ $api_url."report/laba_rugi" }}',
                success: function(data){
                 $('#penjualan').text('Rp '+data.data.penjualan);
                 $('#pembelian').text('Rp '+data.data.pembelian);
                 $('#persediaan_awal').text('Rp '+data.data.persediaan_awal);
                 $('#persediaan_akhir').text('Rp '+data.data.persediaan_akhir);
                 var total_pers_awal = parseInt(data.data.pembelian) + parseInt(data.data.persediaan_awal);
                 var hpp = parseInt(data.data.persediaan_awal) + (parseInt(data.data.pembelian)) -parseInt(data.data.persediaan_akhir);
                 var laba_kotor  = parseInt(data.data.penjualan) - hpp;
                 var biaya       = parseInt(data.data.biaya);
                 var laba_bersih = parseInt(laba_kotor) - parseInt(biaya); 
                 $('#total_pers_awal').text('Rp '+total_pers_awal);
                 $('#hpp').text('Rp '+hpp);
                 $('#laba_kotor').text('Rp '+laba_kotor);
                 $('#laba_bersih').text('Rp '+laba_bersih);
                 $('#biaya').text('Rp '+biaya);
                },
                error: function(data){
                    console.log(data);
                }
            });
    }
</script>
@endpush