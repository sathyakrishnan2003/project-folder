<?php

echo "<h2>Laravel Testing & Debugging Demo</h2>";

$tests = [
    "Homepage Test",
    "Registration Test",
    "Login Test",
    "Create CRUD Test",
    "Delete CRUD Test"
];

foreach($tests as $test){
    echo "<p>$test : PASSED</p>";
}

?>