<header class="site-header">
    <nav class="navbar navbar-expand-lg bg-light border-bottom mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('home') }}">
                <img src="{{ asset('img/aromatica.jpg') }}" alt="Aromatica" style="max-height: 60px;">
                <span class="fw-bold">Aromatica</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
                <ul class="navbar-nav gap-lg-3">
                    <li class="nav-item"><a class="nav-link" href="{{ url('home') }}">INÍCIO</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('perfume') }}">PERFUMES</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('notas') }}">NOTAS OLFATIVAS</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('avaliacoes') }}">AVALIAÇÕES</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('usuario') }}">USUÁRIOS</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>