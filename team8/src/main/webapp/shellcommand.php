<?php 

$email = $_POST['email'];

shell_exec("javac ..\java\budgetapp\JavaMail.java");
//shell_exec("java ..\java\budgetapp\JavaMail.java");

echo $email;
?>