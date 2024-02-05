@extends('layouts.app')

@section('title', 'Contacto')

@section('content')


    <!-- jumbotrob / título productos -->
    <div class="container-fluid p-0 mb-3">
        <div class="jumbotron jumbotron-fluid imagencover px-4 mb-0 d-flex align-items-center text-center mt-md-n2">
            <div class="container">
                <p class="text-black-50 display-5">Contacto</p>
            </div>
        </div>
        <div class="bg-opacity-10 bg-black d-none d-lg-block d-sm-none">
            <div class="container mt-md-n5 pt-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-0 py-2">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Inicio</a></li>
                        <li class="breadcrumb-item active text-black" aria-current="page">Contacto</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>



  <!-- contenido form / mapa -->
  <div class="container-md mt-5 mb-3">
    <div class="row">
      <!-- form -->
      <div class="col mb-3">
        <form class="row g-3">
          <legend class="h3">Envianos tu consulta</legend>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="nombre" placeholder="Tu nombre" value="">
              <label for="nombre">Nombre</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" id="apellido" placeholder="Tu apellido" value="">
              <label for="apellido">Apellido</label>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-floating">
              <select class="form-select" id="asunto" aria-label="Floating label select example">
                <option selected>Selecciona un asunto</option>
                <option value="1">Consulta</option>
                <option value="2">Presupuesto</option>
                <option value="3">Reclamo</option>
                <option value="4">Otros</option>
              </select>
              <label for="asunto">Asunto</label>
            </div>
          </div>

          <div class="col-md-8">
            <div class="form-floating">
              <input type="email" class="form-control" id="email" placeholder="tu-email@ejemplo.com" value="">
              <label for="email">Correo electrónico</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <input type="number" class="form-control" id="tel" placeholder="+54911-54673820" value="">
              <label for="tel">Teléfono de contacto</label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-floating">
              <select class="form-select" id="asunto" aria-label="Floating label select example">
                <option selected>Selecciona un tipo de empresa</option>
                <option value="1"> Distribuidor</option>
                <option value="2"> Carpintero</option>
                <option value="3"> Fabricante</option>
                <option value="4"> Arquitecto</option>
                <option value="5"> Consumidor final</option>
              </select>
              <label for="asunto">Empresa</label>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-floating">
              <textarea class="form-control" placeholder="Ingrese un breve comentario" id="comentario" rows="7"
                aria-describedby="comentarios"></textarea>
              <label for="comentario">Mensaje</label>
              <small id="comentarios" class="form-text text-muted">(Máximo de 500 caracteres)</small>
            </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Enviar consulta</button>
          </div>
        </form>
      </div>

      <!-- mapa -->
      <div class="col-md-5 mb-3">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5642.046963732357!2d-58.40639387263893!3d-34.838111009667415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcd491284448c7%3A0xb78807c351c8daaf!2sPlacaSur%20S.A.!5e0!3m2!1ses-419!2sar!4v1704333937798!5m2!1ses-419!2sar"
          width="100%" height="415" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>


@endsection
