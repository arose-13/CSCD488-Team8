<?php

function usernameRegex(string $username) {
    $regex = '[^a-zA-Z0-9]';
    if (preg_match($regex, $username) == 1)
        return false;
        
    return true;
}

function passwordHash(string $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    return $hash;
}

?>