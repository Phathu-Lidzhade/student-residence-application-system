<?php
session_start();
require_once 'includes/dbh.inc.php';
require_once 'includes/register_model.inc.php';

// Check if user is logged in
if (!isset($_SESSION['user_studentno']) || !isset($_SESSION['user_id'])) {
    header("Location: ../student-signup/index.php");
    exit;
}

$errors = $_SESSION['errors_signup'] ?? [];
unset($_SESSION['errors_signup']);

$student = get_student_info($pdo, $_SESSION['user_studentno']);
$residences = get_residences($pdo);
$success = isset($_GET['register']) && $_GET['register'] === 'success';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Residence Application</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
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

        form {
            display: flex;
            flex-direction: column;
        }

        fieldset {
            border: none;
            padding: 0;
            margin-bottom: 20px;
        }

        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background-color: white;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        button, a.back-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        a.back-btn {
            background-color: #6c757d;
            color: white;
        }

        a.back-btn:hover {
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

            .button-group {
                flex-direction: column;
            }

            button, a.back-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Residence Application</h1>

        <?php if ($success): ?>
            <div class="success-message">
                ✓ Your application has been submitted successfully!
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($student): ?>
            <div class="student-info-box">
                <h3>Your Information</h3>
                <div class="info-row">
                    <label>Name:</label>
                    <value><?= htmlspecialchars($student['firstname'] . ' ' . $student['surname']) ?></value>
                </div>
                <div class="info-row">
                    <label>Student Number:</label>
                    <value><?= htmlspecialchars($_SESSION['user_studentno']) ?></value>
                </div>
            </div>
        <?php endif; ?>

        <form action="includes/register.inc.php" method="POST">
            <fieldset>
                <label for="gender">Gender *</label>
                <select id="gender" name="gender" required>
                    <option value="">-- Select Gender --</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </fieldset>

            <fieldset>
                <label for="residence">Residence *</label>
                <select id="residence" name="residence" required>
                    <option value="">-- Select Residence --</option>
                    <?php foreach ($residences as $residence): ?>
                        <option value="<?= htmlspecialchars($residence['id']) ?>">
                            <?= htmlspecialchars($residence['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </fieldset>

            <div class="button-group">
                <button type="submit">Submit Application</button>
                <a href="../student_view_page/index.php" class="back-btn">Back to Status</a>
            </div>
        </form>
    </div>
</body>
</html>
