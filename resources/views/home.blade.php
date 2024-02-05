@extends('layouts.app')
@section('title', 'Inicio')

@section('content')

  <div class="container">
    <div class="row">
      <!-- Columna izquierda con mapa y gráfico -->
      <div class="col-md-6">
        <div id="map" style="height: 400px;"></div>
        <div id="chart" style="height: 300px;"></div>
      </div>

      <!-- Columna derecha con indicadores y texto -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <!-- Contenido de los indicadores -->
            {{-- @foreach ($indicators as $indicator)
              <div>{{ $indicator }}</div>
            @endforeach --}}
          </div>
        </div>
        <div class="mt-4">
          <!-- Bloque de texto -->
          {{-- <p>{{ $textBlock }}</p> --}}
          <p>Bloque de texto</p>
        </div>
      </div>
    </div>
  </div>



  {{-- <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"
    integrity="sha512-nzBrX+kJvwON5VUUBd9l8Xe+kfC2CaFxFwSW8VU9Wu7i4pR9cVvcy5sPra6m0wnl1bF+OQwsF55zr2Z7NtAwBog=="
    crossorigin="" />

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"
    integrity="sha512-/kBRHQqA5MjEkUcb7EA7I3aLc3OnI4kB40GVDVtSmbW8g6FIHgZt0pEhUPcJ6b+eeIzP0KG2ZtdB+Px4Mc6LyQ=="
    crossorigin=""></script> --}}

  <!-- Código para inicializar el mapa en el script -->
  <script>
    var map = L.map('map').setView([51.505, -0.09], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);
  </script>









  <!-- Chart.js -->
  {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

  <!-- Código para inicializar el gráfico en el script -->
  <script>
    var ctx = document.getElementById('chart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Dato 1', 'Dato 2', 'Dato 3', 'Dato 4'],
        datasets: [{
          label: 'Ejemplo de Gráfico de Barras',
          data: [12, 19, 3, 5],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>



@endsection
