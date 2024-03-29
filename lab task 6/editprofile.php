<?php require_once("./inc/deps.php"); ?>
<?php header_section("Dashboard | Edit Profile"); ?>
<?php
if ($_SESSION['login'] == false) {
    header("Location: login.php");
    exit();
}

$errors_message = [];
$success_message = "";

if (isset($_GET['success'])) {
    if ($_GET['success'] == "true") {
        // var_dump($_GET);
        $success_message = "Successfully Edited";
    }
}

if (isset($_GET['errors'])) {
    $errors_code = explode(",", $_GET['errors']);


    foreach ($errors_code as $error) {
        if ($error == "name") {
            array_push($errors_message, "Name must be larger than 2 character, alphanumeric");
        }
        if ($error == "email") {
            array_push($errors_message, "Invalid Email");
        }
        if ($error == "duplicate") {
            array_push($errors_message, "Duplicate Email address");
        }
        // if ($error == "gender") {
        //     array_push($errors_message, "Invalid Gender");
        // }
        if ($error == "type") {
            array_push($errors_message, "Invalid Type");
        }
        if ($error == "notupdate") {
            array_push($errors_message, "Something went wrong, Update unsuccessfull");
        }
        // if ($error == "dob") {
        //     array_push($errors_message, "Invalid Date Of Birth");
        // }
    }
}
?>

<main class="clearfix">
    <?php if (count($errors_message)) : ?>

        <div class="errors-list">
            <table>
                <tbody>

                    <?php foreach ($errors_message as $err_msg) : ?>

                        <tr>
                            <td>!! <?php echo $err_msg; ?></td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    <?php endif; ?>
    <?php if (!empty($success_message)) : ?>

        <div class="success">
            <table>
                <tbody>
                    <tr>
                        <td><?php echo $success_message; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

    <?php endif; ?>
    <form action="inc/editprofile.inc.php" method="post">
        <?php if (isset($_SESSION['id']) && !empty($_SESSION['id'])) : ?>
            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
        <?php endif; ?>
        <table>
            <tbody>

                <?php if (isset($_SESSION['name']) && !empty($_SESSION['name'])) : ?>

                    <tr>
                        <td><label for="name">Name</label></td>
                        <td><input class="inp" id="name" type="text" value="<?php echo $_SESSION['name'] ?>" name="name" required></td>
                    </tr>

                <?php endif; ?>
                <?php if (isset($_SESSION['email']) && !empty($_SESSION['email'])) : ?>

                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><input class="inp" id="email" type="email" value="<?php echo $_SESSION['email'] ?>" name="email" required></td>
                    </tr>

                <?php endif; ?>
                <?php if (isset($_SESSION['phone']) && !empty($_SESSION['phone'])) : ?>

                    <tr>
                        <td><label for="phone">Phone</label></td>
                        <td><input class="inp" id="phone" type="phone" value="<?php echo $_SESSION['phone'] ?>" name="phone" required></td>
                    </tr>

                <?php endif; ?>
                <?php if (isset($_SESSION['nid']) && !empty($_SESSION['nid'])) : ?>

                    <tr>
                        <td><label for="nid">NID</label></td>
                        <td><input class="inp" id="nid" type="nid" value="<?php echo $_SESSION['nid'] ?>" name="nid" required></td>
                    </tr>

                <?php endif; ?>
                <?php if (isset($_SESSION['location']) && !empty($_SESSION['location'])) : ?>

                    <tr>
                        <td><label for="location">Location</label></td>
                        <td><input class="inp" id="location" type="location" value="<?php echo $_SESSION['location'] ?>" name="location" required></td>
                    </tr>

                <?php endif; ?>
                <?php if (isset($_SESSION['type']) && !empty($_SESSION['type'])) : ?>

                    <input type="hidden" name="type" value="<?php echo $_SESSION['type']; ?>">

                <?php endif; ?>

                <tr>
                    <td><button class="btn" type="reset">Reset</button></td>
                    <td><button class="btn" id="edit" type="submit" name="edit">Edit</button></td>
                </tr>
            </tbody>
        </table>
    </form>
</main>
<?php footer_section(); ?>
