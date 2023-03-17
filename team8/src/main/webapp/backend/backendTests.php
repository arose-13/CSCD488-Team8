<?php

include "functions.php";

createUser_GivenValidInput_ReturnsSuccess();
createUser_GivenExistingUser_ReturnsError();
createUser_GivenNullUsername_ReturnsError();
createUser_GivenNullEmail_ReturnsError();
createUser_GivenNullPassword_ReturnsError();
createUser_GivenEmptyUsername_ReturnsError();
createUser_GivenEmptyEmail_ReturnsError();
createUser_GivenEmptyPassword_ReturnsError();
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
deleteUser_GivenExistingUser_ReturnsSuccess();
deleteUser_GivenNonexistentUser_ReturnsError();
deleteUser_GivenNullEmail_ReturnsError();
deleteUser_GivenEmptyEmail_ReturnsError();

// ---------- createUser Tests ---------- \\

function createUser_GivenValidInput_ReturnsSuccess() {
    $result = createUser("testUsername", "testEmail@test.com", "testPassword");
    if ($result == "Success")
        echo "createUser_GivenValidInput_ReturnsSuccess(): Passed<br>";
    else
        echo "createUser_GivenValidInput_ReturnsSuccess(): Failed<br>";
    deleteUser("testEmail@test.com");
}

function createUser_GivenExistingUser_ReturnsError() {
    createUser("testUsername", "testEmail@test.com", "testPassword");
    $result = createUser("testUsername", "testEmail@test.com", "testPassword");
    if ($result == "User already exists.")
        echo "createUser_GivenExistingUser_ReturnsError(): Passed<br>";
    else
        echo "createUser_GivenExistingUser_ReturnsError(): Failed<br>";
}

function createUser_GivenNullUsername_ReturnsError() {
    $result = createUser(NULL, "testEmail@test.com", "testPassword");
    if ($result == "Input was invalid.")
        echo "createUser_GivenNullUsername_ReturnsError(): Passed<br>";
    else
        echo "createUser_GivenNullUsername_ReturnsError(): Failed<br>";
}

function createUser_GivenNullEmail_ReturnsError() {
    $result = createUser("testUsername", NULL, "testPassword");
    if ($result == "Input was invalid.")
        echo "createUser_GivenNullEmail_ReturnsError(): Passed<br>";
    else
        echo "createUser_GivenNullEmail_ReturnsError(): Failed<br>";
}

function createUser_GivenNullPassword_ReturnsError() {
    $result = createUser("testUsername", "testEmail@test.com", NULL);
    if ($result == "Input was invalid.")
        echo "createUser_GivenNullPassword_ReturnsError(): Passed<br>";
    else
        echo "createUser_GivenNullPassword_ReturnsError(): Failed<br>";
}

function createUser_GivenEmptyUsername_ReturnsError() {
    $result = createUser("", "testEmail@test.com", "testPassword");
    if ($result == "Input was invalid.")
        echo "createUser_GivenEmptyUsername_ReturnsError(): Passed<br>";
    else
        echo "createUser_GivenEmptyUsername_ReturnsError(): Failed<br>";
}

function createUser_GivenEmptyEmail_ReturnsError() {
    $result = createUser("testUsername", "", "testPassword");
    if ($result == "Input was invalid.")
        echo "createUser_GivenEmptyEmail_ReturnsError(): Passed<br>";
    else
        echo "createUser_GivenEmptyEmail_ReturnsError(): Failed<br>";
}

function createUser_GivenEmptyPassword_ReturnsError() {
    $result = createUser("testUsername", "testEmail@test.com", "");
    if ($result == "Input was invalid.")
        echo "createUser_GivenEmptyPassword_ReturnsError(): Passed<br>";
    else
        echo "createUser_GivenEmptyPassword_ReturnsError(): Failed<br>";
}

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

// ---------- deleteUser Tests ---------- \\

function deleteUser_GivenExistingUser_ReturnsSuccess() {
    createUser("testUsername", "testEmail@test.com", "testPassword");
    $result = deleteUser("testEmail@test.com");
    if ($result == "Success")
        echo "deleteUser_GivenExistingUser_ReturnsSuccess(): Passed<br>";
    else
        echo "deleteUser_GivenExistingUser_ReturnsSuccess(): Failed<br>";
}

function deleteUser_GivenNonexistentUser_ReturnsError() {
    $result = deleteUser("doesNotExist@test.com");
    if ($result == "User doesn't exist!")
        echo "deleteUser_GivenNonexistentUser_ReturnsError(): Passed<br>";
    else
        echo "deleteUser_GivenNonexistentUser_ReturnsError(): Failed<br>";
}

function deleteUser_GivenNullEmail_ReturnsError() {
    $result = deleteUser(NULL);
    if ($result == "Input was invalid.")
        echo "deleteUser_GivenNullEmail_ReturnsError(): Passed<br>";
    else
        echo "deleteUser_GivenNullEmail_ReturnsError(): Failed<br>";
}

function deleteUser_GivenEmptyEmail_ReturnsError() {
    $result = deleteUser("");
    if ($result == "Input was invalid.")
        echo "deleteUser_GivenEmptyEmail_ReturnsError(): Passed<br>";
    else
        echo "deleteUser_GivenEmptyEmail_ReturnsError(): Failed<br>";
}

?>