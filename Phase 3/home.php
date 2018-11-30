<?php
session_start();
?>

<html>
    <head>
        <title></title>
        <meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
    </head>
    <body>
        <form id='home' action='home.php' method='post' accept-charset='UTF-8'>
            <fieldset>
                <legend>Welcome! <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?> </legend>
                <input type='hidden' name='submitted' id='submitted' value='1'/>
                <fieldset>
                    <legend>Messages</legend>
                    <input type='submit' name='view' value='View Messages'/>
                    <br>
                    <input type='submit' name='send' value='Send A Message'/>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Profile</legend>
                    <input type='submit' name='updateInfo' value='Update Info'/>
                    <input type='submit' name='deleteInfo' value='Delete Account'/>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Management</legend>
                    <?php
                        if(($_SESSION['firstname'] == 'Peyton' && $_SESSION['lastname'] == 'Glynn') || ($_SESSION['firstname'] == 'Mitchell' && $_SESSION['lastname'] == 'Kuiper') || ($_SESSION['firstname'] == 'Florin' && $_SESSION['lastname'] == 'Rusu')) {
                            echo"<input type='submit' name='deleteUser' value='Delete Users'/><br>";
                        }
                    ?>
                    <input type='submit' name='category' value='Manage Categories'/>
                    <br>
                    <input type='submit' name='groups' value='Manage Groups'/>
                </fieldset>
                <br>
                <input type='submit' name='logout' value='Log Out'/>
            </fieldset>
        </form>
    </body>
</html>

<?php
// Makes sure our html has run
    if(isset($_POST['view'])) {
        header('Location: messages.php');
    }
    if(isset($_POST['send'])) {
        header('Location: message.php');
    }
    if(isset($_POST['updateInfo'])) {
        header('Location: updateInfo.php');
    }
    if(isset($_POST['logout'])) {
        header('Location: login.php');
    }
    if(isset($_POST['deleteUser'])) {
        header('Location: deleteUser.php');
    }
    if(isset($_POST['category'])) {
        header('Location: category.php');
    }
    if(isset($_POST['groups'])) {
        header('Location: groups.php');
    }
    if(isset($_POST['deleteInfo'])) {
        header('Location: deleteInfo.php');
    }
?>
