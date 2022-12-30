<html>
<body>
<script type="text/javascript">
    function on_callPhp() {
        console.log("is this working?");
        var result = "<?php php_func();?>";
        alert(result);
        return false;
    }
</script>
<form action="" method="POST">
    <input type="button" value="Hit me" onclick="on_callPhp()" />
</form>

<?php 
    function php_func() {
        echo "Hello";
    }
?>
</body>
</html>