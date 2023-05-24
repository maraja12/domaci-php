//select
$(document).ready(function () {
  displayData();
});
function displayData() {
  var displayData = "true";
  $.ajax({
    url: "handler/select.php",
    type: "post",
    data: {
      displaySend: displayData,
    },
    success: function (data, status) {
      $("#displayDataTable").html(data);
    },
  });
}

//prikazi

function prikazi() {
  var x = document.getElementById("prikazi");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

//brisanje

$("#btn-delete").click(function () {
  const checked = $("input[type=radio]:checked");
  request = $.ajax({
    url: "handler/delete.php",
    type: "post",
    data: { id: checked.val() },
  });
  request.done(function (response, textStatus, jqXHR) {
    if (response === "Success") {
      checked.closest("tr").remove();
      console.log("The film is deleted");
    } else {
      console.log("The film is not deleted " + response);
      alert("The film is not deleted");
    }
  });
});

//dodavanje

$("#btnDodaj").submit(function () {
  $("myModal").modal("toggle");
  return false;
});

$("#dodajForm").submit(function () {
  event.preventDefault();

  const $form = $(this);
  const $inputs = $form.find("input, select, button");
  const serializedData = $form.serialize();
  console.log(serializedData);
  let obj = $form.serializeArray().reduce(function (json, { name, value }) {
    json[name] = value;
    return json;
  }, {});
  console.log(obj);
  $inputs.prop("disabled", true);

  request = $.ajax({
    url: "handler/add.php",
    type: "post",
    data: serializedData,
  });

  request.done(function (response, textStatus, jqXHR) {
    if (response === "Success") {
      console.log(obj);
      console.log("uspesno");

      appandRow(obj);
    } else {
      console.log("Film is not added");
      console.log(response);
    }
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("The following error occurred: " + textStatus, errorThrown);
  });
});

//izmena

// $("#btn-izmeni").click(function () {
//   console.log("usao sam");
//   const checked = $("input[name=checked-donut]:checked");

//   request = $.ajax({
//     url: "handler/get.php",
//     type: "post",
//     data: { id: checked.val() },
//     dataType: "json",
//   });

//   request.done(function (response, textStatus, jqXHR) {
//     console.log("Popunjena");
//     $("#name1").val(response[0]["name"]);
//     console.log(response[0]["name"]);
//     $("#genre1").val(response[0]["genre"].trim());
//     console.log(response[0]["genre"].trim());
//     $("#actors1").val(response[0]["actors"].trim());
//     console.log(response[0]["actors"].trim());
//     $("#duration1").val(response[0]["duration"].trim());
//     console.log(response[0]["duration"].trim());
//     $("#year1").val(response[0]["year"].trim());
//     console.log(response[0]["year"].trim());
//     $("#rate1").val(response[0]["rate"].trim());
//     console.log(response[0]["rate"].trim());
//     $("#review1").val(response[0]["review"].trim());
//     console.log(response[0]["review"].trim());
//     $("#idd").val(checked.val());

//     console.log(response);
//   });

//   request.fail(function (jqXHR, textStatus, errorThrown) {
//     console.error("The following error occurred: " + textStatus, errorThrown);
//   });
// });

// $("#izmeniForm").submit(function () {
//   event.preventDefault();
//   console.log("Izmena");
//   const $form = $(this);
//   const $inputs = $form.find("input, select, button");
//   const serializedData = $form.serialize();
//   console.log(serializedData);
//   let obj = $form.serializeArray().reduce(function (json, { name, value }) {
//     json[name] = value;
//     return json;
//   }, {});
//   console.log(obj);
//   $inputs.prop("disabled", true);

//   request = $.ajax({
//     url: "handler/update.php",
//     type: "post",
//     data: serializedData,
//   });

//   request.done(function (response, textStatus, jqXHR) {
//     if (response === "Success") {
//       console.log("Film is edited");
//       updateRow(obj);
//     } else console.log("Film is not edited " + response);
//     console.log(response);
//   });

//   request.fail(function (jqXHR, textStatus, errorThrown) {
//     console.error("The following error occurred: " + textStatus, errorThrown);
//   });
// });

// $("#btnIzmeni").submit(function () {
//   $("#myModal").modal("toggle");
//   return false;
// });

//funkcije

function appandRow(obj) {
  console.log("usao sam u fju");
  console.log(obj);
  var tab = document.getElementById("tabela");
  var lastRow = tab.rows.length;
  console.log(lastRow);

  $(tabela).find("tbody").append(`<tr>
  <td>

  <div class="image">
      <img class="image__img" src="images/starbig.png" alt="Star">
      <div class="image__overlay image__overlay--primary">
          <h1 style="font-size: 150px;">
              ${obj.rate}
          </h1>
         
      </div>

  </div>
</td>
<td style="align:center;">

<h1 style="color:gold;font-size: 60px;">
    ${obj.name}
    <br>
</h1>
<h3 style="color:white;">
<br>
GENRE: ${obj.genre}
<br>
STARS: ${obj.actors}
<br>
YEAR: ${obj.year}
<br>
DURATION: ${obj.duration}
</h3>

</td>
      <td>
                <label class="custom-radio-btn">
                    <input type="radio" name="checked-donut" value=${lastRow}>
                    <span class="checkmark"></span>
                </label>
            </td>
      </tr>`);
  console.log("zavrseno");
}

function funkcija(obj) {
  console.log("usao sam u appand");
}

function updateRow(obj) {
  console.log(obj);
  console.log(obj.id);
  console.log($(`#tabela tbody #tr-${obj.id} td`).get());
  let tds = $(`#tabela tbody #tr-${obj.id} td`).get();
  tds[1].textContent = obj.rate;
  tds[2].textContent = obj.name;
  tds[3].textContent = obj.genre;
  tds[4].textContent = obj.actors;
  tds[5].textContent = obj.year;
  tds[6].textContent = obj.duration;
}
