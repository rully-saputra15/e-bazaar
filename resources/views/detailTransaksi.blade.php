@extends('layout.master')

@section('content')
<div class="container">
    <form method="post" action="{{url('/updateTransaksi/' . $id)}}">
        @csrf
        <div class="form-group">

            <label>ID : {{$id}}</label><br>
            <label for="">Kategori</label>
            <input type="text" class="form-control" value="{{$data['kategori']}}" name="kategori" readonly>
            <label for="">Nama Pembeli</label>
            <input type="text" class="form-control" value="{{$data['nama']}}"name="nama" readonly>
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{$data['alamat']}}"><br>
            <label for="">Pesanan</label><br>
            @foreach($data['pesanan'] as $dat)
            <div class="row">
                <div class="col">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" name="pesanan[]"placeholder="nama" value="{{$dat['data'][0]}}" readonly>
                </div>
                <div class="col">
                    <label for="">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah[]"placeholder="jumlah" value="{{$dat['data'][1]}}">
                </div>
            </div>
            <br>
            @endforeach
        <label>Catatan</label>
        <input type="text" name="catatan" value="{{$data['catatan']}}"class="form-control"><br>
        <label>Harga Ongkir</label>
        <input type="number" name="ongkir" value="{{$data['ongkir']}}"class="form-control"><br>
        <input type="submit" class="btn btn-primary float-right" value="Update">
        </div>
    </form>
    </div>
@endsection
