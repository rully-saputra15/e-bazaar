@extends('layout.master')

@section('content')
    <div class="container">
    <form method="post" action="{{url('/addMenu')}}">
        @csrf
        <div class="form-group">
            <label for="">Nama Menu</label>
            <input type="text" class="form-control" name="nama_menu" placeholder="Nama jualan ex: kwetiaw Pak Asen"><br>
            <label for="">Harga Modal</label>
            <input id="modal"type="number" class="form-control" name="modal"><br>
            <label for="">Harga Jual</label>
            <input id="jual"type="number" class="form-control" name="jual">
        </div>
        <br>
        <p id="message" class="text-danger" style="display:none;">Harga modal lebih besar daripada jual</p>
            <button typpe="submit" class="btn btn-primary float-right">Submit</button>
        </div>
    </form>
    </div>
    <script src="{{URL::asset('js/addMenu.js')}}"></script>
@endsection
