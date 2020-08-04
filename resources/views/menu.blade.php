@extends('layout.master')

@section('content')
    <div class="container">

        <ul class="list-group">
            <a href="{{url('addFormMenu')}}"><button class="btn btn-primary float-right">Add Menu</button></a><br>
            @foreach($data as $tmp)
            <li class="list-group-item">{{$tmp['nama']}}<br>
                <small>Modal : <b>{{number_format($tmp['modal'])}}</b></small><br>
                <small>Jual : <b>{{number_format($tmp['jual'])}}</b></small><br>
                <small>Terjual : <b>{{$tmp['terjual']}}</b></small>
            </li>
            @endforeach
        </ul>
    </div>
@endsection
