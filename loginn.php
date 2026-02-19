<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginn.css">
</head>

<body>
    <div>
        <h2>login panel</h2>
        <p>centralised web module </p>

        <form action="login.php" method="post">
            <div class="class">
                <label>Name</label>
                <input type="text" class="name" name="name" required>


            </div>
            <div class="email">
                <label >email</label>
                <input type="email" class="email" name="email" required>
            </div>
            <div class="password">
                <label>password</label>
                <input type="password" class="password">
            </div>

            <button type="submit">submit</button>

            

        
        </form>

    

    </div>

</body>
</html>