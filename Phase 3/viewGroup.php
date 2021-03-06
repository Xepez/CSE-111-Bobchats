<?php
session_start();
?>

<html>
    <head>
        <title></title>
        <meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
    </head>
    <body>
        <form id='return_home' action='viewAttach.php' method='post' accept-charset='UTF-8'>
            <input type='submit' name='home' value='Home'/>
        </form>
        <br>
        YOUR GROUPS:
        <br>
        <br>
        <?php
            include_once 'test_con.php';
            
            // Connects to the database
            $pdo = connect();
            
            $uid = $_SESSION['userID'];
            
            try {
                $group_query = $pdo->prepare("SELECT groups.group_id, group_name, cat_id FROM groups, user_group WHERE groups.group_id = user_group.group_id AND user_id = ?;");

                $group_query->bindParam(1, $uid);
                
                $group_query->execute();
                
                $result = $group_query->fetchAll();
            } catch(PDOException $e) {
                echo $e;
            }
            
            foreach($result as $group) {
                
                try {
                    $cat_query = $pdo->prepare("SELECT DISTINCT c_name FROM category WHERE cat_id = ?;");
                    
                    $cat_query->bindParam(1, $group["cat_id"]);
                    
                    $cat_query->execute();
                    
                    $cat_name = $cat_query->fetchColumn();
                } catch(PDOException $e) {
                    echo $e;
                }
                
                if ($cat_name != null) {
                    echo $group["group_name"] . " (" . $cat_name . ")<br> ---------------------------------------------------- <br>";
                }
                else {
                    echo $group["group_name"] . " (No Category)<br> ---------------------------------------------------- <br>";
                }

                try {
                    $user_group_query = $pdo->prepare("SELECT user_id FROM user_group WHERE group_id = ?;");
                    
                    $user_group_query->bindParam(1, $group["group_id"]);

                    $user_group_query->execute();

                    $ug = $user_group_query->fetchAll();
                } catch(PDOException $e) {
                    echo $e;
                }
                
                $count = 0;

                foreach($ug as $user_group) {
                    try {
                        $user_query = $pdo->prepare("SELECT first_name, last_name FROM user WHERE user_id = ?;");
                        
                        $user_query->bindParam(1, $user_group["user_id"]);
                        
                        $user_query->execute();
                        
                        $user = $user_query->fetchAll();
                        
                        echo ($count++) . ". " . $user[0]["first_name"] . " " . $user[0]["last_name"] . "<br>";
                    } catch(PDOException $e) {
                        echo $e;
                    }
                }
                echo "<br>";
            }
        ?>
    </body>
</html>
<?php
    if (isset($_POST['home']))
        header('Location: home.php');
?>
