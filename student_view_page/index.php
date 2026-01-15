<?php
session_start();
require_once 'includes/dbh.inc.php';
require_once 'includes/status_model.inc.php';
require_once 'includes/status_view.inc.php';

// Check if user is logged in
if (!isset($_SESSION['user_studentno']) || !isset($_SESSION['user_id'])) {
    header("Location: ../student-signup/index.php");
    exit;
}

// Get student info from session and database
$student_id = $_SESSION['user_id'];
$student = get_student_by_id($pdo, $student_id);
$applications = get_student_applications($pdo, $student_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .welcome-text {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .student-info-box {
            background-color: #f8f9fa;
            border: 2px solid #007bff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .student-info-box h3 {
            color: #007bff;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .info-row label {
            font-weight: 600;
            color: #555;
        }

        .info-row value {
            color: #333;
        }

        .status-pending {
            color: #ff9800;
            font-weight: 600;
        }

        .status-accepted {
            color: #4caf50;
            font-weight: 600;
        }

        .status-rejected {
            color: #f44336;
            font-weight: 600;
        }

        .no-applications {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #ffeaa7;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            h2 {
                font-size: 18px;
            }

            table {
                font-size: 14px;
            }

            table th, table td {
                padding: 8px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Application Status</h1>
        <p class="welcome-text">Welcome, <?= htmlspecialchars($student['firstname'] ?? 'User') ?></p>

        <?php if ($student): ?>
            <div class="student-info-box">
                <h3>Your Information</h3>
                <div class="info-row">
                    <label>Name:</label>
                    <value><?= htmlspecialchars($student['firstname'] . ' ' . $student['surname']) ?></value>
                </div>
                <div class="info-row">
                    <label>Student Number:</label>
                    <value><?= htmlspecialchars($student['student_number']) ?></value>
                </div>
            </div>
        <?php endif; ?>

        <h2>Your Applications</h2>

        <?php if (empty($applications)): ?>
            <div class="no-applications">
                <p>You have not submitted any residence applications yet.</p>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Application ID</th>
                        <th>Residence</th>
                        <th>Status</th>
                        <th>Applied Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applications as $app): ?>
                        <tr>
                            <td>#<?= htmlspecialchars($app['application_id']) ?></td>
                            <td><?= htmlspecialchars($app['residence_name']) ?></td>
                            <td>
                                <span class="status-<?= htmlspecialchars($app['status']) ?>">
                                    <?= ucfirst(htmlspecialchars($app['status'])) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars(date('M d, Y', strtotime($app['applied_at']))) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div class="action-buttons">
            <a href="../registration/index.php" class="btn btn-primary">Apply for Residence</a>
            <form action="includes/logout.inc.php" method="post" style="flex: 1;">
                <button type="submit" class="btn btn-secondary" style="width: 100%; margin: 0;">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
