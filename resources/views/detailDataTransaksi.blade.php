@extends('layout.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                      <h5 class="card-title">Penghasilan Kotor : {{number_format($total)}}
                    </h5>
                        <p class="card-text">Jumlah Pesanan : </p>
                        @for($i=0;$i<count($pesanan);$i++)
                        <p class="card-text">{{$pesanan[$i][0]}} : {{$jumlah[$i][0]}} x {{$bersih[$i]}} = {{number_format($jumlah[$i][0]*$bersih[$i])}}</p>
                        @endfor
                        <p class="card-text"><b>Modal Tambahan</b></p>
                        @for($i=0;$i<count($namaModal);$i++)
                            <p class="card-text">{{$namaModal[$i]}} : <b>{{$hargaModal[$i]}}</b></p>
                        @endfor
                        <p class="card-text">Penghasilan bersih : <b>{{number_format($totalBersih)}}</b></p>
                        <a href="{{url('/showTransaksi/'.$nama)}}"><button class="btn btn-warning float-right">Back</button></a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection
