<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="{{ asset('backend/assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/header-colors.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link href="{{ asset('backend/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <title>Chitanță</title>
</head>

<body>
    <h1 class="text-center">Chitanță - Splash Shop - {{ $data->invoice_no }}</h1>

    <div class="page-wrapper">
        <div class="page-content">
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">

                                    <ul class="list-group" style="list-style-type: none">
                                        <li class="list-group-item"><strong> <span class="text-dark"> Nume Produs :
                                                </span> </strong> {{ $data->product_name }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Cod Produs :
                                                </span> </strong> {{ $data->product_code }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Mărime Produs
                                                    :
                                                </span> </strong> {{ $data->size }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Culoare
                                                    Produs :
                                                </span> </strong> {{ $data->color }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Cantitate
                                                    Produs
                                                    : </span> </strong> {{ $data->quantity }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Preț pe
                                                    Unitate :
                                                </span> </strong> {{ $data->unit_price }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Preț Total :
                                                </span> </strong> {{ $data->total_price }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Email
                                                    Utilizator
                                                    :
                                                </span> </strong> {{ $data->email }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Nume
                                                    Utilizator :
                                                </span> </strong> {{ $data->name }} </li>
                                    </ul>

                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">

                            <div class="card">
                                <div class="card-body">

                                    <ul class="list-group" style="list-style-type: none">
                                        <li class="list-group-item"><strong> <span class="text-dark"> Metodă
                                                    Plată
                                                    : </span> </strong> {{ $data->payment_method }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Adresă
                                                    Livrare : </span> </strong> {{ $data->delivery_address }}
                                        </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Oraș :
                                                </span> </strong> {{ $data->city }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Cost
                                                    Livrare
                                                    : </span> </strong> {{ $data->delivery_charge }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Data :
                                                </span> </strong> {{ $data->order_date }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Timp :
                                                </span> </strong> {{ $data->order_time }} </li>

                                        <li class="list-group-item"><strong> <span class="text-dark"> Status
                                                    : </span> </strong>

                                            <span class="badge badge-pill"
                                                style="background: #FF0000;">{{ $data->order_status }}</span>
                                        </li>

                                        <br>

                                        Pentru a vedea statusul comenzii <a href="http://localhost:3000/register">Apasă
                                            Aici</a>
                                        <br>
                                    </ul>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-knob/excanvas.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
    <script>
        $(function() {
            $(".knob").knob();
        });
    </script>
    <script src="{{ asset('backend/assets/js/index.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('backend/assets/plugins/input-tags/js/tagsinput.js') }}"></script>

</body>

</html>
