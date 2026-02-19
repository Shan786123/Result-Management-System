<?php require_once '../includess/config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard | RMS</title>
    <link rel="stylesheet" href="studash.css">
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
            <li><a href="view_profile.php">👤 My Personal Data</a></li>
            <li><a href="fill_form.php">📝 Fill Exam Form</a></li>
            <li><a href="view_results.php">📄 View Marksheet</a></li>
            <li class="logout"><a href="../logout.php">🚪 Logout</a></li>
        </ul>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="content">
        <h1>Welcome <?= htmlspecialchars($_SESSION['name']); ?> 👋</h1>

        
        <p>Select an option from the sidebar to continue.</p>
    </main>

</div>

</body>
</html>