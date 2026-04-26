<?php 
    session_start();
    define('APPURL', "http://localhost/blog-cms-php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="A Blog to practice skill for developer" />
    <meta name="author" content="Nguyen Bao Huy" />
    <title>Clean Blog - Baohuy Blog</title>
    <link rel="icon" type="image/x-icon" href="<?php echo APPURL; ?>/assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
        rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?php echo APPURL; ?>/css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="<?php echo APPURL; ?>/index.php">Baohuy Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <div class="ml-4 input-group ps-5">
                        <div id="navbar-search-autocomplete" class="w-100 mr-4">
                            <form method="POST" action="<?php echo APPURL; ?>/search.php" class="mr-4">
                                <input name="search" type="search" id="form1" class="form-control mt-3"
                                    placeholder="search" />
                            </form>
                        </div>
                    </div>

                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                            href="<?php echo APPURL; ?>/index.php">Home</a>
                    </li>
                    <?php if(isset($_SESSION['username'])) :?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                            href="<?php echo APPURL; ?>/posts/create.php">Create</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle px-lg-3 py-3 py-lg-4" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['username']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="<?php echo APPURL; ?>/users/profile.php?id=<?php echo $_SESSION["user_id"]; ?>">Profile</a>
                            </li>
                            <li><a class="dropdown-item" href="<?php echo APPURL; ?>/auth/logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                            href="<?php echo APPURL; ?>/auth/login.php">Login</a>
                    </li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                            href="<?php echo APPURL; ?>/auth/register.php">Register</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                            href="<?php echo APPURL; ?>/contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>