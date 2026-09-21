<!DOCTYPE html>
<html>
<head>
    <title>PHP Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>PHP User Form</h2>

    <form action="process.php" method="POST">
        <input type="text" name="name" placeholder="Enter your name" required>

        <input type="email" name="email" placeholder="Enter your email" required>

        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>