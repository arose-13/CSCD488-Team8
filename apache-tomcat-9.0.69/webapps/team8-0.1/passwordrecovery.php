<!DOCTYPE html>
<head>

    <script src="../js/passwordrecovery.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>

</head>
<body>

    <?php include 'components/main-header.html'; ?>

    <main>
        <h1>Forgot Password? (HTML folder)</h1>
        <form id="passwordRecovery">
            <label for="email">Enter email: </label>
            <input type="text" id="recoveryEmail" name="recoveryEmail">
            <input type="submit" name="recoverPassword">
        </form>
    </main>

    <?php include 'components/main-footer.html'; ?>

</body>