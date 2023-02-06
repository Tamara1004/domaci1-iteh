<?php

class User{
    public $id; 
    public $username;
    public $passw; 


/*konstruktor*/
public function __construct($id=null,$username=null, $passw=null)
{
    $this->id = $id;
    $this->username = $username;
    $this->passw = $passw;
}

public static function logInUser($usr, mysqli $conn) 
{
    $query = "SELECT * FROM user WHERE username='$usr->username' AND password='$usr->passw' ";
    return $conn->query($query);
}



}


?>
