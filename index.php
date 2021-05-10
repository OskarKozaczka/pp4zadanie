<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Market Sentiment Survey</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="./wyniki.php">Results</a>
      </div>
    </div>
  </div>
</nav>
<form  method="post" action='wyniki.php'>

<div class="cover-container d-flex h-100 p-5 mx-auto flex-column">

<?php
require_once "../../db_connection.php";
$c=pg_connect("host=sbazy user=s214508 dbname=s214508 password=$password");
$s="select * from futures order by id";
$r=pg_exec($c,$s);
$rn=pg_numrows($r);
for ($i=0; $i<$rn; $i++)
{
{
    $x=pg_result($r,$i,1);
    echo "<div>";
    print "<h>$x</h>";
    echo "<input type='radio' class='btn-check' name=$x value=up id=$x+1>";
    echo "<label class='btn btn-outline-success' for=$x+1>Up</label>";
    echo "<input type='radio' class='btn-check' name=$x value=down id=$x+2>";
    echo "<label class='btn btn-outline-danger' for=$x+2>Down</label>";
    echo "</div>";
}


if(!isset($_COOKIE['x']))
{
    print "<input type=submit value='Show Results'>";
    setcookie('x','y');
}else{
    print "<h>Already voted!</h>";
}

?>

<input type=submit value='Show Results'>
</div>
</form>