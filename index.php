<form  method="post" action='wyniki.php'>
<link rel="stylesheet" href="styles.css" type="text/css">
<div>
<h>Market Sentiment Survey</h><br><br>
<?php
require_once "../../db_connection.php";
$c=pg_connect("host=sbazy user=s214508 dbname=s214508 password=$password");
$s="select * from futures order by id";
$r=pg_exec($c,$s);
$rn=pg_numrows($r);
for ($i=0; $i<$rn; $i++)
{
    $x=pg_result($r,$i,1);
    print "<h>$x</h><br><c>UP:</c classs='c'><input type=radio value=up name=$x><c>DOWN:</c><input type=radio value=down name=$x><br>";
}

if(!isset($_COOKIE['x']))
{
    print "<input type=submit value='Show Results'>";
    setcookie('x','y');
}else{
    print "<h>Already voted!</h>";
}
?>
</div>
</form>
