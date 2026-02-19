<?php 
require_once '../includess/config.php'; 
$student_id = $_SESSION['user_id'];

/* Fetch available semesters */
$sem_stmt = $pdo->prepare(
    "SELECT DISTINCT semester FROM marks 
     WHERE student_id = ? ORDER BY semester ASC"
);
$sem_stmt->execute([$student_id]);
$semesters = $sem_stmt->fetchAll(PDO::FETCH_COLUMN);

$selected_semester = $_GET['semester'] ?? ($semesters[0] ?? null);

/* Student info */
$stud_stmt = $pdo->prepare(
    "SELECT u.name, s.enrollment_no, s.course 
     FROM users u 
     JOIN students s ON u.id = s.user_id 
     WHERE u.id = ?"
);
$stud_stmt->execute([$student_id]);
$student_info = $stud_stmt->fetch();

/* Marks */
$marks = [];
if ($selected_semester) {
    $marks_stmt = $pdo->prepare(
        "SELECT * FROM marks 
         WHERE student_id = ? AND semester = ?"
    );
    $marks_stmt->execute([$student_id, $selected_semester]);
    $marks = $marks_stmt->fetchAll();
}

/* Grade points */
function getGradePoints($score) {
    if ($score >= 90) return 10;
    if ($score >= 80) return 9;
    if ($score >= 70) return 8;
    if ($score >= 60) return 7;
    if ($score >= 50) return 6;
    if ($score >= 40) return 5;
    return 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Marksheet | Student</title>

    <!-- 🔹 DIFFERENT CSS FOLDER -->
    <link rel="stylesheet" href="../assets/css/result.css">
    <link rel="stylesheet" href="image.css">
</head>
<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="user-profile">
            <img src="../assets/img/<?php echo $_SESSION['profile_pic']; ?>" alt="Profile">
        </div>
        <h2>Student Panel</h2>
        <ul>
            <li><a href="../student/dashboard.php">🏠 Dashboard</a></li>
            <li><a href="view_profile.php">👤 My Profile</a></li>
            <li><a href="fill_form.php">📝 Exam Form</a></li>
            <li><a href="view_results.php" class="active">📄 Marksheet</a></li>
            <li class="logout"><a href="../logout.php">🚪 Logout</a></li>
        </ul>
    </aside>

    <!-- CONTENT -->
    <main class="content">

        <div class="marksheet-card">

            <h2>Academic Marksheet</h2>

            <!-- Semester Selector -->
            <form method="GET" class="semester-form">
                <select name="semester" onchange="this.form.submit()">
                    <?php foreach($semesters as $s): ?>
                        <option value="<?= $s ?>" <?= ($s == $selected_semester) ? 'selected' : '' ?>>
                            Semester <?= $s ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <!-- Printable Marksheet -->
            <div id="marksheet-printable">

                <h3 class="center">RESULT MANAGEMENT SYSTEM</h3>
                <h3 class="center">SEMESTER-<?php echo htmlspecialchars($selected_semester); ?> EXAMINATION <?php echo date('Y'); ?></h3>

                <div class="user-profile">
                <img src="../assets/img/<?php echo $_SESSION['profile_pic']; ?>" alt="Profile">
                </div>

                

                <div class="student-info">
                    <p><strong>Name:</strong> <?= htmlspecialchars($student_info['name']) ?></p>
                    <p><strong>Enrollment No:</strong> <?= htmlspecialchars($student_info['enrollment_no']) ?></p>
                    <p><strong>Course:</strong> <?= htmlspecialchars($student_info['course']) ?></p>
                </div>

                <table class="marks-table">
                    <thead>
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Credits</th>
                            <th>Marks</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_credits = 0; 
                        $weighted_points = 0;

                        foreach($marks as $m): 
                            $gp = getGradePoints($m['marks_obtained']);
                            $total_credits += $m['credits'];
                            $weighted_points += ($gp * $m['credits']);
                        ?>
                        <tr>
                            <td><?= $m['subject_code'] ?></td>
                            <td><?= $m['subject_name'] ?></td>
                            <td><?= $m['credits'] ?></td>
                            <td><?= $m['marks_obtained'] ?></td>
                            <td><?= ($m['marks_obtained'] >= 40) ? 'Pass' : 'Fail' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="sgpa">
                    <strong>SGPA:</strong>
                    <?= ($total_credits > 0) 
                        ? number_format($weighted_points / $total_credits, 2) 
                        : "0.00"; ?>
                </div>

                 <div class="remarks-section">
                    
                    <p><small>Note: N denotes not appeared or absent. U denotes "Unfair means"</small></p>
                </div>

                <div class="footer-section">
            
                    <div style="text-align: center;"><p><strong>ASSTT CONTROLLER OF EXAMINATIONS</strong></p></div>
                    <div style="text-align: center;"><p><strong>................................</strong></p></div>

                    <div style="text-align: right;"><p><strong>Date of Result:</strong> <?php echo date('d-m-Y'); ?></p></div>
                    <div style="text-align: left;"><p><strong>Date of Issue:</strong> <?php echo date('d-m-Y'); ?></p></div>
                    </div>
                </div>


            </div>

            <button onclick="window.print()" class="print-btn">
                🖨 Print Marksheet
            </button>

        </div>

    </main>

</div>

</body>
</html>