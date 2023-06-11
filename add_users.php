<?php
    include 'connect_database.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add new user</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            td {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <h1>Add new user </h1></br>
        <form method = "POST" action="">
            <table>
                <tr>
                    <td>Name <a style="color:red">*</a></td>
                    <td><input type="text" name="name" value="<?php echo (!empty($_POST['name'])) ? $_POST['name'] : '';?>"/></td>
                    <?php
                        if (isset($_POST['click_save'])) {
                            if (empty($_POST['name'])) {
                                echo '<td><div style="color:red">Please type name !</div></td>';
                            }
                        }
                    ?>
                </tr>
                <tr>
                    <td>Email <a style="color:red">*</a></td>
                    <td><input type="text" name="email" value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : '';?>"/></td>
                    <?php
                        if (isset($_POST['click_save'])) {
                            if (empty($_POST['email'])) {
                                echo '<td><span style="color:red">Please type email !</span></td>';
                            } elseif (!preg_match("/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i", $_POST['email'])) {
                                echo '<td style="color:red">Invalid Email !</td>';
                            }
                        }
                    ?>
                </tr>
                <tr>
                    <td>Phone <a style="color:red">*</a></td>
                    <td><input type="text" name="phone" value="<?php echo (!empty($_POST['phone'])) ? $_POST['phone'] : '' ;?>"/></td>
                    <?php
                        if (isset($_POST['click_save'])) {
                            if (empty($_POST['phone'])) {
                                echo '<td><span style="color:red">Please type phone !</span></td>';
                            } elseif (!preg_match("/^[0-9]{10}+$/", $_POST['phone'])) {
                                echo '<td style="color:red">Invalid Phone number !</td>';
                            }
                        }
                    ?>
                </tr>
                <tr>
                    <td>Username <a style="color:red">*</a></td>
                    <td><input type="text" name="username" value="<?php echo (!empty($_POST['username'])) ? $_POST['username'] : '' ;?>"/></td>
                    <?php
                        if (isset($_POST['click_save'])) {
                            if (empty($_POST['username'])) {
                                echo '<td><span style="color:red">Please type username !</span></td>';
                            } else {
                                $username = $_POST['username'];
                                $sql = "SELECT * FROM users WHERE username = '$username'";
                                $query = mysqli_query($connect, $sql);

                                if (mysqli_num_rows($query) > 0) {
                                    echo '<td><span style="color:red">Username already exists !</span></td>';
                                }
                            }
                        }
                    ?>
                </tr>
                <tr>
                    <td>Password <a style="color:red">*</a></td>
                    <td><input type="password" name="password" value="<?php echo (!empty($_POST['password'])) ? $_POST['password'] : '' ;?>"/></td>
                    <?php
                        if (isset($_POST['click_save'])) {
                            if (empty($_POST['password'])) {
                                echo '<td><span style="color:red">Please type password !</span></td>';
                            }
                        }
                    ?>
                </tr>
                <tr>
                    <td>Retype password <a style="color:red">*</a></td>
                    <td><input type="password" name="password_again" value="<?php echo (!empty($_POST['password'])) ? $_POST['password'] : '' ;?>" /></td>
                    <?php
                        if (isset($_POST['click_save'])) {
                            if (empty($_POST['password_again']) && !empty($_POST['password'])) {
                                echo '<td><span style="color:red">Please retype password !</span></td>';
                            } elseif ($_POST['password'] != $_POST['password_again']) {
                                echo '<td><span style="color:red">Password not match, please try again !</span></td>';
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
        </form>

        <?php
            if (isset($_POST['click_save'])) {
                if (!empty($_POST['name'] && $_POST['phone'] && $_POST['email'] && $_POST['username'] && $_POST['password'] && $_POST['password_again']) && preg_match("/^[0-9]{10}+$/", $_POST['phone']) && preg_match("/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i", $_POST['email'])) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $password = $_POST['password'];

                    if ($password != $_POST['password_again']) {
                        echo '';
                    } elseif ($password == $_POST['password_again'] && mysqli_num_rows($query) == 0) {
                        $password_encode = md5($password);
                        mysqli_query($connect, "INSERT INTO users (`Name`, Email, Phone, Username, `Password`) VALUES ('$name', '$email', '$phone', '$username', '$password_encode')");
                        header("location: print_list.php");
                    }
                }
            }

            if (isset($_POST['click_cancel'])) {
                header('location: print_list.php');
            }
        ?>
    </body>
</html>