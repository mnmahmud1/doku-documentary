<?php $doc = ["title" => "Doku - Document Verification"] ?>
<?php require "includes/php/header.php" ?>
<?php require "includes/php/conn.php" ?>
<link rel="stylesheet" href="includes/css/form.css">

<!-- Body HTML -->


<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="mt-5">
                <h3 class="fw-bold">Document Verification</h3>
                <p>Check and update your documents</p>
            </div>
            <div class="card shadow-lg border-0 py-4 px-3">
                <div class="card-body">
                    <form action="includes/functionInstance.php" method="post">
                        <label for="memberCode" class="form-label">Member Code</label>
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="mb-3">
                                    <input type="text" name="memberCode" id="memberCode" class="form-control" placeholder="Type your member code" maxlength="30" autofocus required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-1" name="find">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php if(isset($_GET["id"])) : ?>
                        <form id="formVerification" action="includes/php/functionPublic.php" method="post" enctype="multipart/form-data">
                            <!-- Member Details -->
                            <h4 class="fw-bold mt-4 mb-3">Member Details</h4>
                            Member Code
                            <p class="fw-bold">MA1235</p>
                            Member Name
                            <p class="fw-bold">M Nurhasan Mahmudi</p>
                            Group
                            <p class="fw-bold">XI TKJ 2</p>

                            <!-- Documents Details -->
                            <h4 class="fw-bold mt-4 mt-5 mb-3">Your Documents</h4>
                            
                            <!-- Document Upload -->
                            <div class="row">
                                <div class="col-sm-6 mb-4">
                                    <p>Photo Ijazah (asli) <a href="#" class="linkOrange">Lihat</a></p> 
                                    <input type="file" name="unique" id="unique" class="form-control">
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <p>Photo Ijazah (asli) <a href="#" class="linkOrange">Lihat</a></p> 
                                    <input type="file" name="unique" id="unique" class="form-control">
                                </div>
                            </div>
                    
                            <!-- Make Changes Identity -->
                            <div class="mb-3 mt-4">
                                <label for="validator" class="form-label">Validator</label>
                                <select type="text" name="validator" id="validator" class="form-select" required>
                                    <option value="">Choose</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editor" class="form-label">Make Changes</label>
                                <input type="text" name="editor" id="editor" class="form-control" placeholder="Type your name" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-2 me-4" onclick="window.location.href = 'signin.php'">Cancel</button>
                                <button type="submit" class="btn btn-1">Save Changes</button>
                            </div>

                        </form>
                    <?php else : ?>
                        <p id="msg" class="text-center mb-0 mt-4">Please contact your instance administrator for get a member code</p>
                    <?php endif ?>
                        
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Body HTML -->
<?php require "includes/php/footer.php" ?>