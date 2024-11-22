<html>
<head>
<title>Database Connection from PHP</title>
</head>
<body>

<h1>Database Search</h1>

<form action="db.php" method="get">
cname<br>
<INPUT TYPE="text" NAME="cname" SIZE="50"><br>
<INPUT TYPE="submit" VALUE="SUBMIT">
<INPUT TYPE="reset" VALUE="RESET">
</form>

<?php

$server = "localhost";
$mydb = "gk9999";
$usr = "gk9999";
$pass = "gk9999";

if($_SERVER["REQUEST_METHOD"] != "POST"){
  $cname=$_GET['cname'];
  $capital=$_GET['capital'];
}else{
  $cname=$_POST['cname'];
  $capial=$_POST['capital'];
}

$link = mysql_connect($server,$usr,$pass);
if(!$link) {
  die("cannot connect:" .mysql_error());
}
$db_selected = mysql_select_db($mydb, $link);
if (!$db_selected) {
    die ('Can\'t use database:' . mysql_error());
}

$sql = "select * from country";
if ($cname != "") {
  $sql = $sql." where cname LIKE "."'%".$cname."%'";
}
echo("<h2>SQL</h2>");
echo("<pre>$sql</pre>");
$result = mysql_query($sql);
if(!$result) {
  die("empty: " . mysql_error());
}

echo("<h2>result</h2>");

echo("\n<table border=1>\n");

echo "<tr>";
$i = mysql_num_fields($result);
for ($j = 0; $j < $i; $j++) {
  $fieldname = mysql_field_name($result, $j);
  echo("<td>$fieldname</td>");
}
echo "</tr>\n";

while ($data = mysql_fetch_row($result)) {
  echo "<tr>";
  for ($j=0; $j<count($data); $j++) {
    echo "<td>$data[$j]</td>";
  }
  echo "</tr>\n";
  
}
echo("\n</table>\n");


mysql_free_result($result);
mysql_close($link);

?>

</body>
</html>

