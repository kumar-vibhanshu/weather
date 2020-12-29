<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $city = $_POST['city'];

    $get = json_decode(file_get_contents('http://ip-api.com/json/'), true);


    date_default_timezone_set($get['timezone']);

    $string = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&units=metric&appid=27c9193ebc037c4ee9acd2c3c1d2816f";
    $data_fetch = json_decode(file_get_contents($string), true);

    $temp = $data_fetch['main']['temp'];

    $icon = $data_fetch['weather'][0]['icon'];

    $visibility = $data_fetch['visibility'];
    $visibilitykm = $visibility / 1000;
    $country =  "<h1 class='w3-xxxlarge w3-animate-zoom'><b>" . $data_fetch['name'] . "," . $data_fetch['sys']['country'] . "</h1></b>";

    $logo = "<center><img src='http://openweathermap.org/img/w/" . $icon . ".png'></center>";
    $desc = "<b><p>" . $data_fetch['weather'][0]['description'] . "</p></b>";

    $temperature =  "<b>Temp:" . $temp . "°C</b><br>";
    $clouds = "<b>Clouds:" . $data_fetch['clouds']['all'] . "%</b><br>";
    $humidity = "<b>Humidity:" . $data_fetch['main']['humidity'] . "%</b><br>";
    $windspeed = "<b>Wind Speed:" . $data_fetch['wind']['speed'] . "m/s</b><br>";
    $pressure = "<b>Pressure:" . $data_fetch['main']['pressure'] . "hpa</b><br>";
    $visibility =  "<b>Visibility:" . $visibilitykm . "Km</b><br>";
    $sunrise = "<b>Sunrise:" . date('h:i A', $data_fetch['sys']['sunrise']) . "</b><br>";
    $sunset = "<b>Sunset:" . date('h:i A', $data_fetch['sys']['sunset']) . "</b>";
}
// if (isset($_POST['submit'])) {

// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Weather - Vibhanshu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <center>
        <h2>Get Weather Details</h2>
        <div class="card text-center w-50">
            <div class="card-header">Weather Info</div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="api_form">

                    <div class="email-login" style="background-color:#ffffff;">
                        <div class="form-group">

                            <input type="text" name="city" class=" form-control" required="" placeholder="Enter City Name">
                        </div>

                    </div>
                    <div class="submit-row" style="margin-bottom:8px;padding-top:0px;">
                        <input type="submit" name="submit" value="Get Weather" class="btn btn-primary btn-block box-shadow" />

                    </div>
                </form>
                <div class="">

                    <?php if (empty($temperature)) {
                    } else {
                        echo $city."<br/>";
                        echo $temperature;
                        echo $clouds;
                        echo $humidity;
                        echo $windspeed;
                        echo $pressure;
                        echo $visibility;
                        echo $sunrise;
                        echo $sunset;
                    }
                    ?>
                </div>
            </div>
            <div class="card-footer"> <a href="https://github.com/vibhanshumonty" target="_blank">K. Vibhanshu</a></div>
        </div>
        </center>
    </div>

</body>

</html>