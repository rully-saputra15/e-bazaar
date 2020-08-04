@extends('layout.master')

@section('content')
    <h1>Menu</h1>
    <p>Grafik 5 Jualan DKI 2 Terlaris!(Juni 2020 - Sekarang)</p>
    <canvas id="canvas" width="200" height="200"></canvas>
    <h1>Pendapatan</h1>
    <p>Grafik 5 Jualan DKI 2 Terlaris beserta penghasilan bersih!(Juni 2020 - Sekarang)</p>
    <canvas id="canvasPendapatan" width="200" height="200"></canvas>
    <script>
         var ctx = document.getElementById("canvas").getContext('2d');
         var ctxPendapatan = document.getElementById("canvasPendapatan").getContext('2d');
         var myChart = new Chart(ctx, {
        type: 'line',
    data: {
        labels: {!! json_encode($nama) !!},
        datasets: [{
            label: 'Jumlah Menu Terjual',
            data: {!! json_encode($terjual) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
            xAxes:[{
                ticks:{
                    maxRotation:90,
                    minRotation:90
                }
            }]
        }
    }
    });
    var myChart = new Chart(ctxPendapatan, {
        type: 'line',
    data: {
        labels: {!! json_encode($nama) !!},
        datasets: [{
            label: 'Pendapatan bersih per Rupiah',
            data: {!! json_encode($pendapatan) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
            xAxes:[{
                ticks:{
                    maxRotation:90,
                    minRotation:90
                }
            }]
        }
    }
    });
    </script>
@endsection
