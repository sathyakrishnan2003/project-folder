<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));

    $_SESSION["username"] = $name;

    echo "<h2>Form Submitted Successfully</h2>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Session User:</strong> " . $_SESSION["username"] . "</p>";
}
?>