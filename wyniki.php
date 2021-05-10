<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Market Sentiment Survey</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        <a class="nav-link" href="./wyniki.php">Results</a>
      </div>
    </div>
  </div>
</nav>


<?php
 require_once "../../db_connection.php";

 $c=pg_connect("host=sbazy user=s214508 dbname=s214508 password=$password");
 $s="select * from futures order by id";
 $r=pg_exec($c,$s);
 $rn=pg_numrows($r);
 $c = new PDO($db_pg, $user, $password);

$tab=[Gold,Tesla,Etherum,Silver,Bitcoin,Apple];
 for ($i=0; $i<$rn; $i++)
 {
    if ($_POST[$tab[$i]]=='up') $s = "update futures set upvotes=upvotes+1 where name='$tab[$i]'";
    if ($_POST[$tab[$i]]=='down') $s = "update futures set downvotes=downvotes+1 where name='$tab[$i]'";
    $r=$c->prepare("$s");
    $r->execute();
 }

 $s="select name,upvotes,downvotes from futures order by id";
 $r=$c->prepare("$s");
 $r->execute();
 $cn=$r->columnCount();
 print "<table>";
 foreach($r as $row)
 {
     print "<tr>";
     $max=$row[1]+$row[2];
     $fill=ceil($row[1]/$max*100);
     $fill2=ceil($row[2]/$max*100);
     print "<td><h>$row[0]</h><td>";
     echo "<span>";
     print "<div class='progress'>";
     print "<div class='progress-bar-green' role='progressbar' style='width: $fill%;'>$fill%</div>";
     print "<div class='progress-bar-red' role='progressbar' style='width: $fill2%;'>$fill2%</div>";
     print "</div>";
     echo "</span>";
 }
?>
</table>

