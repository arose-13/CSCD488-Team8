<?php

function usernameRegex(string $username) {
    $regex = '[^a-zA-Z0-9]';
    if (preg_match($regex, $username) == 1)
        return false;
        
    return true;
}

// DON'T USE THIS
// Passwords shoud never be assigned to a variable. Refer to this to know how to hash passwords.
// function passwordHash(string $password) {
//     $hash = password_hash($password, PASSWORD_DEFAULT);
//     return $hash;
// }

?>