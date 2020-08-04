
    <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand">
                <img src="{{URL::asset('img/logo.jpeg')}}" width="30" height="30" class="d-inline-block align-top" alt="">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item active">
                <a style="color:black;"class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a style="color:black;"class="nav-link" href="{{url('/showMenu')}}">Menu</a>
                </li>
                <li class="nav-item">
                    <a style="color:black;" class="nav-link" href="{{url('/login')}}">Login</a>
                </li>
            </ul>

        </nav>
