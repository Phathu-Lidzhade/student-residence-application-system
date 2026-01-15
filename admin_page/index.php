<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/display_model.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Submissions page</title>
</head>
<body>

    <header class="header">
        <div class="logo">
            <h1>Admin Page</h1>
        </div>
    </header>

<div class="container">

    <h2>Records</h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Number</th>
                <th>First Name</th>
                <th>Surname</th>
                <th>Gender</th>
                <th>Created At</th>
                <th>Residence</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (!empty($rows)): ?>
            
            <?php foreach($rows as $row): ?>

                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['studentno']); ?></td>
                    <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                    <td><?php echo htmlspecialchars($row['surname']); ?></td>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td><?php echo htmlspecialchars($row['residence']); ?></td>
                </tr>

                <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">
                            No records found
                        </td>
                    </tr>
                    <?php endif; ?>

        </tbody>
    </table>
    <br>

    <form action="includes/logout.inc.php" method="post">
        <button>Logout</button>
    </form>
    </div>

</body>
</html>