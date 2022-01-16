<div class="header">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>

<script>
        $(function () {
            // guess user timezone 
            $('#tz').val(moment.tz.guess())
            console.log(moment.tz.guess())
            console.log("{{\Carbon\Carbon::now()->timezone("+moment.tz.guess()+")}}")
            $('#time-noww').text("{{\Carbon\Carbon::now()->timezone("+moment.tz.guess()+")}}")
        })
    </script>
<div class="header-left">
        <a href="{{ route('home') }}" class="logo">Yokhone App
            <!-- <img src="assets/img/logo.svg" alt="Logo"> -->
        </a>
        <a href="{{ route('home') }}" class="logo logo-small">PT
            <!-- <img src="assets/img/logo.svg" alt="Logo"> -->
        </a>
    </div>
    <a href="javascript:void(0);" id="toggle_btn"> <i class="fas fa-bars"></i>
    </a>

    <div class="top-nav-search">
        <img class="img-fluid logo-dark mb-2" src="{{ asset('logo/logo2.png') }}" alt="Logo">
    </div>
    <div class="top-nav-search ml-5">
        <h5 style="margin-top: 18px; position: relative; width:360px">
            {{ \Carbon\Carbon::now()->timezone(Auth::user()->timezone)->format('D, M j, Y \a\t g:ia') }}
        </h5>
    </div>

    <a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i>
    </a>



    <ul class="nav user-menu">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link notifications-item">
                <i class="feather-bell"></i> <span class="badge badge-pill">1</span>
            </a>
        </li>

        <li class="nav-item dropdown has-arrow main-drop ml-md-3">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img"><img src="assets/img/avatar_glory.jpg" alt="">
                    <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href=""><i class="feather-user"></i> My Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="feather-power"></i> Logout
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
        </li>
    </ul>

</div>