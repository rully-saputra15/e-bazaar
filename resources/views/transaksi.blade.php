@extends('layout.master')

@section('content')
    <div class="container">

        <ul class="list-group">
            <div class="row">
                <div class="col">
                    <a href="{{url('/addFormModal/'.$nama)}}"><button class="btn btn-primary float-right">Add Modal</button></a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                          <h5 class="card-title">Penghasilan Kotor : {{number_format($total)}}
                        </h5>
                            <a href="{{url('/detailDataTransaksi/'.$nama)}}"><button class="btn btn-primary float-right">See Details</button></a>
                        </div>
                      </div>
                </div>
            </div>
            <a href="{{url('/addFormTransaksi/'.$nama)}}"><button class="btn btn-primary float-right">Add Pesanan</button></a><br>
            @foreach($data as $tmp)
            <a style="color:black;text-decoration:none;" href="{{url('/showDetailTransaksi/'.$tmp->id())}}">

            @if($tmp['status'] == 0)
                <li class="list-group-item"><b>{{$tmp['nama']}}</b><br>
            @else
                <li class="list-group-item list-group-item-success"><b>{{$tmp['nama']}}</b><br>
            @endif
                @foreach($tmp['pesanan'] as $nil)
                    <small><b>{{$nil['data'][0]}}</b>: {{$nil['data'][1]}} x Rp {{ number_format($nil['data'][2])}} = Rp {{ number_format($nil['data'][1] * $nil['data'][2])}}</small>
                    <br>
                @endforeach
            <small>Ongkir : <b>{{number_format($tmp['ongkir'])}}</b></small><br>
            <small>Total : <b>{{number_format($tmp['total'])}}</b></small><br>
            <small>Transport : <b>{{$tmp['transport']}}</b></small><br>
            <small>Alamat : <b>{{$tmp['alamat']}}</b></small><br>
            @if(is_null($tmp['catatan']))
            @else
            <small>Catatan : <b>{{$tmp['catatan']}}</b></small>
            @endif
            <a href="{{url('/updateStatusTransaksi/' . $tmp->id())}}"><small class="float-right">
                <button class="btn btn-primary">Selesai</button>
                </small>
            </a>
            </li>
        </a>
            @endforeach
        </ul>
    </div>
@endsection
