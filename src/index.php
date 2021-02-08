<?php
$weathericons = "weathericon";
#$weathericons = "climacon";
$pathtohere = substr(__DIR__, strlen($_SERVER["DOCUMENT_ROOT"])+1);
if($weathericons == "weathericon") {
 echo "<link rel=\"stylesheet\" href=\"".$pathtohere."/weathericons/weathericons-font.css\">";
} else {
 echo "<link rel=\"stylesheet\" href=\"".$pathtohere."/climacons/climacons-font.css\">";
}
echo "<link rel=\"stylesheet\" href=\"".$pathtohere."/weather.css\">";

// Get default input from config.ini.
$ini = parse_ini_file($pathtohere."/config.ini");
 $weather_location = $ini["name"];
 $weather_lat      = $ini["lat"];
 $weather_lon      = $ini["lon"];
 $weather_timezone = $ini["timezone"];
 $weather_ForC     = $ini["units"];
 $weather_API      = $ini["api_key"];

// OR get user input from host app in following variables:
// $weather_location
// $weather_lat
// $weather_lon
// $weather_timezone
// $weather_units

// Prepare additional settings.
if($weather_units == "C") { $weather_units = "metric"; } else { $weather_units = "imperial"; }
$weather_latlon = "lat=".$weather_lat."&lon=".$weather_lon;
date_default_timezone_set($weather_timezone);

// Access OpenWeatherMap.org API.
$openweathermapurl = "api.openweathermap.org/data/2.5/onecall?".$weather_latlon."&exclude=minutely,hourly,alerts&units=".$weather_units."&appid=".$weather_API;
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $openweathermapurl);
$getweather = curl_exec($ch);
curl_close($ch);
$getweather = json_decode($getweather);

// Read data from API JSON.
if($weather_units == "metric") {
 $weather_degrees = "°C";
} else {
 $weather_degrees = "°F";
}  
$weather_CurrTemp = round($getweather->current->temp).$weather_degrees;
$weather_CurrDesc = $getweather->current->weather[0]->description;
$weather_Day0Desc = $getweather->daily[0]->weather[0]->description;
$weather_Day0MinT = round($getweather->daily[0]->temp->min).$weather_degrees;
$weather_Day0MaxT = round($getweather->daily[0]->temp->max).$weather_degrees;
$weather_Day1Desc = $getweather->daily[1]->weather[0]->description;
$weather_Day1MinT = round($getweather->daily[1]->temp->min).$weather_degrees;
$weather_Day1MaxT = round($getweather->daily[1]->temp->max).$weather_degrees;
$weather_Day2Desc = $getweather->daily[2]->weather[0]->description;
$weather_Day2MinT = round($getweather->daily[2]->temp->min).$weather_degrees;
$weather_Day2MaxT = round($getweather->daily[2]->temp->max).$weather_degrees;
$weather_Day3Desc = $getweather->daily[3]->weather[0]->description;
$weather_Day3MinT = round($getweather->daily[3]->temp->min).$weather_degrees;
$weather_Day3MaxT = round($getweather->daily[3]->temp->max).$weather_degrees;
$weather_Day4Desc = $getweather->daily[4]->weather[0]->description;
$weather_Day4MinT = round($getweather->daily[4]->temp->min).$weather_degrees;
$weather_Day4MaxT = round($getweather->daily[4]->temp->max).$weather_degrees;
$weather_Day5Desc = $getweather->daily[5]->weather[0]->description;
$weather_Day5MinT = round($getweather->daily[5]->temp->min).$weather_degrees;
$weather_Day5MaxT = round($getweather->daily[5]->temp->max).$weather_degrees;
$weather_Day6Desc = $getweather->daily[6]->weather[0]->description;
$weather_Day6MinT = round($getweather->daily[6]->temp->min).$weather_degrees;
$weather_Day6MaxT = round($getweather->daily[6]->temp->max).$weather_degrees;
$weather_Day7Desc = $getweather->daily[7]->weather[0]->description;
$weather_Day7MinT = round($getweather->daily[7]->temp->min).$weather_degrees;
$weather_Day7MaxT = round($getweather->daily[7]->temp->max).$weather_degrees;
$hour = date("H");

// Set icon for each weather description.
if($weathericons == "weathericon") {
 // Weathericons. AVAILABLE ICONS:
 // clear, cloudy, cloudy-gusts, cloudy-windy, fog, hail, lightning, rain, rain-mix, rain-wind, showers, sleet, sleet-storm, snow, snow-thunderstorm, snow-wind, sprinkle, storm-showers, overcast, thunderstorm, haze, smog, smoke, dust, windy, strong-wind, sandstorm, volcano, tornado
 function weather_getIcon($i) {
  switch(strtolower($i)) {
  // THUNDERSTORM
   case "thunderstorm with light rain": $weather_icon = "storm-showers"; break;
   case "thunderstorm with rain": $weather_icon = "thunderstorm"; break;
   case "thunderstorm with heavy rain": $weather_icon = "thunderstorm"; break;
   case "light thunderstorm": $weather_icon = "lightning"; break;
   case "thunderstorm": $weather_icon = "lightning"; break;
   case "heavy thunderstorm": $weather_icon = "lightning"; break;
   case "ragged thunderstorm": $weather_icon = "lightning"; break;
   case "thunderstorm with light drizzle": $weather_icon = "storm-showers"; break;
   case "thunderstorm with drizzle": $weather_icon = "storm-showers"; break;
   case "thunderstorm with heavy drizzle": $weather_icon = "thunderstorm"; break;
  // DRIZZLE
   case "light intensity drizzle": $weather_icon = "rain-mix"; break;
   case "drizzle": $weather_icon = "showers"; break;
   case "heavy intensity drizzle": $weather_icon = "rain"; break;
   case "light intensity drizzle rain": $weather_icon = "rain-mix"; break;
   case "drizzle rain": $weather_icon = "showers"; break;
   case "heavy intensity drizzle rain": $weather_icon = "rain"; break;
   case "shower rain and drizzle": $weather_icon = "showers"; break;
   case "heavy shower rain and drizzle": $weather_icon = "rain"; break;
   case "shower drizzle": $weather_icon = "showers"; break;
  // RAIN
   case "light rain": $weather_icon = "rain"; break;
   case "moderate rain": $weather_icon = "rain"; break;
   case "heavy intensity rain": $weather_icon = "downpour"; break;
   case "very heavy rain": $weather_icon = "downpour"; break;
   case "extreme rain": $weather_icon = "downpour"; break;
   case "freezing rain": $weather_icon = "sleet"; break;
   case "light intensity shower rain": $weather_icon = "showers"; break;
   case "shower rain": $weather_icon = "showers"; break;
   case "heavy intensity shower rain": $weather_icon = "showers"; break;
   case "ragged shower rain": $weather_icon = "showers"; break;
  // SNOW
   case "light snow": $weather_icon = "snow-wind"; break;
   case "snow": $weather_icon = "snow"; break;
   case "heavy snow": $weather_icon = "snow"; break;
   case "sleet": $weather_icon = "sleet"; break;
   case "light shower sleet": $weather_icon = "sleet"; break;
   case "shower sleet": $weather_icon = "sleet"; break;
   case "light rain and snow": $weather_icon = "rain-mix"; break;
   case "rain and snow": $weather_icon = "rain-mix"; break;
   case "light shower snow": $weather_icon = "snow"; break;
   case "shower snow": $weather_icon = "snow"; break;
   case "heavy shower snow": $weather_icon = "snow"; break;
  // ATMOSPHERE
   case "mist": $weather_icon = "smog"; break;
   case "Smoke": $weather_icon = "smoke"; break;
   case "haze": $weather_icon = "haze"; break;
   case "sand/ dust whirls": $weather_icon = "sandstorm"; break;
   case "fog": $weather_icon = "fog"; break;
   case "sand": $weather_icon = "haze"; break;
   case "dust": $weather_icon = "dust"; break;
   case "volcanic ash": $weather_icon = "vaolcano"; break;
   case "squalls": $weather_icon = "strong-wind"; break;
   case "tornado": $weather_icon = "tornado"; break;
  // CLEAR
   case "clear sky": $weather_icon = "clear"; break;
  //CLOUDS
   case "few clouds": $weather_icon = "cloudy"; break;
   case "scattered clouds": $weather_icon = "cloudy"; break;
   case "broken clouds": $weather_icon = "cloudy"; break;
   case "overcast clouds": $weather_icon = "overcast"; break;
  }
  return $weather_icon;
 }
} else {
 // Climacons. AVAILABLE ICONS:
 // lightning, drizzle, rain, snow, haze, fog, tornado, showers, downpour, sleet, hail, flurries, wind, wind cloud, sun, moon, cloud
 function weather_getIcon($i) {
  switch(strtolower($i)) {
  // THUNDERSTORM
   case "thunderstorm with light rain": $weather_icon = "lightning"; break;
   case "thunderstorm with rain": $weather_icon = "lightning"; break;
   case "thunderstorm with heavy rain": $weather_icon = "lightning"; break;
   case "light thunderstorm": $weather_icon = "lightning"; break;
   case "thunderstorm": $weather_icon = "lightning"; break;
   case "heavy thunderstorm": $weather_icon = "lightning"; break;
   case "ragged thunderstorm": $weather_icon = "lightning"; break;
   case "thunderstorm with light drizzle": $weather_icon = "lightning"; break;
   case "thunderstorm with drizzle": $weather_icon = "lightning"; break;
   case "thunderstorm with heavy drizzle": $weather_icon = "lightning"; break;
  // DRIZZLE
   case "light intensity drizzle": $weather_icon = "drizzle"; break;
   case "drizzle": $weather_icon = "drizzle"; break;
   case "heavy intensity drizzle": $weather_icon = "drizzle"; break;
   case "light intensity drizzle rain": $weather_icon = "drizzle"; break;
   case "drizzle rain": $weather_icon = "drizzle"; break;
   case "heavy intensity drizzle rain": $weather_icon = "drizzle"; break;
   case "shower rain and drizzle": $weather_icon = "showers"; break;
   case "heavy shower rain and drizzle": $weather_icon = "showers"; break;
   case "shower drizzle": $weather_icon = "showers"; break;
  // RAIN
   case "light rain": $weather_icon = "rain"; break;
   case "moderate rain": $weather_icon = "rain"; break;
   case "heavy intensity rain": $weather_icon = "downpour"; break;
   case "very heavy rain": $weather_icon = "downpour"; break;
   case "extreme rain": $weather_icon = "downpour"; break;
   case "freezing rain": $weather_icon = "rain"; break;
   case "light intensity shower rain": $weather_icon = "showers"; break;
   case "shower rain": $weather_icon = "showers"; break;
   case "heavy intensity shower rain": $weather_icon = "showers"; break;
   case "ragged shower rain": $weather_icon = "showers"; break;
  // SNOW
   case "light snow": $weather_icon = "flurries"; break;
   case "snow": $weather_icon = "snow"; break;
   case "heavy snow": $weather_icon = "snow"; break;
   case "sleet": $weather_icon = "sleet"; break;
   case "light shower sleet": $weather_icon = "sleet"; break;
   case "shower sleet": $weather_icon = "sleet"; break;
   case "light rain and snow": $weather_icon = "flurries"; break;
   case "rain and snow": $weather_icon = "snow"; break;
   case "light shower snow": $weather_icon = "flurries"; break;
   case "shower snow": $weather_icon = "snow"; break;
   case "heavy shower snow": $weather_icon = "snow"; break;
  // ATMOSPHERE
   case "mist": $weather_icon = "haze"; break;
   case "Smoke": $weather_icon = "haze"; break;
   case "haze": $weather_icon = "haze"; break;
   case "sand/ dust whirls": $weather_icon = "wind"; break;
   case "fog": $weather_icon = "fog"; break;
   case "sand": $weather_icon = "haze"; break;
   case "dust": $weather_icon = "haze"; break;
   case "volcanic ash": $weather_icon = "haze"; break;
   case "squalls": $weather_icon = "wind"; break;
   case "tornado": $weather_icon = "tornado"; break;
  // CLEAR
   case "clear sky": $weather_icon = "sun"; break;
  //CLOUDS
   case "few clouds": $weather_icon = "cloud"; break;
   case "scattered clouds": $weather_icon = "cloud"; break;
   case "broken clouds": $weather_icon = "cloud"; break;
   case "overcast clouds": $weather_icon = "cloud"; break;
  }
  return $weather_icon;
 }
}

?>

<a class="nwslink" href="https://forecast.weather.gov/MapClick.php?<?php echo $weather_latlon; ?>">
<div class="grid-container">
<div class="todayicon" style="font-size:  <?php if($weathericons == "weathericon") { echo "60"; } else { echo "80"; } ?>px;"><span class="<?php echo $weathericons." ".weather_getIcon($weather_CurrDesc); if($hour<6 || $hour>20) { echo " moon"; } else { echo " sun";} ?>"><!-- <?php echo $weather_CurrDesc; ?> --></span></div>
<div class="todaylocation"><?php echo $weather_location; ?></div>
<div class="daytitle0">Today</div>
<div class="daytitle1">Tomorrow</div>
<div class="daytitle2"><?php echo date("l", strtotime("+2 days")); ?></div>
<div class="daytitle3"><?php echo date("l", strtotime("+3 days")); ?></div>
<div class="daytitle4"><?php echo date("l", strtotime("+4 days")); ?></div>
<div class="daytitle5"><?php echo date("l", strtotime("+5 days")); ?></div>
<div class="daytitle6"><?php echo date("l", strtotime("+6 days")); ?></div>
<div class="daytitle7"><?php echo date("l", strtotime("+7 days")); ?></div>
<div class="dayclimacon0" style="<?php if($weathericons == "weathericon") { echo "top: 0; font-size: 30px;"; } else { echo "top: -8px; font-size: 50px;"; } ?>">
 <span class="<?php echo $weathericons." ".weather_getIcon($weather_Day0Desc); ?>"><!-- <?php echo $weather_Day0Desc; ?> --></span></div>
<div class="dayclimacon1" style="<?php if($weathericons == "weathericon") { echo "top: 0; font-size: 30px;"; } else { echo "top: -8px; font-size: 50px;"; } ?>">
 <span class="<?php echo $weathericons." ".weather_getIcon($weather_Day1Desc); ?>"><!-- <?php echo $weather_Day1Desc; ?> --></span></div>
<div class="dayclimacon2" style="<?php if($weathericons == "weathericon") { echo "top: 0; font-size: 30px;"; } else { echo "top: -8px; font-size: 50px;"; } ?>">
 <span class="<?php echo $weathericons." ".weather_getIcon($weather_Day2Desc); ?>"><!-- <?php echo $weather_Day2Desc; ?> --></span></div>
<div class="dayclimacon3" style="<?php if($weathericons == "weathericon") { echo "top: 0; font-size: 30px;"; } else { echo "top: -8px; font-size: 50px;"; } ?>">
 <span class="<?php echo $weathericons." ".weather_getIcon($weather_Day3Desc); ?>"><!-- <?php echo $weather_Day3Desc; ?> --></span></div>
<div class="dayclimacon4" style="<?php if($weathericons == "weathericon") { echo "top: 0; font-size: 30px;"; } else { echo "top: -8px; font-size: 50px;"; } ?>">
 <span class="<?php echo $weathericons." ".weather_getIcon($weather_Day4Desc); ?>"><!-- <?php echo $weather_Day4Desc; ?> --></span></div>
<div class="dayclimacon5" style="<?php if($weathericons == "weathericon") { echo "top: 0; font-size: 30px;"; } else { echo "top: -8px; font-size: 50px;"; } ?>">
 <span class="<?php echo $weathericons." ".weather_getIcon($weather_Day5Desc); ?>"><!-- <?php echo $weather_Day5Desc; ?> --></span></div>
<div class="dayclimacon6" style="<?php if($weathericons == "weathericon") { echo "top: 0; font-size: 30px;"; } else { echo "top: -8px; font-size: 50px;"; } ?>">
 <span class="<?php echo $weathericons." ".weather_getIcon($weather_Day6Desc); ?>"><!-- <?php echo $weather_Day6Desc; ?> --></span></div>
<div class="dayclimacon7" style="<?php if($weathericons == "weathericon") { echo "top: 0; font-size: 30px;"; } else { echo "top: -8px; font-size: 50px;"; } ?>">
 <span class="<?php echo $weathericons." ".weather_getIcon($weather_Day7Desc); ?>"><!-- <?php echo $weather_Day7Desc; ?> --></span></div>
<div class="todaytop"></div>
<div class="todaybottom"></div>
<div class="today"><span class="nowtemp"><?php echo $weather_CurrTemp; ?></span><br><span class="nowcond"><?php echo $weather_CurrDesc; ?></span></div>
<div class="hi0"><?php echo $weather_Day0MaxT; ?></div>
<div class="lo0"><?php echo $weather_Day0MinT; ?></div>
<div class="hi1"><?php echo $weather_Day1MaxT; ?></div>
<div class="lo1"><?php echo $weather_Day1MinT; ?></div>
<div class="hi2"><?php echo $weather_Day2MaxT; ?></div>
<div class="lo2"><?php echo $weather_Day2MinT; ?></div>
<div class="hi3"><?php echo $weather_Day3MaxT; ?></div>
<div class="lo3"><?php echo $weather_Day3MinT; ?></div>
<div class="hi4"><?php echo $weather_Day4MaxT; ?></div>
<div class="lo4"><?php echo $weather_Day4MinT; ?></div>
<div class="hi5"><?php echo $weather_Day5MaxT; ?></div>
<div class="lo5"><?php echo $weather_Day5MinT; ?></div>
<div class="hi6"><?php echo $weather_Day6MaxT; ?></div>
<div class="lo6"><?php echo $weather_Day6MinT; ?></div>
<div class="hi7"><?php echo $weather_Day7MaxT; ?></div>
<div class="lo7"><?php echo $weather_Day7MinT; ?></div>
</div>
</a>
