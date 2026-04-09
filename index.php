<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>


<?php 

$dsn = "mysql:host=localhost;dbname=tasks;charset=utf8";
$username = "root";
$pass = "";

try {
    $pdo = new PDO($dsn, $username, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_GET['delete'])) {
        $delete = (int)$_GET['delete'];
        $destroy = "DELETE FROM targets WHERE `targets`.`id` = ?";
        $sql_del = $pdo->prepare($destroy);
        $sql_del->execute([$delete]);
        header("Location: index.php");
        exit();
    }

   
    if(isset($_POST["click"])) {
        $message = $_POST["message"];
        $priority = $_POST["options"];
        $pre = "INSERT INTO `targets` (`mission`, `priority`) VALUES (?, ?)";
        $sql_send = $pdo->prepare($pre);
        $sql_send->execute([$message, $priority]);
        header("Location: index.php");    
        exit();
    }
 
}

catch (PDOException $e) {
    echo "Error - ". $e->getMessage();  
}

?>

<table border="4">
    <tr>
    <th>Mission</th>
    <th>Priority</th>
    <th>Action</th>
    </tr>
<?php



$query = $pdo->query("SELECT * FROM `targets` ORDER BY FIELD(priority, 'High', 'Medium', 'Low'), id DESC");

while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $color = '';
    
    if ($row['priority'] == 'High') $color = 'style="color: red; font-weight: bold; font-style:italic;"';
    if ($row['priority'] == 'Medium') $color = 'style="color: orange; font-style:italic;"';
    if ($row['priority'] == 'Low') $color = 'style="color: green; font-style:italic;"';

    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['mission']) . "</td>";
    echo "<td $color>" . htmlspecialchars($row['priority']) . "</td>";
    echo "<td><a href='index.php?delete=" . $row['id'] . "'>Delete</a></td>";
    echo "</tr>";

}

?>
</table>

<hr>
<form action="" method="POST">
    <select name="options">
        <option value="High">High</option>
        <option value="Medium">Medium</option>
        <option value="Low">Low</option>
   </select>
    <input type="text" name="message">
    <p>
    <input type="submit" name="click" value="Send">
    </p>
</form>