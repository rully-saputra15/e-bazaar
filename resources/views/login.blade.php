@extends('layout.auth')

@section('content')
<img style="width:128px;height:128px;" class="rounded mx-auto d-block"src="{{URL::asset('img/logo.jpeg')}}">
<form method="post" action="{{url('/auth')}}">
    @csrf
    <div class="box-body">
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" class="form-control" placeholder="email">
        <label for="">Password</label>
        <input type="password"name="password" class="form-control" placeholder="password">
    </div>
    @if(is_null($message))
    @else
    <span style="color:red">{{$message}}</span><br>
    @endif
    <button type="submit" class="btn btn-primary">Login</button>
</div>
</form>
@endsection
