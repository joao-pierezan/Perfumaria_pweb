@extends('main')
@section('titulo', 'Aromatica Perfumaria - Nossa História')

@section('conteudo')
  <main>
    <!-- Hero Section -->
    <section class="py-5 bg-light text-dark">
      <div class="container py-5">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <span class="text-muted text-uppercase fw-bold small mb-2 d-block">Tradição • Amizade • Alta Perfumaria</span>
            <h1 class="display-4 fw-bold text-dark mb-3">A nossa história de paixão pela perfumaria</h1>
            <p class="lead text-muted mb-4">
              Conheça a trajetória da Aromatica Perfumaria, construída sobre os pilares da excelência, inovação e de uma sólida parceria.
            </p>
            <div class="d-flex flex-wrap gap-3 mt-4">
              <a href="{{ url('perfume') }}" class="btn btn-dark btn-lg fw-semibold">Ver Catálogo</a>
              <a href="{{ url('notas') }}" class="btn btn-outline-dark btn-lg">Conheça as Notas</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Chart 1: O Primeiro Sócio e a Inspiração Inicial -->
    <section class="py-5 bg-white text-dark">
      <div class="container py-4">
        <div class="row align-items-center g-5">
          <div class="col-lg-5">
            <span class="text-muted text-uppercase fw-bold small mb-2 d-block">Capítulo I</span>
            <h2 class="fw-bold mb-3 text-dark">A visão e a busca pela essência perfeita</h2>
            <p class="lead text-muted">
              Tudo começou com o sonho individual de transformar memórias em fragrâncias marcantes e de alta fixação.
            </p>
            <p class="text-secondary">
              Movido por uma paixão profunda pelas matérias-primas mais nobres, o primeiro fundador iniciou os estudos e a curadoria de acordes olfativos únicos, estabelecendo os padrões de sofisticação que definem a nossa marca desde o primeiro dia.
            </p>
          </div>

          <div class="col-lg-7">
            <div class="card bg-white text-dark border shadow-sm p-4 rounded-4 text-center">
              <div class="rounded-4 overflow-hidden shadow-sm border mb-3">
                <img src={{ asset('img/joao.jpg') }} alt="Sócio Fundador" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
              </div>
              <h3 class="h5 fw-bold text-dark mb-1">A origem da inspiração</h3>
              <p class="text-muted small mb-0">O início da jornada no desenvolvimento de fragrâncias exclusivas</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Chart 2: O Segundo Sócio e a Expansão -->
    <section class="py-5 bg-light text-dark">
      <div class="container py-4">
        <div class="row align-items-center g-5 flex-lg-row-reverse">
          <div class="col-lg-5">
            <span class="text-muted text-uppercase fw-bold small mb-2 d-block">Capítulo II</span>
            <h2 class="fw-bold mb-3 text-dark">A técnica, a inovação e o encontro</h2>
            <p class="lead text-muted">
              Com uma visão voltada para a precisão e a estruturação de negócios, o segundo sócio trouxe o equilíbrio ideal para o projeto.
            </p>
            <p class="text-secondary">
              Unindo a sensibilidade artística à rigorosa seleção técnica e aos processos modernos de extração, a marca ganhou uma identidade corporativa sólida, unindo design de frascos impecável e fórmulas olfativas de alto nível.
            </p>
          </div>

          <div class="col-lg-7">
            <div class="card bg-white text-dark border shadow-sm p-4 rounded-4 text-center">
              <div class="rounded-4 overflow-hidden shadow-sm border mb-3">
                <img src={{ asset('img/gaucho.jpg') }} alt="Sócio e Diretor Criativo" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
              </div>
              <h3 class="h5 fw-bold text-dark mb-1">A precisão e o rigor técnico</h3>
              <p class="text-muted small mb-0">Desenvolvimento de fórmulas e lapidação de acordes complexos</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Chart 3: A União e a Amizade dos Sócios -->
    <section class="py-5 bg-white text-dark">
      <div class="container py-4">
        <div class="row align-items-center g-5">
          <div class="col-lg-5">
            <span class="text-muted text-uppercase fw-bold small mb-2 d-block">Capítulo III</span>
            <h2 class="fw-bold mb-3 text-dark">Amizade de longa data e o nascimento da Aromatica</h2>
            <p class="lead text-muted">
              Mais do que parceiros de negócios, uma amizade consolidada pela busca incessante da excelência na perfumaria.
            </p>
            <p class="text-secondary">
              A união de trajetórias complementares deu vida à Aromatica Perfumaria. Hoje, cada fragrância que sai de nossos laboratórios carrega essa história de cumplicidade, visão compartilhada e compromisso inegociável com a qualidade e o bem-estar dos nossos clientes.
            </p>
            <div class="mt-4">
              <a href="{{ url('perfume') }}" class="btn btn-dark px-4 py-2">
                Conheça Nossas Coleções
              </a>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="card bg-white text-dark border shadow-sm p-4 rounded-4 text-center">
              <div class="rounded-4 overflow-hidden shadow-sm border mb-3">
                <img src={{ asset('img/nois.jpg') }} alt="Os sócios juntos" class="img-fluid w-100" style="max-height: 450px; object-fit: cover;">
              </div>
              <h3 class="h5 fw-bold text-dark mb-1">Parceria e Visão de Futuro</h3>
              <p class="text-muted small mb-0">Os fundadores unidos consolidando o sucesso da marca</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
@endsection