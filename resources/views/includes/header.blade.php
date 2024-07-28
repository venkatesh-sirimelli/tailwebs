<div class="container">
    <div class="site_header">
               <a href="/home" class="site_title">tailwebs.</a>
                <ul class="header_menu">
                    <li><a href="/home" class="menu_link">Home</a></li>
                    <li><a href="/" class="menu_link user_logout">Logout</a></li>
                </ul>
    </div>
    <form action="{{ route('logout') }}" id="logout" method="post">
        @csrf
    </form>
</div>
