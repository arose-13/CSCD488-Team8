<?php

include "functions.php";

userExists_GivenExistingUser_ReturnsTrue();
userExists_GivenNonexistentUser_ReturnsFalse();
userExists_GivenNull_ReturnsError();
userExists_GivenEmptyString_ReturnsError();
login_GivenExistingUser_ReturnsSuccess();
login_GivenNonexistentUser_ReturnsError();
login_GivenNullEmail_ReturnsError();
login_GivenNullPassword_ReturnsError();
login_GivenEmptyEmail_ReturnsError();
login_GivenEmptyPassword_ReturnsError();
login_GivenIncorrectPassword_ReturnsError();

// ---------- login Tests ---------- \\

function login_GivenExistingUser_ReturnsSuccess() {
    $result = login("testEmail4@gmail.com","abcd");
    if ($result == "Success")
        echo "login_givenExistingUser_ReturnsSuccess(): Passed<br>";
    else
        echo "login_givenExistingUser_ReturnsSuccess(): Failed<br>";
}

function login_GivenNonexistentUser_ReturnsError() {
    $result = login("doesNotExist@gmail.com","abcd");
    if ($result == "User doesn't exist!")
        echo "login_givenNonexistentUser_ReturnsError(): Passed<br>";
    else
        echo "login_givenNonexistentUser_ReturnsError(): Failed<br>";
}

function login_GivenNullEmail_ReturnsError() {
    $result = login(NULL, "abcd");
    if ($result == "Input was invalid.")
        echo "login_givenNullEmail_ReturnsError(): Passed<br>";
    else
        echo "login_givenNullEmail_ReturnsError(): Failed<br>";
}

function login_GivenNullPassword_ReturnsError() {
    $result = login("testEmail4@gmail.com", NULL);
    if ($result == "Input was invalid.")
        echo "login_givenNullPassword_ReturnsError(): Passed<br>";
    else
        echo "login_givenNullPassword_ReturnsError(): Failed<br>";
}

function login_GivenEmptyEmail_ReturnsError() {
    $result = login("", "abcd");
    if ($result == "Input was invalid.")
        echo "login_GivenEmptyEmail_ReturnsError(): Passed<br>";
    else
        echo "login_GivenEmptyEmail_ReturnsError(): Failed<br>";
}

function login_GivenEmptyPassword_ReturnsError() {
    $result = login("testEmail4@gmail.com", "");
    if ($result == "Input was invalid.")
        echo "login_GivenEmptyPassword_ReturnsError(): Passed<br>";
    else
        echo "login_GivenEmptyPassword_ReturnsError(): Failed<br>";
}

function login_GivenIncorrectPassword_ReturnsError() {
    $result = login("testEmail4@gmail.com", "wrongpassword");
    if ($result == "Incorrect password.")
        echo "login_GivenIncorrectPassword_ReturnsError(): Passed<br>";
    else
        echo "login_GivenIncorrectPassword_ReturnsError(): Failed<br>";
}

// ---------- userExists Tests ---------- \\

function userExists_GivenExistingUser_ReturnsTrue() {
    $result = userExists("testEmail4@gmail.com");
    if ($result == true)
        echo "userExists_GivenExistingUser_ReturnsTrue(): Passed<br>";
    else
        echo "userExists_GivenExistingUser_ReturnsTrue(): Failed<br>";
}

function userExists_GivenNonexistentUser_ReturnsFalse() {
    $result = userExists("doesNotExist@gmail.com");
    if ($result == false)
        echo "userExists_GivenNonexistentUser_ReturnsFalse(): Passed<br>";
    else
        echo "userExists_GivenNonexistentUser_ReturnsFalse(): Failed<br>";
}

function userExists_GivenNull_ReturnsError() {
    $result = userExists(NULL);
    if ($result == "Input was invalid.")
        echo "userExists_GivenNull_ReturnsError(): Passed<br>";
    else
        echo "userExists_GivenNull_ReturnsError(): Failed<br>";
}

function userExists_GivenEmptyString_ReturnsError() {
    $result = userExists("");
    if ($result == "Input was invalid.")
        echo "userExists_GivenEmptyString_ReturnsError(): Passed<br>";
    else
        echo "userExists_GivenEmptyString_ReturnsError(): Failed<br>";
}

?>