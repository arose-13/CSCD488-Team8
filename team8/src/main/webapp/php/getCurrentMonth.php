<?php

function getCurrentMonth($username) {

    $inBound = curl_init("localhost:8080/team8-0.1/webapi/GetThisMonthsJson/{uname}");
    curl_setopt($inBound, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($inBound, CURLOPT_HTTPHEADER, array('Content-Type: text:plain'));
    curl_setopt($inBound, CURLOPT_POST, 1);

    $inBoundQuery = http_build_query( array('uname'=>$username ));
    curl_setopt($inBound, CURLOPT_POSTFIELDS, $inBoundQuery);

    $json_encoded = curl_exec($inBound);
    curl_close($inBound);
    
    return $json_encoded;
}

?>