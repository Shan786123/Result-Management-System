<?php
require_once '../includess/config.php';

// Security check: ensure only students can submit
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_SESSION['user_id'];
    $semester = $_POST['semester'];
    
    // Check if subjects were selected
    if (isset($_POST['subjects']) && is_array($_POST['subjects'])) {
        $subjects_list = implode(", ", $_POST['subjects']);

        try {
            // Check for duplicate submissions for the same semester
            $check = $pdo->prepare("SELECT id FROM exam_forms WHERE student_id = ? AND semester = ?");
            $check->execute([$student_id, $semester]);

            if ($check->fetch()) {
                // Fixed redirect to fill_form.php
                echo "<script>alert('Error: You have already submitted a form for Semester $semester.'); window.location='fill_form.php';</script>";
            } else {
                // Insert the form data into the database
                $sql = "INSERT INTO exam_forms (student_id, semester, subjects) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                
                if ($stmt->execute([$student_id, $semester, $subjects_list])) {
                    echo "<script>alert('Success: Examination form submitted!'); window.location='dashboard.php';</script>";
                } else {
                    echo "<script>alert('Error: Failed to save the form.'); window.location='fill_form.php';</script>";
                }
            }
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Error: Please select at least one subject.'); window.location='fill_form.php';</script>";
    }
}
?>