<?php

function MostrarHeader(){

}

function MostrarFooter(){
echo
'    <footer class="bg-dark text-white py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold"><i class="lni lni-sport-alt me-2"></i>PowerZone</h5>
            <p class="text-muted">Tu tienda de confianza para equipamiento deportivo de alta calidad.</p>
          </div>
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold">Enlaces Rápidos</h5>
            <ul class="list-unstyled">
              <li><a href="#" class="text-muted text-decoration-none">Sobre Nosotros</a></li>
              <li><a href="#" class="text-muted text-decoration-none">Política de Envío</a></li>
              <li><a href="#" class="text-muted text-decoration-none">Términos y Condiciones</a></li>
            </ul>
          </div>
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold">Contacto</h5>
            <p class="text-muted mb-1"><i class="lni lni-phone me-2"></i>+506 1234-5678</p>
            <p class="text-muted mb-1"><i class="lni lni-envelope me-2"></i>info@sportzone.com</p>
            <p class="text-muted"><i class="lni lni-map-marker me-2"></i>San José, Costa Rica</p>
          </div>
        </div>
        <hr class="border-secondary">
        <div class="text-center">
          <p class="mb-0 text-muted">&copy; 2026 PowerZone. Todos los derechos reservados.</p>
        </div>
      </div>
    </footer>';
}

function MostrarCSS(){
echo
  '<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio | PowerZone - Tienda Deportiva</title>
    <link rel="icon" href="data:,">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/lineicons.css" />
    <link rel="stylesheet" href="../assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/custom.css" />
  </head>';
}

function MostrarJS(){
echo 
'    <script src="../assets/jss/jquery-3.7.1.min.js"></script>
     <script src="../assets/jss/bootstrap.bundle.min.js"></script>
     <script src="../assets/jss/main.js"></script>';
}

