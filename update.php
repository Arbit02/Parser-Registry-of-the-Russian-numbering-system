<?php
    $curl = curl_init("https://opendata.digital.gov.ru/registry/numeric/downloads");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($curl);
    curl_close($curl);
function Get_Content($data)
{
    preg_match_all("/https:\/\/opendata.digital.gov.ru\/downloads\/[A-Z0-9_\-\.\/\#\=\&]*/i", $data, $url_matches);
    // print_r($url_matches[0]);
    return $url_matches[0];

}
function Update_File($link)
{
    $contextOptions = array(
        "ssl" => array(
            "verify_peer"      => false,
            "verify_peer_name" => false,
        ),
    );
    foreach ($link as $file) {
        $baze_file = basename($file);
        $savePath = __DIR__ . '/files/' . $baze_file;
        copy($file, $savePath, stream_context_create( $contextOptions ));
    }
}
$array_link = Get_Content($data);
Update_File($array_link);



