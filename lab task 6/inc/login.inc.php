<?php
session_start();

if (isset($_POST['login'])) {
    require_once("./database.php");
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';
    // return;

    $notFound = true;
    $id = "";
    $name = "";
    $email_store = "";
    $location = "";
    $phone = "";
    $nid = "";
    $worktype = "";
    // $gender = "";
    $purl = "";
    // $dob = "";
    $user = [];
    $email = (isset($_POST['email'])) ? htmlentities(htmlspecialchars($_POST['email'])) : '';
    $password = (isset($_POST['password'])) ? htmlentities(htmlspecialchars($_POST['password'])) : '';
    $type = (isset($_POST['type'])) ? htmlentities(htmlspecialchars($_POST['type'])) : '';;

    // $json_data = file_get_contents('../db/data.json');
    // $tmp_arr = json_decode($json_data);

    // foreach ($tmp_arr as $e) {
    //     if ($e[0]->email == $email && $e[0]->password == $password) {
    //         $name = $e[0]->name;
    //         $email_store = $e[0]->email;
    //         $gender = $e[0]->gender;
    //         $type = $e[0]->type;
    //         $purl = $e[0]->purl;
    //         $dob = $e[0]->dob;
    //         $notFound = false;
    //         break;
    //     }
    // }
    // SELECT * FROM restaurant_admin WHERE e_id = '4' AND password = ''
        // ';DROP database rms; Cross site Scripting

    if ($type === "restaurantadmin" && isExist("email", "email", "$email")) {
        $e_id = read("email", "e_id", "e_id", "email = '$email'")[0]['e_id'];

        $user = read("restaurant_admin", "r_id", "*", "e_id = '$e_id' AND password = '$password'");
        $user = (is_array($user) && count($user) > 0) ? $user[0] : [];

        if (count($user) > 0) {

            $L_id = $user['L_id'];
            $location = read("location", "L_id", "Location", "L_id = '$L_id'")[0]['Location'];

            // echo '<pre>';
            // var_dump($user);
            // echo '</pre>';
            // return;

            $id = $user['r_id'];
            $name = $user['r_name'];
            $email_store = $email;
            $nid = $user['NID'];
            $location = $location;
            $purl = $user['purl'];
            $notFound = false;
        } else {
            session_unset();
            session_destroy();
            header("Location: ../login.php?errors=notlogin");
            exit();
        }
    } else if ($type === "management" && isExist("email", "email", "$email")) {
        #code

    } else if ($type === "user" && isExist("email", "email", "$email")) {
        #code

    } else if ($type === "admin" && isExist("email", "email", "$email")) {
        $e_id = read("email", "e_id", "e_id", "email = '$email'")[0]['e_id'];

        $user = read("admin", "id", "*", "e_id = '$e_id' AND password = '$password'");
        $user = (is_array($user) && count($user) > 0) ? $user[0] : [];
        if (count($user) > 0) {

            // echo '<pre>';
            // var_dump($user);
            // echo '</pre>';
            // return;
            $phone = read("phone", "p_id", "phone", "p_id = '" . $user['p_id'] . "'");
            $phone = (is_array($phone) && count($phone) > 0) ? $phone[0]['phone'] : "N/A";

            $id = $user['id'];
            $name = $user['a_name'];
            $email_store = $email;
            $nid = $user['NID'];
            // $location = $location;
            $purl = $user['purl'];
            $notFound = false;
        } else {
            session_unset();
            session_destroy();
            header("Location: ../login.php?errors=notlogin");
            exit();
        }
    }

    if ($notFound) {
        session_unset();
        session_destroy();
        header("Location: ../login.php?errors=notlogin");
        exit();
    }

    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email_store;
    $_SESSION['nid'] = $nid;
    $_SESSION['location'] = $location;
    $_SESSION['phone'] = $phone;
    // $_SESSION['gender'] = $gender;
    $_SESSION['type'] = $type;
    // $_SESSION['dob'] = $dob;
    $_SESSION['purl'] = $purl;
    $_SESSION['login'] = true;

    header("Location: ../dashboard.php");
    exit();
} else {
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}s