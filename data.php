<?php
/**
 * Created by PhpStorm.
 * User: nabaz
 * Date: 05-12-2017
 * Time: 08:55
 */
if ($_POST["Username"]!= "admin" || $_POST["Password"]!= "1234"){

    ?>
    Username or password is incorrect try again
    <button onclick="window.history.back()">Try again</button>
<?php
    exit();
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "exdb";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$select = "SELECT ORD_NUM, ORD_AMOUNT, ORD_DATE, ORD_DESCRIPTION, AGENT_NAME, CUST_NAME from orders
  LEFT JOIN agents ON orders.AGENT_CODE = agents.AGENT_CODE
LEFT JOIN customer ON orders.CUST_CODE = customer.CUST_CODE";

$result = $conn->prepare($select);
$result->execute();
$result = $result->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>
<head>
    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <script src="sortable.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>

<table class="table sortable" id="orderTable">
    <thead>
    <tr>
        <th>Ordre ID</th>
        <th>Ordredato</th>
        <th>Ordre beskrivelse</th>
        <th>Ordrebeløb</th>
        <th>Agent</th>
        <th>Kunde</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($result as $row) :?>
    <tr>
        <td><?= $row['ORD_NUM'] ?></td>
        <td><?= $row['ORD_DATE'] ?></td>
        <td><?= $row['ORD_DESCRIPTION'] ?></td>
        <td><?= $row['ORD_AMOUNT'] ?></td>
        <td><?= $row['AGENT_NAME'] ?></td>
        <td><?= $row['CUST_NAME'] ?></td>
    </tr>

    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
