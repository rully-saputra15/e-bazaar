@extends('layout.master')

@section('content')
<div class="container">
<form method="post" action="{{url('/pushFormModal')}}">
    @csrf
    <div class="form-group">
        <label for="">Bazaar</label>
        <input type="text" class="form-control" value="{{$nama}}" name="nama" readonly>
        <label for="">Modal</label><br>
            <label class="btn btn-primary add_modal">Add Modal</label>
            <div class="wrapper mt-4">
            <div class="row">
                <div class="col">
                    <label for="">Nama Modal</label>
                    <input type="text" class="form-control" name="modal[]">
                </div>
                <div class="col">
                    <label for="">Harga Modal</label>
                    <input type="text" class="form-control" name="harga[]">
                </div>
            </div>
        </div><br>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
</div>
</form>
<script src="{{URL::asset('js/addModal.js')}}"></script>
@endsection
