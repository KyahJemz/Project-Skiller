<?php 
    $data['title'] = "Skiller: Page Not Found";

    include(__DIR__ . '/../headers/Default.php');
    if (isLoggedIn()) {
        include(__DIR__ . '/../headers/SignedIn.php');
    } else {
        include(__DIR__ . '/../headers/SignedOut.php');
    }

?>
<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL.'?page=Dashboard'?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Not Found</li>
                </ol>
            </nav>
        </div>

        <div class="row p-4 rounded-3 bg-white">
            <h3>Page Not Found</h3>
            <p>This page could not be found or is not a valid page. If this was a mistake, please contact the system administrators.</p>
        </div>
    </div>
<?php 
    include(__DIR__ . '/../footers/Default.php');
?>