<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cityName = $_POST['city'];
    $apiKey = '427285b4ab7b4eefbd5221209231508';
    $apiUrl = "https://api.weatherapi.com/v1/current.json?key=$apiKey&q=$cityName&aqi=no";

    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if ($response === false) {
        echo "cURL Error: " . curl_error($ch);
    } else {
        $weatherData = json_decode($response, true);

        if ($weatherData) {
            echo "<h2>Weather in {$weatherData['location']['name']}, {$weatherData['location']['country']}</h2>";
            echo "<p>Local Time: {$weatherData['location']['localtime']}</p>";
            echo "<p>Temperature: {$weatherData['current']['temp_c']}°C ({$weatherData['current']['temp_f']}°F)</p>";
            echo "<p>Condition: {$weatherData['current']['condition']['text']}</p>";
            echo "<p>Wind: {$weatherData['current']['wind_mph']} mph ({$weatherData['current']['wind_kph']} km/h) {$weatherData['current']['wind_dir']}</p>";
            echo "<p>Pressure: {$weatherData['current']['pressure_mb']} mb ({$weatherData['current']['pressure_in']} inHg)</p>";
            echo "<p>Precipitation: {$weatherData['current']['precip_mm']} mm ({$weatherData['current']['precip_in']} in)</p>";
            echo "<p>Humidity: {$weatherData['current']['humidity']}%</p>";
            echo "<p>Cloud Cover: {$weatherData['current']['cloud']}%</p>";
            echo "<p>Feels Like: {$weatherData['current']['feelslike_c']}°C ({$weatherData['current']['feelslike_f']}°F)</p>";
            echo "<p>Visibility: {$weatherData['current']['vis_km']} km ({$weatherData['current']['vis_miles']} miles)</p>";
            echo "<p>UV Index: {$weatherData['current']['uv']}</p>";
            echo "<p>Gust: {$weatherData['current']['gust_mph']} mph ({$weatherData['current']['gust_kph']} km/h)</p>";
        } else {
            echo "<p>City not found</p>";
        }
    }
    
    curl_close($ch);
}
?>
