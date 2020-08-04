@extends('layout.master')

@section('content')
    <div class="container">
    <form method="post" action="{{url('/addTransaksi')}}">
        @csrf
        <div class="form-group">
            <label for="">Kategori</label>
            <input type="text" class="form-control" value="{{$kategori}}" name="kategori" readonly>
            <label for="">Nama Pembeli</label>
            <input type="text" class="form-control" name="nama" required>
            <label>Tanggal Pesanan</label>
            <input type="date" name="tanggal" class="form-control" required><br>
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" placeholder="Jangan kosong"value="Alamat" required><br>
            <label for="">Pesanan</label><br>
            <label class="btn btn-primary add_menu">Add Pesanan</label>
            <div class="wrapper mt-4">
            <div class="row">
                <div class="col">
                    <label for="">Menu</label>
                    <select class="custom-select" id="select_menu"name="pesanan[]">
                        @foreach($data as $val)
                            <option value="{{$val['nama']}}">{{$val['nama']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <input type="number" class="form-control" name="jumlah[]"placeholder="jumlah">
                </div>
            </div>
        </div>

        <label>Pilihan Transport</label>
        <select class="custom-select" name="transport">
            <option value="GOJEK SAME DAY">GOJEK SAME DAY</option>
            <option value="GOJEK INSTANT">GOJEK INSTANT</option>
            <option value="GRAB SAME DAY">GRAB SAME DAY</option>
            <option value="GRAB INSTANT">GRAB INSTANT</option>
            <option value="JNE">JNE</option>
            <option value="SICEPAT">SICEPAT</option>
            <option value="Others">Others</option>
        </select><br>
        <label>Harga Ongkir</label>
        <input type="number" name="ongkir" class="form-control" required><br>
        <label>Catatan</label>
        <input type="text" name="catatan" class="form-control"><br>

        <input type="submit" class="btn btn-primary float-right" value="Submit">
        </div>
    </form>
    </div>
<script src="{{URL::asset('js/addTransaksi.js')}}"></script>
@endsection
