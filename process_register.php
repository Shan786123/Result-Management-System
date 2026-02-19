<?php
require_once 'includess/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = $_POST['role'];

// Handle Profile Picture Upload
    $profile_pic = 'default_avatar.png';
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $target_dir = "assets/img/";
        $file_ext = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);
        $profile_pic = time() . "_" . uniqid() . "." . $file_ext; // Unique name
        move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_dir . $profile_pic);
    }

    try {
        $pdo->beginTransaction();

        // 1. Insert into core users table
        $sql = "INSERT INTO users (name, email, password, role, profile_pic) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $password, $role, $profile_pic]);
        $user_id = $pdo->lastInsertId();

        // 2. If the role is student, insert additional details 
        if ($role === 'student') {
            $enrollment_no = $_POST['enrollment_no'];
            $course = $_POST['course'];
            $semester = $_POST['semester'];

            $sql_student = "INSERT INTO students (user_id, enrollment_no, course, semester) VALUES (?, ?, ?, ?)";
            $stmt_student = $pdo->prepare($sql_student);
            $stmt_student->execute([$user_id, $enrollment_no, $course, $semester]);
        }

        $pdo->commit();
        echo "<script>alert('Registration Successful! Please Login.'); window.location='index.php';</script>";

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Registration failed: " . $e->getMessage();
    }
}
?>