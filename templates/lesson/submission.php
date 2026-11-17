

<?php

$answer_text = filter_input(INPUT_POST, 'answers', FILTER_SANITIZE_STRING);
$user_id = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
$assignment_id = filter_input(INPUT_POST, 'opdracht', FILTER_SANITIZE_STRING);
$answer_option_id = filter_input(INPUT_POST, 'opties', FILTER_SANITIZE_STRING);
$lesson_id = filter_input(INPUT_POST, 'les', FILTER_SANITIZE_STRING);


$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="westtalent";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO submission (answerText, user_id, assignment_id, answer_option_id, lesson_id) VALUES (?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die('Prepare failed:' . $conn->error);
    }
}   $stmt->bind_param("sssss", $answer_text, $user_id, $assignment_id, $answer_option_id, $lesson_id);

    if ($stmt->execute()) {
        echo "De opdracht is verstuurd";
    } else {
        echo "Error; " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
?>
