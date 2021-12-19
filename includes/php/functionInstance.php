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
        $name = $_POST['name'];
        $description = $_POST['description'];
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