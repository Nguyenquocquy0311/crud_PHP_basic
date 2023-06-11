<?php
    include 'connect_database.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>List users</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            table, td, tr {
                border-collapse: collapse;
                border: 1px solid black;
            }
            td {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <h1>List users</h1>
        <p><a href="add_users.php">Add new user</a><p>
        <form method="POST">
            <input type="text" name="search" value="<?php echo (!empty($_POST['search'])) ? $_POST['search'] : ''; ?>"/>
            <button type="submit" name="click_search" >Search</button>
            <button type="submit" name="click_reset" >Reset</button>
            <?php
                if (isset($_POST['click_reset'])) {
                    header('location: print_list.php');
                }
            ?>
        </form>
        <br>
        <table>
            <tr>
                <td align="center"><b>No</td>
                <td align="center"><b>Name</td>
                <td align="center"><b>Email</td>
                <td align="center"><b>Phone</td>
                <td align="center"><b>Username</td>
                <td align="center" colspan="3"><b>Action</td>
            </tr>
            <?php
                if (isset($_POST['click_search'])) {
                    $search = $_POST['search'];
                    $sqlSelect = "SELECT * FROM users WHERE delete_flg = 0 AND (`name` LIKE '%$search%'
                    OR `email` LIKE '%$search%' OR `username` LIKE '%$search%' OR `phone` LIKE '%$search%')";
                    $result = mysqli_query($connect, $sqlSelect);

                    if (mysqli_num_rows($result) > 0) {
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $count++;
                        echo '
                        <tr>
                            <td>'. $count . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>' . $row['username'] . '</td>
                            <td><a href="detail.php?id=' . $row['id'] . '">Detail</td>
                            <td><a href="edit_user.php?id=' . $row['id'] . '">Edit</td>
                            <td><a href="delete_user.php?id=' . $row['id'] . '">Delete</td>
                        </tr>';
                        }
                    } else {
                        echo '<h2 style="color:red">Empty List !</h2>';
                    }
                } elseif (!isset($_POST['click_search']) || isset($_POST['click_reset'])) {
                    $sql = "SELECT * FROM users WHERE delete_flg = 0";
                    $result = mysqli_query($connect, $sql);

                    if (mysqli_num_rows($result) > 0) {
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $count++;
                        echo '
                        <tr>
                            <td>'. $count . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>' . $row['username'] . '</td>
                            <td><a href="detail.php?id=' . $row['id'] . '">Detail</td>
                            <td><a href="edit_user.php?id=' . $row['id'] . '">Edit</td>
                            <td><a href="delete_user.php?id=' . $row['id'] . '">Delete</td>
                        </tr>';
                        }
                    }
                }
            ?>
        </table>
    </body>
</html>