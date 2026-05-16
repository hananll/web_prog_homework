<?php
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {
    try {
        $dbh = getDB();
        
        $sqlSelect = "select id from users where user_name = :username";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(':username' => $_POST['username']));
        if($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $message = "The username already exists!";
            $again = "true";
        }
        else {
            $sqlInsert = "insert into users(id, first_name, last_name, user_name, password)
                            values(0, :firstname, :lastname, :username, :password)";
            $stmt = $dbh->prepare($sqlInsert); 
            $stmt->execute(array(':firstname' => $_POST['firstname'], ':lastname' => $_POST['lastname'],
                                    ':username' => $_POST['username'], ':password' => sha1($_POST['password']))); 
            if($count = $stmt->rowCount()) {
                $newid = $dbh->lastInsertId();
                $message = "Your registration was successful.<br>ID: {$newid}";                     
                $again = false;
            }
            else {
                $message = "Your registration wasn't successful.";
                $again = true;
            }
        }
    }
    catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }      
}
else {
    header("Location: .");
}
?>