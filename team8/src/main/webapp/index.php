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

        <p>Welcome to the homepage!</p>

        <?php
            // Initialize the curl resource
            $resource = curl_init("localhost:8080/team8-0.1/webapi/test"); 
            // Set the option ("setopt") for the curl resource to retrieve data.
            // Otherwise, it will just return 'true' or 'false', depending on whether or not it was successful.
            curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
            // Execute the request and store it in $result
            $result = curl_exec($resource);
            // Close the resource (you want to do this as it will free system resources)
            curl_close($resource);

            if ($result)
            {
                echo $result;
            }
            else
            {
                echo "Something didn't go quite right...";
            }
        ?>
        
    </main>

    <?php include 'components/main-footer.html'; ?>

</body>

</html>