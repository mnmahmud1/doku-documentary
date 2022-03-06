<?php $doc = ["title" => "Doku - Members"] ?>
<?php require "includes/php/header.php" ?>
<?php require "includes/php/conn.php" ?>
<?php
    if(!isset($_COOKIE["users"])){
        echo "
            <script>
                window.location.href = 'signin.php';
            </script>
        ";
        exit;
    }
    
    //! check id user from cookie value
    $checkUser = $_COOKIE["users"];
    $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
    $idUser = $checkIdUser["id"];


    // get member from group tag
    if(isset($_GET["tag"]) && $_GET["tag"] !== "all" ){
        $tag = $_GET["tag"];
        $checkGroup = mysqli_query($conn, "SELECT id FROM members WHERE group_id = '$tag' AND user_id = $idUser");
        
        // if(mysqli_num_rows($checkGroup) > 0){
            $getMember = mysqli_query($conn, "SELECT id, member_code, member_name FROM members WHERE group_id = $tag AND user_id = $idUser");
        // } else {
        //     $getMember = mysqli_query($conn, "SELECT id, member_code, member_name FROM members WHERE user_id = $idUser");
        // }
    } elseif(!isset($_GET["tag"]) || $_GET["tag"] === "all") {
        $getMember = mysqli_query($conn, "SELECT id, member_code, member_name FROM members WHERE user_id = $idUser");
    } 

    $getGroups = mysqli_query($conn, "SELECT id, group_name FROM groups WHERE user_id = $idUser");
    
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

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
                <li><button class="dropdown-item" onclick="return alertModal('includes/php/functionInstance.php?logout=1', 'Logout', 'If you logout maybe any data cant be saved!')">Logout</button></li>
            </ul>
        </li>
    </ul>
</nav>

<!-- Toast Notification -->
<?php if(isset($_COOKIE["add"]) || isset($_COOKIE["del"]) || isset($_COOKIE["edi"])) : ?>
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="position-absolute top-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong class="me-auto">Doku</strong>
                    <small>Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?php if(isset($_COOKIE["add"]) && $_COOKIE["add"] == "memberSuccess") : ?>
                        <strong class="text-success">Successfully</strong> add new member.
                    <?php elseif(isset($_COOKIE["add"]) && $_COOKIE["add"] == "import") : ?>
                        <strong class="text-success">Successfully</strong> add <?= $_COOKIE["import"] ?> new member.
                    <?php elseif(isset($_COOKIE["del"]) && $_COOKIE["del"] == "memberSuccess") : ?>
                        <strong class="text-success">Successfully</strong> delete member.
                    <?php elseif(isset($_COOKIE["del"]) && $_COOKIE["del"] == "memberFailed") : ?>
                        <strong  class="text-danger">Failed</strong> to delete member. Please try again!
                    <?php elseif(isset($_COOKIE["edi"]) && $_COOKIE["edi"] == "memberSuccess") : ?>
                        <strong  class="text-success">Successfully</strong> edit member.
                    <?php elseif(isset($_COOKIE["edi"]) && $_COOKIE["edi"] == "memberFailed") : ?>
                        <strong  class="text-danger">Failed</strong> to edit member. Please try again!
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

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
                            <a class="nav-link" href="validators.php">Validators</a>
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
                    <h2 class="mt-5 fw-bold">Members</h2>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active" aria-current="page">Members</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <div class="container-fluid px-4 mt-4">
                <div class="row">
                    <!-- Content -->
                    <div class="col-sm-4 col-md-8 col-lg-5 mb-3">
                        <form action="" method="GET">
                            <div class="d-flex">
                                <select name="tag" id="tag" class="form-select me-3" required>
                                    <option value="all">All Groups</option>
                                    <?php foreach ($getGroups as $group) : ?>
                                        <option value="<?= $group['id'] ?>"><?= $group['group_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <button type="submit" class="btn btn-1 me-3 rounded">Set</button>
                                <button type="button" onclick="print()" class="btn bg-white linkOrange700">
                                    <i class="fas fa-print"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm col-lg">
                        <div class="d-flex justify-content-end">
                            <!-- Button trigger modal add member -->
                            <button type="button" class="btn bg-white linkOrange700 me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-plus"></i>
                                Add
                            </button>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" id="importMember" class="btn bg-white linkOrange700" data-bs-toggle="modal" data-bs-target="#importModal">
                                    <i class="fas fa-file-import"></i>
                                    Imports
                                </button>
                                <a href="includes/php/Temp-Excel.xls" class="btn btn-1 rounded-end" download>
                                <i class="fas fa-download"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mt-3 mb-3 py-3">
                    <div class="card-body px-4">
                        <div class="table-responsive">
                            <table id="memberData" class="stripe hover row-border table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Document Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach ($getMember as $member) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td class="fw-bold"><?= $member["member_code"] ?></td>
                                            <td><?= $member["member_name"] ?></td>
                                            <td>
                                                <button >Details</button>
                                            </td>
                                            <td>
                                                <div class="dropend">
                                                    <button class="btn btn-white btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </button>

                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li>
                                                            <button type="button" class="dropdown-item" id="editMemberButton"
                                                                data-bs-toggle="modal" data-bs-target="#editMemberModal"
                                                                data-name="<?= $member ['member_name'] ?>"
                                                                data-id="<?= $member ['id'] ?>">
                                                                Edit
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button onclick="return alertModal('includes/php/functionInstance.php?delMember=<?= $member['id'] ?>')" class="dropdown-item">
                                                                Delete
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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


<!-- Modal Add User -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header px-4 border-0">
                <h5 class="modal-title" id="exampleModalLabel">Add Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="includes/php/functionInstance.php" method="post">
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" maxlength="50" placeholder="Type new member name" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="group" class="form-label">Group</label>
                        <select name="group" id="group" class="form-select" required>
                            <option value="">Choose</option>
                            <?php foreach ($getGroups as $group) : ?>
                                <option value="<?= $group['id'] ?>"><?= $group['group_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer px-4 border-0">
                    <button type="button" class="btn btn-2 me-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="addMember" id="addMember" class="btn btn-1 px-3">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header px-4 border-0">
                <h5 class="modal-title" id="editMemberModalLabel">Edit Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="includes/php/functionInstance.php" method="post">
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" name="editName" id="editName" class="form-control" maxlength="50" placeholder="Type new member name" autocomplete="off" required>
                        <input type="text" name="idEdit" id="idEdit" hidden>
                    </div>
                    <div class="mb-3">
                        <label for="editGroup" class="form-label">Group</label>
                        <select name="editGroup" id="editGroup" class="form-select" required>
                            <option value="">Choose</option>
                            <?php foreach ($getGroups as $group) : ?>
                                <option value="<?= $group['id'] ?>"><?= $group['group_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer px-4 border-0">
                    <button type="button" class="btn btn-2 me-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="editMember" id="editMember" class="btn btn-1 px-3">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Add User via import -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header px-4 border-0">
                <h5 class="modal-title" id="importModalLabel">Import Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="includes/php/functionInstance.php" enctype="multipart/form-data" method="post">
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Upload Excel File</label>
                        <input type="file" name="excel" id="excel" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer px-4 border-0">
                    <button type="button" class="btn btn-2 me-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="importMember" id="importMember" class="btn btn-1 px-3">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script src="includes/js/scripts.js"></script>
<script src="includes/js/admin.js"></script>
<script>
    $(document).on('click','#editMemberButton', function(e) {
        let id = $(this).data('id');
        let name = $(this).data('name');

        $('#idEdit').val(id);
        $('#editName').val(name);
    });
</script>
<?php require "includes/php/footer.php" ?>