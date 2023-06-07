<nav class="navbar navbar-expand-lg navbar-dark bg-dark balk">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Trivia it!</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('quizzen.index') }}">Quizzen</a>
                <a class="nav-link" href="/">Creator</a>
                <a class="nav-link" href="{{ route('other.about') }}">About</a>
            </div>
            <div class="navbar-nav">
                @if (Auth::check())
                    <a class="nav-link" href="/">Profile</a>
                    <a class="nav-link" href="/">Logout</a>
                @else
                    <a class="nav-link" href="/">Register</a>
                    <a class="nav-link" href="{{ route('account.login') }}">Login</a>
                @endif
            </div>
        </div>
    </div>
</nav>
