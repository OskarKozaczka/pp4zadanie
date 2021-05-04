<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css">
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

 print "<table border=1>";

 foreach($r as $row)
 {
     print "<tr>";
     $max=$row[1]+$row[2];
     $fill=ceil($row[1]/$max*100);
     $fill2=ceil($row[2]/$max*100);
     print "<td>$row[0]<td>";
     print "<div class='progress'>";
     print "<div class='progress-bar bg-success' role='progressbar' style='width: $fill%;'>$fill%</div>";
     print "<div class='progress-bar' role='progressbar' style='width: $fill2%;'>$fill2%</div>";
     print "</div>";
 }
?>
</table>

