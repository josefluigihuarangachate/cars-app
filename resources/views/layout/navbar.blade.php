<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Cars - App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">Home </a>
            </li>
        </ul>
        <ul class="navbar-nav form-inline my-2 my-lg-0">
            @if (\Auth::check())
                @if (\Auth::user()->role == 'admin')
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('dashboard') }}">Dashboard </a>
                    </li>
                @endif
                <li class="nav-item active mr-sm-2">
                    <a class="nav-link" href="{{ url('logout') }}">Logout </a>
                </li>
            @else
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('login') }}">Login </a>
                </li>
                <li class="nav-item active mr-sm-2">
                    <a class="nav-link" href="{{ url('register') }}">Register</a>
                </li>
            @endif


        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <select class="custom-select mr-sm-2" id="inputGroupSelect01">
                <option selected>Choose...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>


        <div class="dropdown ml-sm-2 mr-sm-2">
            <button type="button" class="btn btn-info" data-toggle="dropdown">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span
                    class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
            </button>
            <div class="dropdown-menu">
                <div class="row total-header-section">
                    <div class="col-lg-6 col-sm-6 col-6">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span
                            class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                    </div>
                    @php $total = 0 @endphp
                    @foreach ((array) session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                    @endforeach
                    <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                        <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                    </div>
                </div>
                @if (session('cart'))
                    @foreach (session('cart') as $id => $details)
                        <div class="row cart-detail">
                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                <img src="{{ $details['image'] }}" />
                            </div>
                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                <p>{{ $details['name'] }}</p>
                                <span class="price text-info"> ${{ $details['price'] }}</span> <span
                                    class="count"> Quantity:{{ $details['quantity'] }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-lg-12 text-center checkout">
                        <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
