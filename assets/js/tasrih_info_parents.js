//AVIS MARRIAGE  INFO/////////////////////////////////////////////////////
var husband_name = "";
var wife_name = "";
// Husband**********
$(document).ready(function() {
  load_data();
  function load_data(numero, annee) {
    $.ajax({
      url: "searchTasrihParentsInfo.php",
      method: "POST",
      dataType: "json",
      data: { numero: numero, annee: annee },
      success: function(data) {
        $("#prenom_nom_ar").replaceWith(
          `<div class="form-group label-floating" id="prenom_nom_ar">
        <label class="control-label m-label-form droid-arabic-kufi"> الإسم الشخصي و العائلي </label>
        <input type="text" name="nom_pere" id="nom_husb" value="` +
            data["prenom_ar"] +
            " " +
            data["nom_ar"] +
            `" class="form-control">
        </div>`
        );

        $("#date_naiss_hijri").replaceWith(
          `<div class="form-group label-floating" id="date_naiss_hijri">
                                             <label class="control-label m-label-form droid-arabic-kufi"> تاريخ ولادة الأب </label>
                                             <input type="text" name="date_naiss_pere_hijri" value="` +
            data["date_naiss_hijri_ar"] +
            `"  class="form-control " >
                                          </div>`
        );

        $("#date_naiss_miladi").replaceWith(
          `    <div class="form-group label-floating" id="date_naiss_miladi">
           <label class="control-label m-label-form droid-arabic-kufi"> الموافق ل </label>
                                             <input type="text" name="date_naiss_pere_miladi" value="` +
            data["date_naiss_miladi_ar"] +
            `" class="form-control">
                                          </div>`
        );

        $("#lieu_naiss").replaceWith(
          `<div class="form-group label-floating" id="lieu_naiss">
                                             <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
                                             <input type="text" name="lieu_naiss_pere" value="` +
            data["lieu_naiss_ar"] +
            `"  class="form-control">
                                          </div>`
        );
      }
    });
  }

  $("#numero_husband,#annee_husband").keyup(function() {
    var numero = $("#numero_husband").val();
    var annee = $("#annee_husband").val();
    console.log(numero + " " + annee);

    if (numero != "" && annee != "") {
      load_data(numero, annee);
    } else {
      load_data();
    }
  });
});

// Wife**********
$(document).ready(function() {
  load_data_wife();
  function load_data_wife(numero, annee) {
    $.ajax({
      url: "searchTasrihParentsInfo.php",
      method: "POST",
      dataType: "json",
      data: { numero: numero, annee: annee },
      success: function(data) {
        $("#prenom_nom_ar_wife").replaceWith(
          `<div class="form-group label-floating" id="prenom_nom_ar_wife">
                                            <label class="control-label m-label-form droid-arabic-kufi">الإسم </label>
                                            <input type="text" name="nom_mere"  value="` +
            data["prenom_ar"] +
            " " +
            data["nom_ar"] +
            `" class="form-control">
                                         </div>`
        );

        $("#date_naiss_wife_hijri").replaceWith(
          `<div class="form-group label-floating" id="date_naiss_wife_hijri">
                                            <label class="control-label m-label-form droid-arabic-kufi"> تاريخ ولادة الأم </label>
                                            <input type="text" name="date_naiss_mere_hijri"  value="` +
            data["date_naiss_hijri_ar"] +
            `" class="form-control " >
                                         </div>`
        );

        $("#date_naiss_wife_miladi").replaceWith(
          `<div class="form-group label-floating" id="date_naiss_wife_miladi">
                                            <label class="control-label m-label-form droid-arabic-kufi"> الموافق ل </label>
                                            <input type="text" name="date_naiss_mere_miladi" value="` +
            data["date_naiss_miladi_ar"] +
            `"  class="form-control">
                                         </div>`
        );

        $("#lieu_naiss_wife").replaceWith(
          `<div class="form-group label-floating" id="lieu_naiss_wife">
                                            <label class="control-label m-label-form droid-arabic-kufi">مكان الازدياد</label>
                                            <input type="text" name="lieu_naiss_mere" value="` +
            data["lieu_naiss_ar"] +
            `"  class="form-control">
                                         </div>`
        );
      }
    });
  }
  $("#numero_wife,#annee_wife").keyup(function() {
    var numero = $("#numero_wife").val();
    var annee = $("#annee_wife").val();
    console.log(numero + " " + annee);

    if (numero != "" && annee != "") {
      load_data_wife(numero, annee);
    } else {
      load_data_wife();
    }
  });
});
