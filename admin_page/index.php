<?php
session_start();
require_once 'includes/dbh.inc.php';
require_once 'includes/admin_model.inc.php';
require_once 'includes/admin_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Review Applications</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header class="header">
    <h1>Admin Page</h1>
</header>

<div class="container">
    <h2>Student Applications</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Application ID</th>
                <th>Student Number</th>
                <th>Student Name</th>
                <th>Residence</th>
                <th>Status</th>
                <th>Applied At</th>
                <th>Change Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $applications = get_all_applications($pdo);

            if ($applications):
                foreach ($applications as $app):
            ?>
            <tr>
                <td><?= $app['application_id'] ?></td>
                <td><?= htmlspecialchars($app['student_number']) ?></td>
                <td><?= htmlspecialchars($app['full_name']) ?></td>
                <td><?= htmlspecialchars($app['residence_name']) ?></td>
                <td><?= ucfirst($app['status']) ?></td>
                <td><?= $app['created_at'] ?></td>
                <td>
                    <form action="includes/admin_update_status.inc.php" method="post">
                        <input type="hidden" name="application_id" value="<?= $app['application_id'] ?>">
                        <select name="new_status" required>
                            <option value="">--Select--</option>
                            <option value="pending">Pending</option>
                            <option value="accepted">Accepted</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
            <?php
                endforeach;
            else:
            ?>
            <tr>
                <td colspan="7">No applications found</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div style="margin-top: 30px;">
        <form action="includes/logout.inc.php" method="post">
            <button type="submit" class="btn">Logout</button>
        </form>
    </div>
</div>

</body>
</html>
