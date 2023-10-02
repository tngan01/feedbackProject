<?php
require 'components/header.php';
echo "<h1>List of feedbacks here</h1>";
$sql = "SELECT name, email, body from feedback;";
if ($connection != null) {
    try {
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
        $feedbacks = $statement->fetchAll();
        foreach ($feedbacks as $feedback) {
            $name = $feedback['name'] ?? '';
            $email = $feedback['email'] ?? '';
            $body = $feedback['body'] ?? '';
            echo "$name, $email, $body<br>";
        }
    } catch (PDOException $e) {
        echo "Canot query data. Error: " . $e->getMessage();
    }
}
include 'components/footer.php';
// PDO: PHP Data Objects