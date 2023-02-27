<?php

    //session_start();

    //if (!isset($_SESSION['username']))
        //header("Location: login.php");

    //$username = $_SESSION['username'];
    //$userID = $_SESSION['userID'];

    // Logic for updating the database
    if (isset($_POST['submit'])) {

        $choice = $_POST['type'];
        $category = $_POST['category'];
        $amount = $_POST['amount'];

        if ($choice == "income") {
            ;// UPDATE [tablename] SET income = $amount WHERE userID = $_SESSION['userID'];
        }
        else {
            ;// UPDATE [tablename] SET expense = $amount WHERE userID = $_SESSION['userID'];
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
                <tr><td>Category:</td><td><input type = "text" name = "category"></td></tr>
                <tr><td>Amount:</td><td><input type = "number" name = "amount"></td></tr>
                <tr><td colspan = "2" style = "text-align:center;">
                <button name = "submit">Submit</button>
                </td></tr>
            </table>

        </form>

        <div class = "budget-page-display">

            <div class = "columns">

                <div class = "budget-page-column">
                    <h2>Income</h2>
                    <p>Data 1</p>
                    <p>Data 2</p>
                    <p>Data 3</p>
                </div>

                <div class = "budget-page-column">
                    <h2>Expenses</h2>
                    <p>Data 1</p>
                    <p>Data 2</p>
                    <p>Data 3</p>
                </div>

            </div>

        </div>

    </main>

    <?php include 'components/app-footer.html'; ?>

</body>

</html>