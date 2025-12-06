<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Home' ?></title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-xxl bg-light justify-content-between px-5">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-uppercase" href="<?= BASE_URL ?>"><b>Home</b></a>
            </li>
        </ul>

        <ul class="navbar-nav">
            <?php if(isset($_SESSION['userLogin'])): ?>
            <li class="nav-item dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $_SESSION['userLogin']['name'] ?>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>?action=logout">Logout</a></li>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </nav>


    <?php 
    if(isset($_SESSION['error']) && count($_SESSION['error']) > 0): ?>
        <ul>
            <?php foreach($_SESSION['error'] as $error): ?>
                <li><span class="text-danger"><?= $error ?></span></li>
            <?php endforeach; ?>
        </ul>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>


    <?php 
    if(isset($_SESSION['success']) && count($_SESSION['success']) > 0): ?>
        <ul>
            <?php foreach($_SESSION['success'] as $success): ?>
                <li><span class="text-success"><?= $success ?></span></li>
            <?php endforeach; ?>
        </ul>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>


    <div class="container">
        <div class="row">
            <?php
            if (isset($view)) {
                require_once PATH_VIEW . $view . '.php';
            }
            ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
