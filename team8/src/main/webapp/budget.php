<?php

    /*
    $monthObject = array(
	    “Income” => array( “Paycheck” => 1400.00, “Tips” => 500.00 ),
	    “Expenses” => array( “Car Payment” => 210.00, “Utilities” => 150.00, “Rent” => 700.00, “Gas” => 60.00 ),
    );
    */

    //session_start();

    //if (!isset($_SESSION['username']))
        //header("Location: login.php");

    //$username = $_SESSION['username'];
    //$userID = $_SESSION['userID'];

    include "php/getCurrentMonth.php";

    $outBound = curl_init("localhost:8080/team8-0.1/webapi/UpdateThisMonthsJson/{uname}/{newMonthData}");
    curl_setopt($outBound, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($outBound, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($outBound, CURLOPT_POST, 1);

    $json_decoded = json_decode(getCurrentMonth($username));

    if (isset($_POST["itemSubmit"])) {

        if (isset($_POST["type"]) && isset($_POST["name"]) && isset($_POST["amount"])) {

            $choice = $_POST["type"];
            $category = $_POST["name"];
            $amount = $_POST["amount"];

            if ($choice == "income") {
                $json_decoded["Income"] += array( $category => $amount );
                $json_encoded = json_encode($json_decoded);

                $outBoundQuery = http_build_query( array('uname'=>$username, 'newMonthData'=>$json_encoded));
                curl_setopt($outBound, CURLOPT_POSTFIELDS, $outBoundQuery);
                curl_exec($outBound);
                curl_close($outBound);
            }
            else {
                $json_decoded["Expenses"] += array( $category => $amount );
                $json_encoded = json_encode($json_decoded);
                
                $outBoundQuery = http_build_query( array('uname'=>$username, 'newMonthData'=>$json_encoded));
                curl_setopt($outBound, CURLOPT_POSTFIELDS, $outBoundQuery);
                curl_exec($outBound);
                curl_close($outBound);
            }
        }
        else
            echo '<p style="color:red;">Please fill out all fields.</p>';

    }

    if (isset($_POST['itemRemove'])) {

        if (isset($_POST['incomeItems'])) {

            foreach ($_POST['incomeItems'] as $item)
                $index = array_search($item, array_keys($json_decoded["Income"]));
                    if ($index)
                        unset($json_decoded["Income"][$index]);

            curl_setopt($outBound, CURLOPT_POSTFIELDS, $json_encoded);
            curl_exec($outBound);
        }
        if (isset($_POST['expenseItems'])) {

            foreach ($_POST['expenseItems'] as $item)
                $index = array_search($item, array_keys($json_decoded["Expenses"]));
                    if ($index)
                        unset($json_decoded["Expenses"][$index]);

            curl_setopt($outBound, CURLOPT_POSTFIELDS, $json_encoded);
            curl_exec($outBound);
        }
        curl_close($outBound);
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Budgeting Page</title>
    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>
</head>

<body>

    <?php include 'components/app-header.html'; ?>

    <main>

        <form method = "POST" action = "">

            <table>
                <tr>
                    <td><input type = "radio" name = "type" value = "income">Income</td>
                    <td><input type = "radio" name = "type" value = "expense">Expense</td>
                </tr>
                <tr><td>Name:</td><td><input type = "text" name = "name"></td></tr>
                <tr><td>Amount:</td><td><input type = "number" step = "0.01" name = "amount"></td></tr>
                <tr><td colspan = "2" style = "text-align:center;">
                <button name = "itemSubmit">Submit</button>
                </td></tr>
            </table>

        </form>

        <div class = "budget-page-display">

            <form method = "POST" action = "">
            <div class = "columns">

                <div class = "budget-page-column">
                    <h2>Income</h2>
                    <div class = "budget-items">
                        <?php
                        $i = 0;
                        if (isset($json_decoded))
                            foreach ($json_decoded["Income"] as $key => $value) {
                                echo "<p>" . $key . ": " . $value . "</p>
                                <input type = 'checkbox' id = 'income" . $i . "' name = 'incomeItems[]'>";
                                $i++;
                            }
                        else
                            echo "<p>Huh, there aren't any items to display yet! Try adding one above.</p>";
                        ?>
                    </div>
                </div>

                <div class = "budget-page-column">
                    <h2>Expenses</h2>
                    <div class = "budget-items">
                    <?php
                        $i = 0;
                        if (isset($json_decoded))
                            foreach ($json_decoded["Income"] as $key => $value) {
                                echo "<p>" . $key . ": " . $value . "</p>
                                <input type = 'checkbox' id = 'expense" . $i . "' name = 'expenseItems[]'>";
                                $i++;
                            }
                        else
                            echo "<p>Huh, there aren't any items to display yet! Try adding one above.</p>";
                        ?>
                    </div>
                </div>

            </div>
            <button name = "itemRemove">Remove Items</button>
            </form>

        </div>

    </main>

    <?php include 'components/app-footer.html'; ?>

</body>

</html>