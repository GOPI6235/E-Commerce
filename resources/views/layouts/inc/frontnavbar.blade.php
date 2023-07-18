<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">AddToCart</a>
        <form action="{{ url('searchproduct') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="search" name="product_name" class="form-control" id="search_product" placeholder="search products" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <button class="input-group-text" ><i class="fa fa-search"></i></button>
            </div>
        </form>



        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link active" aria-current="page">Home</a>
              </li>
              <li class="nav-item">
                <a href="{{ url('category') }}" class="nav-link">Category</a>
              </li>
              <li class="nav-item">
                <a href="{{ url('cart') }}" class="nav-link">Cart 
                    <span class="badge badge-pill bg-success badge-sm badge-top cart-count">0</span>
                </a>
              </li>

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbardropdown">
                            <li>
                                <a class="dropdown-item" href="{{ url('my-orders') }}">
                                    My Orders
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    My Profile
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
