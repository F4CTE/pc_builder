<?php
session_start();

$_SESSION = array();

session_destroy();
?>
<html>

<body>
    <h1>You have been successfully disconnected. You will be redirected in 5 seconds.</h1>
</body>

</html>";
<?php
header("refresh:5; url=index.php");
exit();
?>