<?php

header('Content-Type: application/json');

$data = [

    "status"=>"success",

    "message"=>"Laravel REST API",

    "endpoints"=>[
        "GET /posts",
        "POST /posts",
        "PUT /posts/{id}",
        "DELETE /posts/{id}"
    ]

];

echo json_encode($data,JSON_PRETTY_PRINT);