<?php

    //session_start();

    //if (!isset($_SESSION['username']))
        //header("Location: login.php");

    //$username = $_SESSION['username'];
    //$userID = $_SESSION['userID'];

    // Logic for updating the database
    if (isset($_POST['submit'])) {

        $choice = $_POST['type'];
        $amount = $_POST['amount'];

        if ($choice == "income") {
            ;// UPDATE [tablename] SET income = $amount WHERE userID = $_SESSION['userID'];
        }
        else {
            ;// UPDATE [tablename] SET expense = $amount WHERE userID = $_SESSION['userID'];
        }

    }

    $test;
    exec('java ..\java\budgetapp\Test.java', $test);

    foreach ($test as $output) {
        echo("<p>" . $output . "</p");
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Budgeting Page</title>
    <!-- <a rel = "stylesheet" href = "default.css" type = "text/css"> -->
</head>

<body>

    <form method = "POST" action = "">

        <input type = "radio" name = "type" value = "income">Income
        <input type = "radio" name = "type" value = "expense">Expense
        <br>
        $<input type = "number" name = "amount">

        <input type = "submit" value = "Submit">

    </form>

</body>

</html>