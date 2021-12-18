<?php 

    include "conn.php";

    if(isset($_POST['signin'])){
        $username = trim(htmlspecialchars($_POST['username']));
        $password = trim($_POST['password']);
        
        $getUser = mysqli_query($conn, "SELECT username, password FROM users WHERE username = '$username'");

        if(mysqli_num_rows($getUser) == 1){
            $getPass = mysqli_fetch_assoc($getUser);
            if(password_verify($password, $getPass["password"])){
                setcookie("users", $username, time() + 3600 * 3, "/");
                exit(header("Location: ../../index.php"));
            }
        }

        //! if login is fail give cookie and page detect alert from cookie
        setcookie("log", "failed", time() + 120, "/");
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
            setcookie("reg", "success", time() + 120, "/");
            exit(header('Location: ../../signin.php'));
        }

        //! if login is fail give cookie and page detect alert from cookie
        setcookie("reg", "failedUsername", time() + 120, "/");
        header('Location: ../../signup.php');
    }

    if(isset($_GET["logout"])){
        setcookie("users", "", time() , "/");
        header("Location: ../../signin.php");
    }