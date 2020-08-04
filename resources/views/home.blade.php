@extends('layout.master')

@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow p-3 mb-5 bg-white rounded">
            <div class="card-body">
              <h5 class="card-title">Keseluruhan Penghasilan Kotor</h5>
                <p class="card-text">Jumlah : {{number_format($total)}}</p>
                <a href="{{url('/insight')}}" class="btn btn-primary">Full Insight Pendapatan</a>
            </div>
          </div>
    </div>
</div>
<br>
<div class="row">

<br>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="panel-heading">
            <b>Kategori</b><br>
        </div>
        <ul class="list-group mt-3 ">

            @foreach($kategori as $data)
            <a style="color:black;text-decoration:none;"href="{{url('/kategori/'.$data->id())}}">
            <li class="list-group-item">
                <div class="media">
                    <img style="width:48px;height:48px;"src="{{URL::asset('img/image.png')}}" class="mr-3" alt="...">
                    <div class="media-body">
                        <h6 class="mt-0">{{$data ->id()}}</h6>
                    </div>
                </div>
            </li>
            </a>
            @endforeach
        </ul>
    </div>
</div>
@endsection

