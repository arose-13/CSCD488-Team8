<?php

    // session_start();

    // if (!isset($_SESSION['username']))
    //     header("Location: login.php");

    $username;
    $fname;
    $income = array();
    $expenses = array();

    // Get user's actual name from db to display it.
    // exec('[path] getUsername ' . $username, $fname);

    // Get user's income sources from db to display.
    // exec('[path] getIncome ' . $username, $income);

    // Get user's expenses from db to display.
    // exec('[path] getExpenses ' . $username, $expenses);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Page</title>
    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
</head>

<body>

    <?php include 'components/header.html' ?>

    <main>

        <h1>Welcome<?php $fname ?></h1>

        <!-- Display income -->
        <?php
            // foreach ($income as $source) {
            //     echo($source);
            // }
        ?>

        <!-- Display expenses -->
        <?php
            // foreach ($expenses as $expense) {
            //     echo($expense);
            // }
        ?>

    </main>

    <?php include 'components/footer.html'; ?>

</body>

</html>