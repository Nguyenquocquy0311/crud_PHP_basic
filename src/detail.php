<!DOCTYPE html>
<html>
    <head>
        <title>User's infomation</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            td {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <h1>User's info</h1>
        <?php
            include 'connect_database.php';
            
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM users WHERE id = $id";
                $result = mysqli_query($connect, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                            <table>
                                <tr>
                                    <td>Name:</td>
                                    <td>' . $row['name'] . '</td>
                                </tr>
                                <tr>
                                    <td>Username:</td>
                                    <td>' . $row['username'] . '</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>' . $row['email'] . '<td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td>' . $row['phone'] . '<td>
                                </tr>
                            </table>';
                    }
                    echo '</br>';
                    echo '<a href="print_list.php">Back to list users</a>';
                } else {
                    header('location: error.php');
                }
            } else {
                header('location: error.php');
            }
        ?>
    </body>
</html>