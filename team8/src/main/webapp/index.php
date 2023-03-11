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
        $resource = curl_init("localhost:8080/team8-0.1/webapi/test/return-test"); 
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($resource, CURLOPT_POST, 1);

        $outBoundQuery = http_build_query(array("data" => "Hello World!"));
        curl_setopt($resource, CURLOPT_POSTFIELDS, $outBoundQuery);

        $result = curl_exec($resource);
        curl_close($resource);

        if ($result)
        {
            echo $result;
        }
        else
        {
            echo "'result' variable is null!";
        }
        ?>
        
    </main>

    <?php include 'components/main-footer.html'; ?>

</body>

</html>