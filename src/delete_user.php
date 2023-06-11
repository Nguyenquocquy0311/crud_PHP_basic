<!DOCTYPE html>
<html>
    <head>
        <title>Delete user</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <?php
            include 'connect_database.php';

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = mysqli_query($connect, "SELECT * FROM `users` WHERE id='$id'");

                if (mysqli_num_rows($query) > 0) {
                    $row = mysqli_fetch_assoc($query);
                    echo '<h1>Delete user</h1>';
                    echo 'Do you want to delete <b style="color:red">' . $row['username'] . '</b>?</br>';
                    
                    if (isset($_POST['agree'])) {
                        //echo $_POST['agree'];
                        mysqli_query($connect, "UPDATE `users` SET delete_flg = '1' where id ='$id'");
                        header('Location: print_list.php');
                    }

                    if (isset($_POST['cancel_delete'])) {
                        header('Location: print_list.php');
                    }
                } else {
                    header('location: error.php');
                }
            } else {
                header('location: error.php');
            }
        ?>
        <form method="POST" action="">
            <br>
            <tr>
                <td><button type="submit" name="agree" >Agree</button>
                <button type="submit" name="cancel_delete" >Cancel</button></td>
            </tr>
        </form>
    </body>
</html>