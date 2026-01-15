<?php
declare(strict_types=1);

function check_errors() {
    if (isset($_SESSION['errors_status'])) {
        foreach ($_SESSION['errors_status'] as $error) {
            echo '<p class="form-error">' . htmlspecialchars($error) . '</p>';
        }
        unset($_SESSION['errors_status']);
    }
}

// Display table of student applications
function display_applications_table(array $applications, array $student) {
    echo '<h3>Applications for: ' . htmlspecialchars($student['full_name']) . '</h3>';
    if (!$applications) {
        echo '<p>No applications found.</p>';
        return;
    }

    echo '<table border="1">';
    echo '<thead>
            <tr>
                <th>Application ID</th>
                <th>Residence</th>
                <th>Status</th>
                <th>Applied At</th>
            </tr>
          </thead>';
    echo '<tbody>';
    foreach ($applications as $app) {
        echo '<tr>';
        echo '<td>' . $app['application_id'] . '</td>';
        echo '<td>' . htmlspecialchars($app['residence_name']) . '</td>';
        echo '<td>' . ucfirst($app['status']) . '</td>';
        echo '<td>' . $app['created_at'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}
