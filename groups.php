<?php $doc = ["title" => "Doku - Groups"] ?>
<?php require "includes/php/header.php" ?>
<?php require "includes/php/conn.php" ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

<link href="includes/css/styles.css" rel="stylesheet" />
<link href="includes/css/admin.css" rel="stylesheet" />
<script src="https://kit.fontawesome.com/b676a664d2.js" crossorigin="anonymous"></script>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 fw-bold" href="index.html">Doku</a>
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
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="#!">Logout</a></li>
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
                    <a class="nav-link" href="members.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Members
                    </a>
                    <a class="nav-link active show" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="true" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Category
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse show" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link active" href="groups.php">Groups</a>
                            <a class="nav-link" href="documents.php">Documents</a>
                        </nav>
                    </div>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
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
                    <h2 class="mt-5 fw-bold">Groups</h2>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active" aria-current="page">Groups</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <div class="container-fluid px-4 mt-4">
                <div class="row">
                    <!-- Content -->
                    <div class="d-flex justify-content-end">
                        <!-- Button trigger modal add member -->
                        <button type="button" class="btn btn-light linkOrange700 px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fas fa-plus"></i>
                            Add
                        </button>
                    </div>
                </div>

                <div class="card shadow mt-3 mb-3 py-3">
                    <div class="card-body px-4">
                        <table id="memberData" class="display table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Group 1</td>
                                    <td>
                                        <button onclick="return window.location.href='detailMember.php'" class="btn btn-sm btn-outline-primary">Change</button>
                                        <button onclick="return del('detailMember.php')" class="btn btn-sm text-danger">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Group 2</td>
                                    <td>
                                        <button onclick="return window.location.href='detailMember.php'" class="btn btn-sm btn-outline-primary">Change</button>
                                        <button onclick="return del('detailMember.php')" class="btn btn-sm text-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>


<!-- Modal Add User -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header px-4 border-0">
                <h5 class="modal-title" id="exampleModalLabel">Add Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="functionAdmin.php" method="post">
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Group Name</label>
                        <input type="text" name="name" id="name" class="form-control" maxlength="50" placeholder="Type new group name" autocomplete="off" required>
                    </div>
                </div>
                <div class="modal-footer px-4 border-0">
                    <button type="button" class="btn btn-2 me-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="addGroup" id="addGroup" class="btn btn-1 px-3">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script src="includes/js/scripts.js"></script>
<script src="includes/js/admin.js"></script>
<?php require "includes/php/footer.php" ?>