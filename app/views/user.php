<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>
<body>
    <h1>Welcome Rhendel's Users</h1>
    <table border="1" cellpadding = "8" cellspacing="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Hobby</th>
</tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?=$user['id'] ?></td>
                    <td><?=$user['First name'] ?></td>
                    <td><?=$user['Last name'] ?></td>
                    <td><?=$user['Hobby'] ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
    </table>
</body>
</html>