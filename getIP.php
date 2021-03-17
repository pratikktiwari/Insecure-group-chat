<?php
    $json = file_get_contents("http://ip-api.com/php/");
    $decoded = unserialize($json);

    // $list = array("isp" => $decoded["isp"],"query" => $decoded["query"], "country" => $decoded["country"]);
    $result = "ISP: ".$decoded["isp"].
              "<br/>IP: ".$decoded["query"].
              "<br/>Country: ".$decoded["country"].
              "<br/>City: ".$decoded["city"].
              "<br/>Latitude: ".$decoded["lat"].
              "<br/>Longitude: ".$decoded["lon"];
    // echo json_encode($list);
    echo $result;
?>
<?php
// {
//   "query": "24.48.0.1",
//   "status": "success",
//   "country": "Canada",
//   "countryCode": "CA",
//   "region": "QC",
//   "regionName": "Quebec",
//   "city": "Montreal",
//   "zip": "H1S",
//   "lat": 45.5808,
//   "lon": -73.5825,
//   "timezone": "America/Toronto",
//   "isp": "Le Groupe Videotron Ltee",
//   "org": "Videotron Ltee",
//   "as": "AS5769 Videotron Telecom Ltee"
// }

?>