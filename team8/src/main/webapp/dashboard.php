<?php

    session_start();

    if (!isset($_SESSION['email']))
        header("Location: login.php");

    $username = $_SESSION['username'];
    // $userID = $_SESSION['userID'];
    $email= $_SESSION['email'];

    include "backend/functions.php";
    // createUser("testUser4", "testEmail4@gmail.com", "abcd");
    // $json_decoded = json_decode(getMonthData("testEmail4@gmail.com"), true);

    // $json_decoded = array(
    //     "Income" => array("Paycheck" => 1500.00, "Side Hustle" => 200),
    //     "Expenses" => array("Car Payment" => 120, "Car Insurance" => 80, "rent" => 400),
    // );

    // include "php/getCurrentMonth.php";
    // $json_decoded = json_decode(getCurrentMonth($username));

    $json_decoded = json_decode(getMonthData($email), true);
    $totalIncome = 0;
    $totalExpenses = 0;

    if (isset($json_decoded["Income"]))
        foreach ($json_decoded["Income"] as $category => $amount)
            $totalIncome += floatval($amount);

    if (isset($json_decoded["Expenses"]))
        foreach ($json_decoded["Expenses"] as $category => $amount)
            $totalExpenses += floatval($amount);

    $netIncome = $totalIncome - $totalExpenses;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Page</title>
    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>
</head>

<body>

    <?php include 'components/app-header.html' ?>

    <main>
        <div class="dash-banner">
            <li>Month of: February</li>
            <li><?php echo $username ?></li>
        </div>

        <div class = "dashboard-grid">

            <div class = "grid-section">
                <div class = "grid-section-header">
                    <p>Month Summary</p>
                </div>
                <div class = "grid-section-body" id = "month-summary">
                    <div id = "income">
                        <h3 class="rounded-container">This is your income</h3>
                        <div class="grid-section-body" id="pie-chart">
                            <div class="x-box"></div>
                            <div class="x-box-cont">

                                <?php 

                                    if (!isset($json_decoded["Income"]) || count($json_decoded["Income"]) === 0)
                                        echo "You have no income sources.";
                                    else
                                        foreach ($json_decoded["Income"] as $category => $amount)
                                            echo "<strong>" . $category . " - $" . $amount . "</strong>";
                                ?>

                                <!-- <strong style="color: #ff264a">Utilities</strong>
                                <strong style="color: #eedc12">Rent</strong>
                                <strong style="color: #12CBC4">Eating out/social</strong>
                                <strong style="color: rgb(22, 185, 22)">Random</strong>
                                <strong style="color: rgb(126, 35, 229)">Groceries</strong>
                                <strong>Gas</strong> -->
                            </div>
                        </div>
                    </div>
                    <div id = "expenses">
                        <h3 class="rounded-container">These are your expenses.</h3>

                        <?php 

                            if (!isset($json_decoded["Expenses"]) || count($json_decoded["Expenses"]) === 0)
                                echo "You have no expenses.";
                            else
                                foreach ($json_decoded["Expenses"] as $category => $amount)
                                    echo "<strong>" . $category . " - $" . $amount . "</strong><br>";
                        ?>

                        <!-- <p>Net Income</p>
                        <div class="rounded-container" id="net-income">+ $500</div>
                        <div id="user-message">Congradulations! You saved $500 this month!</div> -->
                    </div>
                </div>
            </div>

            <div class = "grid-section">
                <div class = "grid-section-header">
                    <p>Budget Goals</p>
                </div>
                <div class = "grid-section-body" id = "budget-goals">
                    <table>
                        <tr><td>Total Income:</td><td>$<?php echo $totalIncome; ?></td></tr>
                        <tr><td>Total Expenses:</td><td>$<?php echo $totalExpenses; ?></td></tr>
                        <tr><td>Net Income:</td><td>$<?php echo $netIncome; ?></td></tr>
                    </table>

                    <!-- <div class="text-spaced-out">
                        <p>Spending Goal:</p>
                        <p>$200</p>
                    </div>
                    <div class="text-spaced-out" id="actual-spending">
                        <p>Actual Spending:</p>
                        <p>$100</p>
                    </div>
                    <div id="categories-list">
                        <ul class="category-item">
                            Utilities: $100 spent / $100
                            <div class="progress-bar">
                                <div class="progress__fill" id="utilities">
                                    <span class="progress__text"></span>
                                </div>
                            </div>
                        </ul>
                        <ul class="category-item">Rent: $500 spent / $500
                            <div class="progress-bar">
                                <div class="progress__fill"  id="rent">
                                    <span class="progress__text"></span>
                                </div>
                            </div>
                        </ul>
                        <ul class="category-item">Eating out/social: $100 spent / $150
                            <div class="progress-bar">
                                <div class="progress__fill"  id="eating-out">
                                    <span class="progress__text"></span>
                                </div>
                            </div>
                        </ul>
                        <ul class="category-item">Random: $75 spent / $100
                            <div class="progress-bar">
                                <div class="progress__fill" id="random">
                                    <span class="progress__text"></span>
                                </div>
                            </div>
                        </ul>
                        <ul class="final-category-item">Groceries: $50 spent / $200
                            <div class="progress-bar">
                                <div class="progress__fill"  id="groceries">
                                    <span class="progress__text"></span>
                                </div>
                            </div>
                        </ul>
                    </div> -->
                </div>
            </div>

            </div>
        </div>

    </main>

    <?php include 'components/app-footer.html'; ?>

</body>

</html>