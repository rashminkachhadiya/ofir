<header class="header">
        <nav class="navbar navbar-style">
            <div class="container">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#micon" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

                <div class="navbar-header">
                    @yield('nav_link')
                </div>

                <div class="collapse navbar-collapse" id="micon">
                <ul class="nav navbar-nav navbar-right">
                    <li><a style="color: black;" href="{{ URL::to('/cart') }}">Cart</a></li>
                </ul>
                </div>
            </div>
            
        </nav>      
    </header>