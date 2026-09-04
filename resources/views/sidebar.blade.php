<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aromatica</title>

  
</head>
<body>
  <header class="site-header">
    <nav class="navbar navbar-expand-lg ">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href={{url('home')}}>
          <img src="{{ asset('img/aromatica.jpg') }}" alt="Photo">
        </a>

        <a class="navbar-toggler" type="a" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
          <span class="navbar-toggler-icon"></span>
        </a>

        <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
          <ul class="navbar-nav gap-lg-4">
            <li class="nav-item"><a class="nav-link" href={{ url('perfume') }}>COMPRA</a></li>
            <li class="nav-item"><a class="nav-link" href={{ url('avaliacoes') }}>AVALIAÇÕES</a></li>
            <li class="nav-item"><a class="nav-link" href={{ url('usuario') }}>USUARIOS</a></li>
          </ul>
        </div>
      </div>
    </nav>
    </nav>
  </header>