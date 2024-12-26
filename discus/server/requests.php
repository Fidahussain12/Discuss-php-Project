<?php
session_start();
include("../client/common/db.php"); // Ensure the path to db.php is correct and db.php exists

// Verify the database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password
    $address = $_POST['address'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO `users` (`username`, `email`, `password`, `address`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $address);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION["user"] = [
            "username" => $username,
            "email" => $email,
            "user_id" => $stmt->insert_id
        ];
        header("Location: /discuss");
        exit;
    } else {
        echo "New user not registered: " . $stmt->error;
    }
    $stmt->close();

} elseif (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statements to fetch user data securely
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION["user"] = [
                "username" => $user['username'],
                "email" => $user['email'],
                "user_id" => $user['id']
            ];
            header("Location: /discus");
            exit;
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "User not found.";
    }
    $stmt->close();

} elseif (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: /discus");
    exit;

} elseif (isset($_POST["ask"])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = intval($_POST['category']); // Ensure it's an integer
    $user_id = $_SESSION['user']['user_id'];

    // Insert question securely
    $stmt = $conn->prepare("INSERT INTO `questions` (`title`, `description`, `category_id`, `user_id`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $title, $description, $category_id, $user_id);
    $result = $stmt->execute();

    if ($result) {
        header("Location: /discus");
        exit;
    } else {
        echo "Failed to add question: " . $stmt->error;
    }
    $stmt->close();

}  

else if (isset($_POST["answer"])) {
    $answer = $_POST['answer'];
    $question_id = $_POST['question_id'];
    $user_id = $_SESSION['user']['user_id'];

    $query = $conn->prepare("INSERT INTO `answer`
(`id`,`answer`,`question_id`,`user_id`)
VALUES(NULL,'$answer','$question_id','$user_id');
");

    $result = $query->execute();
    if ($result) {
        header("location: /discus?q-id=$question_id");
    } else {
        echo "Answer is not submitted";
    }
}



 elseif (isset($_GET["delete"])) {
    $qid = intval($_GET["delete"]); // Sanitize input

    // Delete question securely
    $stmt = $conn->prepare("DELETE FROM `questions` WHERE `id` = ?");
    $stmt->bind_param("i", $qid);
    $result = $stmt->execute();

    if ($result) {
        header("Location: /discus");
        exit;
    } else {
        echo "Failed to delete question: " . $stmt->error;
    }
    $stmt->close();
}
?>
