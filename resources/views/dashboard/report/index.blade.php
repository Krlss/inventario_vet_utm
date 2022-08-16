@extends('layouts.app')

@section('content_header')
    <div class="text-2xl font-extrabold">{{ __('Title Home') }}</div>
    <h3 class="text-lg text-gray-700 uppercase font-bold">Cuadro de Mando</h3>
@endsection


@section('content')
    <div class="container bg-slate-50">
        {{-- <div class="grid grid-rows-2 gap-4"> --}}
        <div class="flex flex-row flex-grow flex-wrap gap-4">

            @foreach ($metricas as $key => $value)
                <x-card-report :title=$key :value=$value />
            @endforeach
        </div>
        <div class="flex flex-col md:flex-row gap-4">

            <div class="overflow-hidden p-4 mb-2 w-full shadow-md  rounded-lg bg-white md:w-1/2 h-1/2 ">
                <div class="py-2 text-lg uppercase text-center">Productos egresados de los últimos 30 días </div>
    
                <canvas class="w-full" id="grafico1"></canvas>
            </div>
            <div class="overflow-hidden p-4 mb-2 w-full shadow-md rounded-lg bg-white md:w-1/2 h-1/2 ">
                <div class="py-2 text-lg uppercase text-center">Productos ingresados de los últimos 30 días </div>
                <canvas class="w-full" id="grafico2"></canvas>
            </div>
        </div>

        {{-- </div> --}}
    </div>
@endsection


@push('js')
    <script src="{{ asset('plugins/chart/Chart.bundle.js') }}"></script>

    <script>
        $(document).ready(() => {
            $.ajax({
                url: "{{ route('egressByDayMes') }}",
                method: "GET",
                success: function(data) {

                    const egress = Object.entries(data).reduce((acc, current) => {
                        if (current[1] != 0) {
                            acc = [...acc, {
                                'day': current[0],
                                'value': current[1]
                            }]
                        }
                        return acc
                    }, []).sort((a, b) => a.day - b.day)
                    console.log(egress);
                    var ctx = document.getElementById('grafico1').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: egress.map((e) => `${e.day}th`),
                            datasets: [{
                                label: 'Egresos del día',
                                data: egress.map((e) => e.value),
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        userCallback: function(label, index, labels) {
                                            // when the floored value is the same as the value we have a whole number
                                            if (Math.floor(label) === label) {
                                                return label;
                                            }

                                        },
                                    }
                                }],
                            },
                        }
                    });

                },
                error: function(data) {
                    console.log(data);
                }
            })
            $.ajax({
                url: "{{ route('ingressByDayMes') }}",
                method: "GET",
                success: function(data) {

                    const ingress = Object.entries(data).reduce((acc, current) => {
                        if (current[1] != 0) {
                            acc = [...acc, {
                                'day': current[0],
                                'value': current[1]
                            }]
                        }
                        return acc
                    }, []).sort((a, b) => a.day - b.day)
                    var ctx2 = document.getElementById('grafico2').getContext('2d');
                    var myChart2 = new Chart(ctx2, {
                        type: 'line',
                        data: {
                            labels: ingress.map((e) => `${e.day}th`),
                            datasets: [{
                                label: 'Ingresos del día',
                                data: ingress.map((e) => e.value),
                                backgroundColor: [
                                    'rgba(129, 236, 236, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(129, 236, 236,1.0)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        userCallback: function(label, index, labels) {
                                            // when the floored value is the same as the value we have a whole number
                                            if (Math.floor(label) === label) {
                                                return label;
                                            }

                                        },
                                    }
                                }],
                            },
                        }
                    });

                },
                error: function(data) {
                    console.log(data);
                }
            })
        })
    </script>
@endpush
