<?php $doc = ["title" => "Doku - Member Details"] ?>
<?php require "includes/php/header.php" ?>
<?php require "includes/php/conn.php" ?>

<script src="https://kit.fontawesome.com/b676a664d2.js" crossorigin="anonymous"></script>
<link href="includes/css/styles.css" rel="stylesheet" />
<link href="includes/css/admin.css" rel="stylesheet" />

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 fw-bold" href="index.php">Doku</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <!-- <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div> -->
    </form>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><button class="dropdown-item" onclick="return alertModal('functionAdmin.php?logout=1', 'Logout', 'If you logout maybe any data cant be saved!')">Logout</button></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link active" href="members.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Members
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-clone"></i></div>
                        Category
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="groups.php">Groups</a>
                            <a class="nav-link" href="documents.php">Documents</a>
                        </nav>
                    </div>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                        History
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="row">
                    <h2 class="mt-5 fw-bold">Member Details</h2>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item" aria-current="page">Members</li>
                            <li class="breadcrumb-item active" aria-current="page">Member Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="container-fluid px-4">
                <div class="row">
                    <!-- Member Details -->
                    <h4 class="mt-4 mb-3">
                        <i class="fas fa-user me-2"></i>
                        Identity
                    </h4>
                    <div class="col-sm-2">
                        Member Code
                        <p class="fw-bold">MA1235</p>
                    </div>
                    <div class="col-sm-2">
                        Group
                        <p class="fw-bold">XI TKJ 2</p>
                    </div>
                    <div class="col-sm">
                        Member Name
                        <p class="fw-bold">M Nurhasan Mahmudi</p>
                    </div>
                </div>
                <div class="row mb-5">
                    <!-- Content -->
                    <form id="formVerification" action="includes/php/functionPublic.php" method="post" enctype="multipart/form-data">
                        
                        <!-- Documents Details -->
                        <h4 class="mt-4 mt-5 mb-3">
                            <i class="fas fa-file me-2"></i>
                            Documents
                        </h4>
                        
                        <!-- Document Upload -->
                        <div class="row mb-3">
                            <div class="col-sm-4 mb-4">
                                <p>Photo Ijazah (asli) <a href="#" class="linkOrange">Lihat</a></p> 
                                <input type="file" name="unique" id="unique" class="form-control">
                            </div>
                            <div class="col-sm-4 mb-4">
                                <p>Photo Ijazah (asli) <a href="#" class="linkOrange">Lihat</a></p> 
                                <input type="file" name="unique" id="unique" class="form-control">
                            </div>
                            <div class="col-sm-4 mb-4">
                                <p>Photo Ijazah (asli) <a href="#" class="linkOrange">Lihat</a></p> 
                                <input type="file" name="unique" id="unique" class="form-control">
                            </div>
                            <div class="col-sm-4 mb-4">
                                <p>Photo Ijazah (asli) <a href="#" class="linkOrange">Lihat</a></p> 
                                <input type="file" name="unique" id="unique" class="form-control">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-2 me-4" onclick="window.location.href = 'members.php'">Cancel</button>
                            <button type="submit" class="btn btn-1">Save Changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-start small">
                    <div class="text-muted">Copyright &copy; Doku 2021</div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="includes/js/scripts.js"></script>

<?php require "includes/php/footer.php" ?>