<?php
class Film
{
    public $id;
    public $user_id;
    public $name;
    public $genre;
    public $actors;
    public $duration;
    public $year;
    public $rate;
    public $review;

    public function __construct($id, $user_id, $name, $genre, $actors, $duration, $year, $rate, $review)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->genre = $genre;
        $this->actors = $actors;
        $this->duration = $duration;
        $this->year = $year;
        $this->rate = $rate;
        $this->review = $review;
    }
    public function createFilm()
    {
        $host = 'localhost';
        $user = 'marija';
        $password = 'marija';
        $database = 'film_review';
        $conn = mysqli_connect($host, $user, $password, $database);

        $query = "INSERT INTO film(user_id, name, genre, actors, duration, year, rate, review)
            VALUES('$this->user_id', '$this->name', '$this->genre', '$this->actors', '$this->duration', 
            '$this->year', '$this->rate', '$this->review')";

        if (mysqli_query($conn, $query)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
?>