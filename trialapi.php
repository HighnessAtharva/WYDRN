<?php

$url = 'https://api.themoviedb.org/3/search/movie?api_key=e446bc89015229cf337e16b0849d506c&query=Scarface&year=1983&include_adult=true';

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json'
]);

$response = curl_exec($curl);
$response=json_decode($response,true);
curl_close($curl);

print_r ($response['results'][0]['poster_path']);

?>