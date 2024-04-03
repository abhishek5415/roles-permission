<nav class="navbar navbar-expand-lg navbar-light bg-light shadow sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">                      {{-- ms-auto: pushed the menu at the end --}}
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/products')}}">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/customer')}}">Customers</a>
          </li>

          @guest
          <li class="nav-item">
            <a class="nav-link fw-bold" href="{{url('/login')}}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" href="{{url('/register')}}">Register</a>
          </li>

          @else
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{Auth::user()->name}}</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('profile.edit')}}">Profile</a></li>
                <li>
                    <form method="post" action="{{route('logout')}}">
                        @csrf
                        <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                    </form>
                </li>
              </ul>
          </div>
          @endguest
        </ul>
      </div>
    </div>
  </nav>