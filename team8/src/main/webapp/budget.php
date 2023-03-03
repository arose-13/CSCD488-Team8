<?php

    //session_start();

    //if (!isset($_SESSION['username']))
        //header("Location: login.php");

    //$username = $_SESSION['username'];
    //$userID = $_SESSION['userID'];

    // Logic for updating the database
    if (isset($_POST['itemSubmit'])) {

        if (isset($_POST['type']) && isset($_POST['name']) && isset($_POST['amount'])) {

            $choice = $_POST['type'];
            $category = $_POST['name'];
            $amount = $_POST['amount'];

            if ($choice == "income") {
                ;// UPDATE [tablename] SET income = $amount WHERE userID = $_SESSION['userID'];
            }
            else {
                ;// UPDATE [tablename] SET expense = $amount WHERE userID = $_SESSION['userID'];
            }
        }
        else
            echo '<p style="color:red;">Please fill out all fields.</p>';

    }

    if (isset($_POST['itemRemove'])) {

        if (isset($_POST['incomeItems'])) {

        }
        if (isset($_POST['expenseItems'])) {

        }

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
                        <p>Data 1</p><input type = "checkbox" id = "income1" name = "incomeItems[]">
                        <p>Data 2</p><input type = "checkbox" id = "income2" name = "incomeItems[]">
                        <p>Data 3</p><input type = "checkbox" id = "income3" name = "incomeItems[]">
                    </div>
                </div>

                <div class = "budget-page-column">
                    <h2>Expenses</h2>
                    <div class = "budget-items">
                        <p>Data 1</p><input type = "checkbox" id = "expense1" name = "expenseItems[]">
                        <p>Data 2</p><input type = "checkbox" id = "expense2" name = "expenseItems[]">
                        <p>Data 3</p><input type = "checkbox" id = "expense3" name = "expenseItems[]">
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