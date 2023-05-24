<?php

include('db/dbBroker.php');
require "model/User.php";
require "model/Film.php";

// $query = "SELECT * FROM film ORDER BY rate DESC";
// $result = mysqli_query($conn, $query);
// $films = mysqli_fetch_all($result, MYSQLI_ASSOC);
// mysqli_free_result($result);
$result = Film::getAll($conn);
if (!$result) {
    echo "Error with query<br>";
    die();
}
if ($result->num_rows == 0) {
    echo "No films";
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php');

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

<?php if ($loggedId != 0): ?>
    <div class="col-md-4" style="display: block">
        <div>
            <button id="btn-delete" class="btn btn-primary"
                style="width: 100px;height: 40px;margin-top: 10px;margin-left: 5px;">delete
                film</button>
        </div>
        <div>
            <button id="btn-dodaj" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#myModal"
                aria-expanded="false" aria-controls="myModal"
                style="width: 100px;height: 40px;text-align:center;margin-top: 5px;margin-left: 5px;">add film</button>
        </div>
        <!-- <div>
        <button id="btn-izmeni" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#izmeniModal"
            aria-expanded="false" aria-controls="izmeniModal"
            style="width: 100px;height: 40px;text-align:center;margin-top: 5px;margin-left: 5px;">update
            film</button>
    </div> -->
        <div>
            <button id="btn" class="btn btn-primary" onclick="prikazi()"
                style="width: 120px;height: 40px;text-align:center;margin-top: 5px;margin-left: 5px;">display films</button>
        </div>
    </div>

<?php endif; ?>

<div id="prikazi">
    <div id="displayDataTable"></div>

</div>



<!-- Modali -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!--Sadrzaj modala za add-->
        <div class="modal-content" style="border: 5px solid rgba(107, 75, 5, 0.811);padding: 30px 10px;">
            <div class="modal-header">
                <h2 id="naslov" style="color: brown;"><b>Add film</b></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form class="add-form" action="#" method="post" id="dodajForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name of film "
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="genre" class="form-control" placeholder="Genre "
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="actors" class="form-control" placeholder="Main actors"
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="duration" class="form-control" placeholder="Duration"
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input type="number" name="year" class="form-control" placeholder="Release year"
                                        value="" />
                                </div>
                                <div class="form-group">
                                    <input type="number" name="rate" class="form-control" placeholder="Rating"
                                        value="" />
                                </div>
                                <!-- <div class="form-group">
                                    <input type="text" name="review" class="form-control" placeholder="Review"
                                        value="" />
                                </div> -->

                                <div class="form-group">
                                    <button id="btnDodaj" type="submit" class="btn btn-success" style="width: 150px;
                text-align: center;"> Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>



<!--Modal za update-->
<div class="modal fade" id="izmeniModal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content" style="border: 5px solid rgba(107, 75, 5, 0.811);padding: 30px 10px;">
            <div class="modal-header">
                <h2 id="naslov" style="color: brown;"><b>Edit film</b></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form class="add-form" action="#" method="post" id="izmeniForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="idd" type="text" name="id" class="form-control"
                                        placeholder="Id of the film" value="" readonly />
                                </div>

                                <div class="form-group">
                                    <input id="name1" type="text" name="name" class="form-control"
                                        placeholder="Name of film " value="" />
                                </div>
                                <div class="form-group">
                                    <input id="genre1" type="text" name="genre" class="form-control"
                                        placeholder="Genre " value="" />
                                </div>
                                <div class="form-group">
                                    <input id="actors1" type="text" name="actors" class="form-control"
                                        placeholder="Main actors" value="" />
                                </div>
                                <div class="form-group">
                                    <input id="duration1" type="text" name="duration" class="form-control"
                                        placeholder="Duration" value="" />
                                </div>
                                <div class="form-group">
                                    <input id="year1" type="number" name="year" class="form-control"
                                        placeholder="Release year" value="" />
                                </div>
                                <div class="form-group">
                                    <input id="rate1" type="number" name="rate" class="form-control"
                                        placeholder="Rating" value="" />
                                </div>
                                <!-- <div class="form-group">
                                    <input id="review1" type="text" name="review" class="form-control"
                                        placeholder="Review" value="" />
                                </div> -->


                                <div class="form-group">
                                    <button id="btnIzmeni" type="submit" class="btn btn-success" style="width: 150px;
                text-align: center;"> Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>



<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
<script src="js/main.js"></script>



<script>
    function pretrazi() {

        var input, filter, table, tr, i, td1, td2, td3, td4, txtValue1, txtValue2, txtValue3, txtValue4;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("tabela");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td1 = tr[i].getElementsByTagName("td")[0];
            td2 = tr[i].getElementsByTagName("td")[1];
            if (td1 || td2) {
                txtValue1 = td1.textContent || td1.innerText;
                txtValue2 = td2.textContent || td2.innerText;
                if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1
                ) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }


    function sortTable() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("tabela");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[1];
                y = rows[i + 1].getElementsByTagName("TD")[1];
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }


</script>


<?php include('templates/footer.php'); ?>

</html>