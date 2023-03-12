<?php

// All necessary functions for back-end functionality

function dbConnect() {
    $conn = mysqli_connect("localhost", "root", "")
        or die ("Could not connect to the server " . mysqli_error($conn));

    mysqli_select_db($conn, "budgetappuser")
        or die ("Could not open the database: " . mysqli_error($conn));

    return $conn;
}

function createUser($username, $email, $hash) {
    if ($username == null || $email == null || $hash == null)
        return "Input was null.";

    $conn = dbConnect();

    if (!userExists($email, $conn)) {
        $currDate = date("m-d-y");
        $monthDatas = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthData = json_encode(
                array(
                'Income' => array(),
                'Expenses' => array(),
                )
            );
            array_push($monthDatas, $monthData);
        }
        
        $query = "INSERT INTO `appusertable` ('" . $monthDatas[0] . "', '" . $monthDatas[1] . "', '" . $monthDatas[2] .
                                                "', '" . $monthDatas[3] . "', '" . $monthDatas[4] . "', '" . $monthDatas[5] .
                                                "', '" . $monthDatas[6] . "', '" . $monthDatas[7] . "', '" . $monthDatas[8] .
                                                "', '" . $monthDatas[9] . "', '" . $monthDatas[10] . "', '" . $monthDatas[11] .
                                                "', '" . $username . "', '" . $hash . "', '" . $email . "', '" . $currDate . "')";

        $result = mysqli_query($conn, $query)
            or die ("Could not execute the query to create a new user.");

        return "Success";
    }
    else
        return "User already exists!";

    mysqli_close($conn);
}

function login($email, $hash) {
    if ($email == null || $hash == null)
        return "Input was null.";

    $conn = dbConnect();

    if (userExists($email, $conn)) {
        $query = "SELECT * from 'appuserdata' where email = '" . $email .
                                                "' AND password = '" . $hash . "';";
        $result = mysqli_query($conn, $query)
            or die ("Could not execute the query in the login method.");

        if (mysqli_num_rows($result) != 1)
            return "Incorrect password";
        else
            return "Success";
    }
    else
        return "User doesn't exist!";
}

function getMonthData($email) {
    if ($email == null)
        return "Input was null.";

    $conn = dbConnect();

    $date = date('m');
    if ($date < 10)
        $month = '0' . $date;
    else
        $month = $date;
    
    $query = "SELECT 'm" . $month . "' FROM 'appusertable' WHERE email = '" . $email . "';";
    $result = mysqli_query($conn, $query)
            or die ("Could not execute the query to get the months data.");

    if ($result)
        return json_decode($result);
    else
        return "The result of the query to get the month's data was null!";
}

function updateMonthData($email, $newMonthData) {
    if ($email == null || $newMonthData == null)
        return "Input was null.";

    $conn = dbConnect();

    $date = date('m');
    if ($date < 10)
        $month = '0' . $date;
    else
        $month = $date;
    
    $query = "UPDATE 'appusertable' SET 'm" . $month . "' = '" . $newMonthData . "' WHERE email = '" . $email . "';";
    $result = mysqli_query($conn, $query)
            or die ("Could not execute the query to get the months data.");

    if ($result)
        return $result;
    else
        return "The result of the query to get the month's data was null!";
}

function userExists($email, $conn) {
    if ($email == null || $conn == null)
        return "Input was null.";

    $query = "SELECT * FROM 'appusertable' WHERE 'email' = " . $email . ";";
    $result = mysqli_query($conn, $query)
            or die ("Could not execute the query that checks for a user's existance.");
    
    if (mysqli_num_rows($result) != 1)
        return false;
    return true;
}

?>