@extends('layout.master')

@section('content')
    <div class="container">
    <form method="post" action="{{url('/pushKategori')}}">
        @csrf
        <div class="form-group">
            <label for="">Bulan</label>
            <input type="text" class="form-control" value="{{$id}}"name="id" readonly><br>
            <label for="">Nama</label>
            <input type="text" class="form-control" name="nama_bazaar" placeholder="Nama jualan ex: Bazaar Online 24 Juni"><br>
            <label for="">Buka Jualan</label>
            <input type="date" class="form-control" name="buka"><br>
            <label for="">Tutup Jualan</label>
            <input type="date" class="form-control" name="tutup">
        </div>
        <br>
            <button typpe="submit" class="btn btn-primary float-right">Submit</button>
        </div>
    </form>
    </div>
    <script src="{{URL::asset('js/addkategori.js')}}"></script>
@endsection
