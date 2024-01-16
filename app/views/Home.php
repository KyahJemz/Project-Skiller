<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Welcome to the Home Page</h1>
    
    <?php foreach ($data as $user): ?>
        <p><?= $user['username']; ?></p>
    <?php endforeach; ?>
</body>
</html>