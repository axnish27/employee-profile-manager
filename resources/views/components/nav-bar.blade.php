<nav class="navbar bg-dark border-bottom border-body w-100 text-light py-0 "  data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="#"> Vista G </a>
        <div class="nav navbar">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>
