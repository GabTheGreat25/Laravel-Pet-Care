<nav class="navbar navbar-default" style="height: 7rem; padding-top: 1rem; font-size: 2rem; background-color:#d4e6be;">
    <div
        style="display: grid; grid-template-columns: .1fr 1fr auto; padding: 0 2rem; justify-items: center; align-items:center;">

        <div class="navbar-header" style="display: grid; justify-self: start;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ url('/') }}">
                <img src="/navbar/navbar-logo.png" alt="pet care" style="width: 11rem;">
            </a>
        </div>

        <div>
            <ul class="nav navbar-nav">
                <li style="padding: 0 1rem;">
                    <a href="{{ url('/shop') }}">
                        <i class="fa fa-shopping-basket" style="padding: 0 .5rem 0 0;" aria-hidden="true"></i> Shop
                    </a>
                </li>
                {{-- <li style="padding: 0 1rem;">
                    <a href="{{ route('transaction.shoppingCart') }}">
                        <i class="fa fa-paw" aria-hidden="true"></i> Pet Transaction
                        <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalPrice : '' }}</span>
                    </a>
                    </a>
                </li> --}}
            </ul>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> User <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" style="font-size: 1.75rem;">
                        @if (Auth::check())
                        <li style="padding-left: 2rem; white-space: nowrap; overflow: hidden;
                            text-overflow: ellipsis;">
                            <p> Welcome, {{ Auth::user()->userName }}</p>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('user.logout') }}">Logout</a></li>
                        @else
                        <li><a href="{{ route('user.signup') }}">Signup</a></li>
                        <li><a href="{{ route('user.signin') }}">Signin</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div> <!-- /.navbar-collapse -->
    </div> <!-- /.container-fluid -->
</nav>