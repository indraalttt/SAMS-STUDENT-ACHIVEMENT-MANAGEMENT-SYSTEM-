<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">SAMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="welcome.php">Dashboard</a>
                    </li>
                    <?php if ($_SESSION['role'] === 'student'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="view_profile.php">View Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="upload_certificate.php">Upload Certificate</a>
                        </li>
                        <li class="nav-item">
                    <a class="nav-link" href="view_certificates.php">View Certificates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="upcoming_events.php">Upcoming Events</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="student_login.php">Student Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="staff_login.php">Staff Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
