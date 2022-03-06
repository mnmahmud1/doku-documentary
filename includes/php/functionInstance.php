<?php 

    include "conn.php";

    if(isset($_POST['signin'])){
        $username = trim(htmlspecialchars($_POST['username']));
        $password = trim($_POST['password']);
        
        $getUser = mysqli_query($conn, "SELECT username, password FROM users WHERE username = '$username'");

        if(mysqli_num_rows($getUser) == 1){
            $getPass = mysqli_fetch_assoc($getUser);
            if(password_verify($password, $getPass["password"])){
                setcookie("users", $username, time() + (3600 * 3), "/");
                exit(header("Location: ../../index.php"));
            }
        }

        //! if login is fail give cookie and page detect alert from cookie
        setcookie("log", "failed", time() + 5, "/");
        header("Location: ../../signin.php");
    }

    if(isset($_POST['signup'])){
        $instansName = trim(htmlspecialchars($_POST['instansName']));
        $mail = trim(htmlspecialchars($_POST['mail']));
        $username = trim(htmlspecialchars($_POST['username']));
        $password = trim($_POST['password']);

        $checkUser = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
        //! check any user use the username
        if(mysqli_num_rows($checkUser) == 0){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO users (username, password, name, mail) VALUES('$username', '$hash', '$instansName', '$mail')");
            setcookie("reg", "success", time() + 5, "/");
            exit(header('Location: ../../signin.php'));
        }

        //! if login is fail give cookie and page detect alert from cookie
        setcookie("reg", "failedUsername", time() + 5, "/");
        header('Location: ../../signup.php');
    }

    if(isset($_GET["logout"])){
        setcookie("users", "", time() , "/");
        header("Location: ../../signin.php");
    }

    if(isset($_POST["addGroup"])){
        $name = $_POST['name'];

        //! check id user from cookie value
        $checkUser = $_COOKIE["users"];
        $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
        $idUser = $checkIdUser["id"];

        mysqli_query($conn, "INSERT INTO groups VALUES('', '$name', $idUser)");
        setcookie("add", "groupSuccess", time() + 5, "/");
        header("Location: ../../groups.php");
    }

    if(isset($_GET["delGroup"])){
        $idGroup = $_GET['delGroup'];

        //! check id user from cookie value
        $checkUser = $_COOKIE["users"];
        $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
        $idUser = $checkIdUser["id"];

        $checkIdUserGroup = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM groups WHERE id = $idGroup"));
        $idUserGroup = $checkIdUserGroup["user_id"];
        
        if($idUser == $idUserGroup){
            mysqli_query($conn, "DELETE FROM groups WHERE id = $idGroup");
            setcookie("del", "groupSuccess", time() + 5, "/");
            exit(header("Location: ../../groups.php"));
        }

        //! if user try to delete another users group
        setcookie("del", "groupFailed", time() + 5, "/");
        header("Location: ../../groups.php");
    }

    if(isset($_POST["editGroup"])){
        $nameEdit = trim(htmlspecialchars($_POST['nameEdit']));
        $idEdit = trim(htmlspecialchars($_POST['idEdit']));

        //! check id user from cookie value
        $checkUser = $_COOKIE["users"];
        $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
        $idUser = $checkIdUser["id"];

        $checkIdUserGroup = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM groups WHERE id = $idEdit"));
        $idUserGroup = $checkIdUserGroup["user_id"];
        
        if($idUser == $idUserGroup){
            mysqli_query($conn, "UPDATE groups SET group_name = '$nameEdit' WHERE id = $idEdit");
            setcookie("edi", "groupSuccess", time() + 5, "/");
            exit(header("Location: ../../groups.php"));
        }

        //! if user try to delete another users group
        setcookie("edi", "groupFailed", time() + 5, "/");
        header("Location: ../../groups.php");
    }

    if(isset($_POST["addDocument"])){
        $name = htmlspecialchars(trim($_POST["name"]));
        $description = htmlspecialchars(trim($_POST["description"]));
        $group = $_POST['group'];
        
        //! check id user from cookie value
        $checkUser = $_COOKIE["users"];
        $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
        $idUser = $checkIdUser["id"];

        mysqli_query($conn, "INSERT INTO documents (document_name, document_desc, group_id, user_id) VALUES('$name', '$description', $group, $idUser)");
        if(mysqli_affected_rows($conn)){
            setcookie("add", "documentSuccess", time() + 5, "/");
            header("Location: ../../documents.php");
        }
    }

    if(isset($_GET["delDocument"])){
        $idDocument = $_GET['delDocument'];

        //! check id user from cookie value
        $checkUser = $_COOKIE["users"];
        $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
        $idUser = $checkIdUser["id"];

        $checkIdUserDocument = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM documents WHERE id = $idDocument"));
        $idUserDocument = $checkIdUserDocument["user_id"];
        
        if($idUser == $idUserDocument){
            mysqli_query($conn, "DELETE FROM documents WHERE id = $idDocument");
            setcookie("del", "documentSuccess", time() + 5, "/");
            exit(header("Location: ../../documents.php"));
        }

        //! if user try to delete another users document
        setcookie("del", "documentFailed", time() + 5, "/");
        header("Location: ../../documents.php");
    }

    if(isset($_POST["editDocument"])){
        $name = htmlspecialchars(trim($_POST['editName']));
        $description = htmlspecialchars(trim($_POST['editDescription']));
        $group = $_POST['editGroup'];
        $idEdit = $_POST['docId'];

        //! check id user from cookie value
        $checkUser = $_COOKIE["users"];
        $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
        $idUser = $checkIdUser["id"];
        
        $checkIdUserDocument = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM documents WHERE id = $idEdit"));
        $idUserDocument = $checkIdUserDocument["user_id"];
        
        if($idUser == $idUserDocument){
            mysqli_query($conn, "UPDATE documents SET document_name = '$name', document_desc = '$description', group_id = $group WHERE id = $idEdit");
            setcookie("edi", "documentSuccess", time() + 5, "/");
            exit(header("Location: ../../documents.php"));
        }

        //! if user try to delete another users document
        setcookie("edi", "documentFailed", time() + 5, "/");
        header("Location: ../../documents.php");
    }

    if(isset($_POST["addMember"])){
        $name = htmlspecialchars(trim(strtoupper($_POST['name'])));
        $group = $_POST['group'];

        function randomString($length){
            $str        = "";
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $max        = strlen($characters) - 1;
            for ($i = 0; $i < $length; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];
            }
            return $str;
        }

        $memberCode = randomString(6);

        //! check id user from cookie value
        $checkUser = $_COOKIE["users"];
        $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
        $idUser = $checkIdUser["id"];

        mysqli_query($conn, "INSERT INTO members (member_code, member_name, group_id, user_id) VALUES('$memberCode', '$name', $group, $idUser)");
        if(mysqli_affected_rows($conn)){
            setcookie("add", "memberSuccess", time() + 5, "/");
            header("Location: ../../members.php");
        }
    }

    if(isset($_GET["delMember"])){
        $idMember = $_GET['delMember'];

        //! check id user from cookie value
        $checkUser = $_COOKIE["users"];
        $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
        $idUser = $checkIdUser["id"];

        $checkIdUserMember = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM members WHERE id = $idMember"));
        $idUserMember = $checkIdUserMember["user_id"];
        
        if($idUser == $idUserMember){
            mysqli_query($conn, "DELETE FROM members WHERE id = $idMember");
            setcookie("del", "memberSuccess", time() + 5, "/");
            exit(header("Location: ../../members.php"));
        }

        //! if user try to delete another users member
        setcookie("del", "memberFailed", time() + 5, "/");
        header("Location: ../../members.php");
    }

    if(isset($_POST["editMember"])){
        $name = htmlspecialchars(trim($_POST['editName']));
        $idEdit = $_POST['idEdit'];
        $group = $_POST['editGroup'];

        //! check id user from cookie value
        $checkUser = $_COOKIE["users"];
        $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
        $idUser = $checkIdUser["id"];
        
        $checkIdUserMember = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM members WHERE id = $idEdit"));
        $idUserMember = $checkIdUserMember["user_id"];
        
        if($idUser == $idUserMember){
            mysqli_query($conn, "UPDATE members SET member_name = '$name', group_id = '$group' WHERE id = $idEdit");
            setcookie("edi", "memberSuccess", time() + 5, "/");
            exit(header("Location: ../../members.php"));
        }

        //! if user try to delete another users member
        setcookie("edi", "memberFailed", time() + 5, "/");
        header("Location: ../../members.php");
    }

    if(isset($_POST["addValidator"])){
        $name = $_POST['name'];

        //! check id user from cookie value
        $checkUser = $_COOKIE["users"];
        $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
        $idUser = $checkIdUser["id"];

        mysqli_query($conn, "INSERT INTO validators VALUES('', '$name', $idUser)");
        setcookie("add", "validatorSuccess", time() + 5, "/");
        header("Location: ../../validators.php");
    }

    if(isset($_GET["delValidator"])){
        $idValidator = $_GET['delValidator'];

        //! check id user from cookie value
        $checkUser = $_COOKIE["users"];
        $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
        $idUser = $checkIdUser["id"];

        $checkIdUserValidator = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM validators WHERE id = $idValidator"));
        $idUserValidator = $checkIdUserValidator["user_id"];
        
        if($idUser == $idUserValidator){
            mysqli_query($conn, "DELETE FROM validators WHERE id = $idValidator");
            setcookie("del", "validatorSuccess", time() + 5, "/");
            exit(header("Location: ../../validators.php"));
        }

        //! if user try to delete another users validator
        setcookie("del", "validatorFailed", time() + 5, "/");
        header("Location: ../../validators.php");
    }

    if(isset($_POST["editValidator"])){
        $nameEdit = trim(htmlspecialchars($_POST['nameEdit']));
        $idEdit = trim(htmlspecialchars($_POST['idEdit']));

        //! check id user from cookie value
        $checkUser = $_COOKIE["users"];
        $checkIdUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE username = '$checkUser'"));
        $idUser = $checkIdUser["id"];

        $checkIdUserValidator = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_id FROM validators WHERE id = $idEdit"));
        $idUserValidator = $checkIdUserValidator["user_id"];
        
        if($idUser == $idUserValidator){
            mysqli_query($conn, "UPDATE validators SET validator_name = '$nameEdit' WHERE id = $idEdit");
            setcookie("edi", "validatorSuccess", time() + 5, "/");
            exit(header("Location: ../../validators.php"));
        }

        //! if user try to delete another users group
        setcookie("edi", "validatorFailed", time() + 5, "/");
        header("Location: ../../validators.php");
    }