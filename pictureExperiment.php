<?php
//if ($_SERVER['PHP_SELF'] == '/' . basename(__FILE__))
if(!(isset($_GET['debug']) && $_GET['debug'] == 1) && !(isset($_POST['debug']) && $_POST['debug'] == 1)) // Page should only appear on certain conditions
{
  header('HTTP/1.0 404 Not Found');
  echo "
<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL " . $_SERVER['PHP_SELF'] . " was not found on this server.</p>
<p>Additionally, a 404 Not Found error was encountered while trying to use an ErrorDocument to handle the request.</p>
</body></html>
";
  exit();
}

/*ob_start();
var_dump($GLOBALS);
$output = ob_get_clean();

$outputFile = "/var/www/projectLogs/output.txt";
$fileHandle = fopen($outputFile, 'w') or die("File creation error.");
fwrite($fileHandle, $output);
fclose($fileHandle);

$outputFile = "/var/www/projectLogs/output2.txt";
$fileHandle = fopen($outputFile, 'a') or die("File creation error.");
fwrite($fileHandle, "a\n");
fclose($fileHandle);*/
?>

<html>
<head>
  <title>Picture Upload Test</title>
</head>
<body>
  <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="debug" value=1 />
    <input type="file" name="img1" />
    <input type="file" name="img2" />
    <input type="submit" />
  </form>
  <br /><br /><br />
  <pre><?php var_dump($GLOBALS); ?></pre>
</body>
</html>