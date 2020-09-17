@extends('layouts.exskel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="text-center mt-3 mb-4">Contact Us</h1>
            <div class="text-center mb-4">
                <p class="mb-1">
                    <a href = "mailto: valentino.digiosaffatte@student.univaq.it">valentino.digiosaffatte@student.univaq.it</a>    
                </p>
                <p class="m-0">
                    <a href = "mailto: riccardoarmando.diprinzio@student.univaq.it">riccardoarmando.diprinzio@student.univaq.it</a>
                </p>
            </div>

            <!-- Leaflet :: Open Street Map -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
            <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
            
            <div id="mapid" style="height: 500px;" class="rounded border border-primary"></div>
        </div>
    </div>
</div>

<script>
    var mymap = L.map('mapid').setView([42.350, 13.3944], 14);
    L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    }).addTo(mymap);
</script>
@endsection