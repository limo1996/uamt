<!DOCTYPE html>
<html>
<head lang="sk">
    <title>Kontakt</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
    
</style>
</head>
<body>
<div class="container">
    <div class="jumbotron jumbotron-sm" style="background-color:#4268f4;margin-top:2%;color:white;">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <h1 class="h2" style="margin-top:-2%">
                    Kontakt
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="well">
                <h3 style="line-height:20%;"><i class="fa fa-home fa-1x" style="line-height:6%;color:#4268f4"></i> Adresa:</h3>
                <p>Ústav automobilovej mechatroniky, FEI STU, Ilkovičova 3,
                    812 19 Bratislava, Slovenská republika</p>

                <h3><i class="fa fa-user fa-1x" style="line-height:6%;color:#4268f4"></i> Sekretariát:</h3>
                <p>Katarína Kermietová</p>

                <h2><i class="fa fa-key fa-1x" style="line-height:6%;color:#4268f4"></i> Kancelária</h2>
                <p>D116</p>

                <h2><i class="fa fa-envelope fa-1x" style="line-height:6%;color:#4268f4"></i> E-mail:</h2>
                <p>katarina.kermietova[at]stuba.sk</p>

                <h2><i class="fa fa-phone fa-1x" style="line-height:6%;color:#4268f4"></i> Telefónne číslo:</h2>
                <p>+421 260 291 598</p>
                <p>+421 265 429 734</p>
            </div>
        </div>
        <div id="map" class="col-sm-6" style=" height:480px">
        </div>
    </div>
</div>

<script>
    function myMap() {
        var myCenter = new google.maps.LatLng(48.151867, 17.073667);
        var mapCanvas = document.getElementById("map");
        var mapOptions = {center: myCenter, zoom: 17};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({position:myCenter});
        marker.setMap(map);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAytqakc7clT5GMMm3GsiRV-LSrPYviawQ&callback=myMap"></script>

</body>

</html>