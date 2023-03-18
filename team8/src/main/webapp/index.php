<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <link rel = "stylesheet" href = "css/default.css" type = "text/css">
    <?php include 'components/head.html'; ?>
</head>

<body>

    <?php include 'components/main-header.html'; ?>

    <main>

        <div class = "full-screen-section">
            <h1>Welcome to Team 8's Final Project!</h1>
            <p>Creators: Nathan Nelson, Ray Vernon, Nathan Graham, Alan Rose</p>
        </div>

        <div class = "split-screen-section">
            <div class = "left" style = "color:white;background-color:rgb(255, 186, 49);">
                <h2>Simple budgeting, done securely, done <b>your</b> way</h2>
            </div>
            <div class = "right" style = "color:rgb(255, 186, 49);background-color:white;">
                <h3>The best way to protect your personal information is to not have it
                    in the first place. Because of this, our budgeting app does not
                    connect to any bank accounts.
                </h3>
            </div>
        </div>

        <div class = "split-screen-section">
            <div class = "left" style = "color:rgb(255, 186, 49);background-color:white;">
                <h3>
                    Make a budget without worrying about your personal information
                    being exposed to bad actors.
                </h3>
            </div>
            <div class = "right" style = "color:white;background-color:rgb(255, 186, 49);">
                <h2>
                    <a href = "signup.php" style = "color:white;">Sign up now!</a>
                </h2>
            </div>
        </div>
        
    </main>

    <?php include 'components/main-footer.html'; ?>

</body>

</html>