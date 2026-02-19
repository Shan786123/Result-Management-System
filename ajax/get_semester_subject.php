<?php
require_once '../includess/config.php';

if(isset($_POST['semester'])) {
    $sem = $_POST['semester'];
    // Fetch subjects defined by the teacher in the exam_schedule table
    $stmt = $pdo->prepare("SELECT * FROM exam_schedule WHERE semester = ?");
    $stmt->execute([$sem]);
    $subjects = $stmt->fetchAll();

    if($subjects) {
        echo "<h5>Select Your Subjects:</h5>";
        foreach($subjects as $sub) {
            echo "<div class='form-check'>";
            echo "<input class='form-check-input' type='checkbox' name='subjects[]' value='".$sub['subject_code']."'>";
            echo "<label class='form-check-label'>".$sub['subject_code']." - ".$sub['subject_name']."</label>";
            echo "</div>";
        }
    } else {
        echo "<p class='text-danger'>No schedule found for this semester. Please contact your teacher.</p>";
    }
}
?>