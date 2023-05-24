<?php
require "../db/dbBroker.php";
require "../model/Film.php";

if (isset($_POST['displaySend'])) {
    $tabela = '<table id="tabela" class="table sortable" style="margin-left:auto; margin-right:auto; text-align:center;width:80%">
    <thead>
            <tr>
                <th scope="col" style="color:white"><b><big>RAITING<b><big></th>
                <th scope="col" style="color:white"><b><big>ABOUT FILM<b><big></th>
                <th scope="col" style="color:white"><b><big>CHOOSE ONE<b><big></th>

            </tr>
        </thead>';

    // <tbody>

    // </tbody>;

    $podaci = Film::getAll($conn);
    $rbr = 1;

    while ($red = $podaci->fetch_array()) {
        $id = $red['id'];
        $rate = $red['rate'];
        $name = $red['name'];
        $genre = $red['genre'];
        $actors = $red['actors'];
        $year = $red['year'];
        $duration = $red['duration'];
        $tabela .=
            '<tr id="tr-' . $id . '">
            <td>

                <div class="image">
                    <img class="image__img" src="images/starbig.png" alt="Star">
                    <div class="image__overlay image__overlay--primary">
                        <h1 style="font-size: 150px;">
                        ' . $rate . '
                        </h1>
                    </div>

                </div>
            </td>

            <td style="align:center;">

                <h1 style="color:gold;font-size: 60px;">
                ' . $name . '
                    <br>
                </h1>
                <h3 style="color:white;">
                    <br>
                    GENRE: ' . $genre . '
                    
                    <br>
                    ACTORS: ' . $actors . '
                   
                    <br>
                    YEAR: ' . $year . '
                    <br>
                    DURATION: ' . $duration . '


                </h3>
            </td>

            <td>
                <label class="radio-btn">
                    <input type="radio" name="checked-donut" value=' . $id . '>
                    <span class="checkmark"></span>
                </label>
            </td>


        </tr>';

    }
    $tabela .= '</table>';
    echo $tabela;
}


?>