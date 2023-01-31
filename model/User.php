<?php

class User
{
    public $id;
    public $email;
    public $username;
    public $password;


    public function __construct($id = null, $email = null, $username = null, $password = null)
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    public function createUser()
    {
        $host = 'localhost';
        $user = 'marija';
        $password = 'marija';
        $database = 'film_reviews';
        $conn = mysqli_connect($host, $user, $password, $database);

        $query = "INSERT INTO user(email, username, password) 
            VALUES('$this->email', '$this->username', '$this->password')";

        if (mysqli_query($conn, $query)) {
            header('Location: login.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }

}
?>