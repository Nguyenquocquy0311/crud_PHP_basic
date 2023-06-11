<!DOCTYPE html>
<html>
    <head>
        <title>Edit user</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            td {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <?php
            include 'connect_database.php';
            
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = mysqli_query($connect,"SELECT * FROM `users` WHERE id='$id'");
                if (mysqli_num_rows($query) != 0) {
                    $row = mysqli_fetch_assoc($query);
                } else {
                    header('location: error.php');
                }
            } else {
                header('location: error.php');
            }
        ?>
        <form method="POST">
            <h1>Edit user</h1>
            <table>
                <tr>
                    <td>Name <a style="color:red">*</a></td>
                    <td><input type="text" name="name_update" value="<?php echo (!empty($_POST['name_update'])) ? $_POST['name_update'] : $row['name']; ?>"/></td>
                    <?php
                        if (isset($_POST['click_save'])) {
                            if (empty($_POST['name_update'])) {
                                echo '<td><div style="color:red">Please type name !</div></td>';
                            }
                        }
                    ?>
                </tr>
                <tr>
                    <td>Email <a style="color:red">*</a></td>
                    <td><input type="text" name="email_update" value="<?php echo (!empty($_POST['email_update'])) ? $_POST['email_update'] : $row['email']; ?>"/></td>
                    <?php
                        if (isset($_POST['click_save'])) {
                            if (empty($_POST['email_update'])) {
                                echo '<td><div style="color:red">Please type email !</div></td>';
                            } elseif (!preg_match("/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i", $_POST['email_update'])) {
                                echo '<td style="color:red">Invalid Email !</td>';
                            }
                        }
                    ?>
                </tr>
                    <td>Phone <a style="color:red">*</a></td>
                    <td><input type="text" name="phone_update" value="<?php echo (!empty($_POST['phone_update'])) ? $_POST['phone_update'] : $row['phone']; ?>"/></td>
                    <?php
                        if (isset($_POST['click_save'])) {
                            if (empty($_POST['phone_update'])) {
                                echo '<td><div style="color:red">Please type phone !</div></td>';
                            } elseif (!preg_match("/^[0-9]{10}+$/", $_POST['phone_update'])) {
                                echo '<td style="color:red">Invalid Phone number !</td>';
                            }
                        }
                    ?>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" value="<?php echo $row['username']; ?>" readonly/></td>
                </tr><tr>
                    <td>Password</td>
                    <td><input type="password" name="password_update" value=""/></td>
                </tr>
                <tr>
                    <td>Retype Password</td>
                    <td><input type="password" name="repassword_update" value=""/></td>
                    <?php
                        if (isset($_POST['click_save'])) {
                                if (empty($_POST['repassword_update']) && !empty($_POST['password'])) {
                                    echo '<td><div style="color:red">Please retype password !</div></td>';
                                } elseif ($_POST['password_update'] != $_POST['repassword_update']) {
                                    echo '<td><div style="color:red">Password not match, please try again !</div></td>';
                                }
                            }
                    ?>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="click_save" >Save</button>
                    <button type="submit" name="click_cancel" >Cancel</button></td>
                </tr>
            </table>
        <?php
            if (isset($_POST['click_save'])) {
                if (!empty($_POST['name_update'] && $_POST['email_update'] && $_POST['phone_update']) && preg_match("/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i", $_POST['email_update']) && preg_match("/^[0-9]{10}+$/", $_POST['phone_update'])) {
                    $name = $_POST['name_update'];
                    $email = $_POST['email_update'];
                    $phone = $_POST['phone_update'];

                    if (empty($_POST['password_update'])) {
                        $sql = "UPDATE `users` SET `name` = '$name', email = '$email', phone = '$phone' WHERE id = '$id'";
                        $queryUpdate = mysqli_query($connect, $sql);
                        header('Location: print_list.php');
                    } elseif (isset($_POST['password_update']) && $_POST['repassword_update'] == $_POST['password_update']) {
                        $password = md5($_POST['password_update']);
                        $sql = "UPDATE `users` SET `name` = '$name', email = '$email', phone = '$phone', `password` = '$password' WHERE id = '$id'";
                        $queryUpdate = mysqli_query($connect, $sql);
                        header('Location: print_list.php');
                    }
                }
            }

            if (isset ($_POST['click_cancel'])) {
                header('Location: print_list.php');
            }
        ?>
        </form>
    </body>
</html>