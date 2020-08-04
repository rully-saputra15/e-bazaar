@extends('layout.master')

@section('content')
    <div class="container">
        <ul class="list-group">
            <a href="{{url('addFormKategori/'. $id)}}"><button class="btn btn-primary float-right">Add Bazaar</button></a><br>
            @foreach($data as $tmp)
            <a style="color:black;text-decoration:none;"href="{{url('/showTransaksi/'.$tmp['nama'])}}">
                <li class="list-group-item">{{$tmp['nama']}}<br>
                <small>Buka : <b>{{$tmp['buka']}}</b></small><br>
                <small>Tutup : <b>{{$tmp['tutup']}}</b></small><br>
            </li></a>
            @endforeach
        </ul>
    </div>
@endsection
