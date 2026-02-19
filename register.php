<?php require_once 'includess/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Result Management System</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>

<div class="register-container">
    <h2>Create Account</h2>
    <p>Register to access Result Management System</p>

    <form action="process_register.php" method="POST" enctype="multipart/form-data">

  
        <div class="input-group">
            <label>Full Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Profile Picture</label>
            <input type="file" name="profile_pic" accept="image/*">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="input-group">
            <label>Role</label>
            <select name="role" id="role" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <!-- Student Extra Fields -->
        <div id="studentFields" style="display:none;">
            <div class="input-group">
                <label>Enrollment Number</label>
                <input type="text" name="enrollment_no">
            </div>

            <div class="input-group">
                <label>Course</label>
                <input type="text" name="course">
            </div>

            <div class="input-group">
                <label>Semester</label>
                <input type="number" name="semester">
            </div>
        </div>

        <button type="submit" class="btn">Register</button>

        <div class="links">
            <a href="index.php">Already have an account? Login</a>
        </div>
    </form>
</div>

<script>
document.getElementById('role').addEventListener('change', function () {
    document.getElementById('studentFields').style.display =
        this.value === 'student' ? 'block' : 'none';
});
</script>

</body>
</html>
