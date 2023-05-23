<?php
class Film
{
    public $id;
    public $name;
    public $genre;
    public $actors;
    public $duration;
    public $year;
    public $rate;

    public function __construct($id, $name, $genre, $actors, $duration, $year, $rate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->genre = $genre;
        $this->actors = $actors;
        $this->duration = $duration;
        $this->year = $year;
        $this->rate = $rate;

    }

    public function createFilm()
    {
        $host = 'localhost';
        $user = 'marija';
        $password = 'marija';
        $database = 'film_review';
        $conn = mysqli_connect($host, $user, $password, $database);

        $query = "INSERT INTO film(name, genre, actors, duration, year, rate)
            VALUES('$this->name', '$this->genre', '$this->actors', '$this->duration', 
            '$this->year', '$this->rate')";

        if (mysqli_query($conn, $query)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }


    public static function getAll(mysqli $conn)
    {
        $q = "SELECT * FROM film";
        return $conn->query($q);
    }

    public static function deleteById($id, mysqli $conn)
    {
        $q = "DELETE FROM film WHERE id = $id";
        return $conn->query($q);
    }

    public static function getById($id, mysqli $conn)
    {
        $q = "SELECT * FROM film WHERE id=$id";
        $myArray = array();
        if ($result = $conn->query($q)) {

            while ($row = $result->fetch_array(1)) {
                $myArray[] = $row;
            }
        }
        return $myArray;
    }

    public static function add($name, $genre, $actors, $duration, $year, $rate, mysqli $conn)
    {

        $q = "INSERT INTO film(name, genre, actors, duration, year, rate ) values
        ('$name', '$genre', '$actors',  '$duration', '$year', '$rate')";
        return $conn->query($q);


    }

    public static function update($id, $name, $genre, $actors, $duration, $year, $rate, mysqli $conn)
    {
        $q = "UPDATE film set name='$name', genre='$genre', actors='$actors', duration='$duration',
        year='$year', rate='$rate' where id=$id";
        return $conn->query($q);
    }


}
?>