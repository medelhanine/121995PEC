// solb**********
$(document).ready(function() {
  load_data();
  function load_data(numero, annee) {
    $.ajax({
      url: "searchTasrihDecesInfo.php",
      method: "POST",
      dataType: "json",
      data: { numero: numero, annee: annee },
      success: function(data) {
        $("#lieu_naiss").replaceWith(
          `<div class="form-group label-floating" id="lieu_naiss" >
                                           <label class="control-label m-label-form droid-arabic-kufi"> مكان الولادة </label>
                                           <input type="text" name="lieu_naiss" value="` +
            data["lieu_naiss_ar"] +
            `"  class="form-control">
                                        </div>`
        );

        $("#prenom_deces_fr").replaceWith(
          `<div class="form-group label-floating m-input-fr" id="prenom_deces_fr">
                                            <label class="control-label m-label-form">Prénom</label>
                                            <input type="text" name="prenom_deces_fr"  value="` +
            data["prenom"] +
            `" class="form-control">
                                         </div>`
        );

        $("#prenom_deces").replaceWith(
          `<div class="form-group label-floating" id="prenom_deces">
                                            <label class="control-label m-label-form droid-arabic-kufi"> الإسم الشخصي </label>
                                            <input type="text" name="prenom_deces" value="` +
            data["prenom_ar"] +
            `" class="form-control">
                                         </div>`
        );

        $("#nom_deces_fr").replaceWith(
          `<div class="form-group label-floating m-input-fr" id="nom_deces_fr">
                                             <label class="control-label m-label-form">Nom</label>
                                             <input type="text" name="nom_deces_fr" value="` +
            data["nom"] +
            `" class="form-control">
                                          </div>`
        );

        $("#nom_deces").replaceWith(
          `<div class="form-group label-floating" id="nom_deces">
                                             <label class="control-label m-label-form droid-arabic-kufi"> الإسم العائلي </label>
                                             <input type="text" name="nom_deces" value="` +
            data["nom_ar"] +
            `"  class="form-control">
                                          </div>`
        );

        $("#nationalite").replaceWith(
          `<div class="form-group label-floating" id="nationalite">
                                             <label class="control-label m-label-form droid-arabic-kufi"> جنسيته </label>
                                             <input type="text" name="nationalite" value="` +
            data["nationalite_ar"] +
            `" class="form-control">
                                          </div>`
        );

        $("#date_naiss_hijri").replaceWith(
          `<div class="form-group label-floating" id="date_naiss_hijri">
                                             <label class="control-label m-label-form droid-arabic-kufi"> المولود بتاريخ </label>
                                             <input type="text" name="date_naiss_hijri" value="` +
            data["date_naiss_hijri_ar"] +
            `" class="form-control">
                                          </div>`
        );

        $("#date_naiss_miladi").replaceWith(
          `<div class="form-group label-floating" id="date_naiss_miladi">
                                             <label class="control-label m-label-form droid-arabic-kufi"> موافق ل </label>
                                             <input type="text" name="date_naiss_miladi" value="` +
            data["date_naiss_miladi_ar"] +
            `" class="form-control">
                                          </div>`
        );

        $("#nom_pere").replaceWith(
          `<div class="form-group label-floating" id="nom_pere">
                                             <label class="control-label m-label-form droid-arabic-kufi">الإسم </label>
                                             <input type="text" name="nom_pere"  value="` +
            data["nom_pere_ar"] +
            `" class="form-control">
                                          </div>`
        );

        $("#date_naiss_pere_hijri").replaceWith(
          `<div class="form-group label-floating" id="date_naiss_pere_hijri">
                                             <label class="control-label m-label-form droid-arabic-kufi"> تاريخ ولادة الأب </label>
                                             <input type="text" name="date_naiss_pere_hijri" value="` +
            data["date_naiss_pere_hijri_ar"] +
            `" class="form-control " >
                                          </div>`
        );

        $("#date_naiss_pere_miladi").replaceWith(
          `<div class="form-group label-floating" id="date_naiss_pere_miladi ">
                                             <label class="control-label m-label-form droid-arabic-kufi"> الموافق ل </label>
                                             <input type="text" name="date_naiss_pere_miladi" value="` +
            data["date_naiss_pere_miladi_ar"] +
            `" class="form-control">
                                          </div>`
        );

        $("#nationalite_pere").replaceWith(
          `<div class="form-group label-floating" id="nationalite_pere">
                                            <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                            <input type="text" name="nationalite_pere" value="` +
            data["nationalite_pere_ar"] +
            `" class="form-control">
                                         </div>`
        );

        $("#adresse_pere").replaceWith(
          `<div class="form-group label-floating" id="adresse_pere">
                                             <label class="control-label m-label-form droid-arabic-kufi"> الساكن ب </label>
                                             <input type="text" name="adresse_pere" value="` +
            data["adresse_parent_ar"] +
            `" class="form-control">
                                          </div>`
        );

        $("#profession_pere").replaceWith(
          `<div class="form-group label-floating" id="profession_pere">
                                             <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
                                             <input type="text" name="profession_pere" value="` +
            data["profession_pere_ar"] +
            `" class="form-control">
                                          </div>`
        );

        $("#nom_mere").replaceWith(
          `<div class="form-group label-floating" id="nom_mere">
                                            <label class="control-label m-label-form droid-arabic-kufi">الإسم </label>
                                            <input type="text" name="nom_mere"  value="` +
            data["nom_mere_ar"] +
            `" class="form-control">
                                         </div>`
        );

        $("#date_naiss_mere_hijri").replaceWith(
          `<div class="form-group label-floating" id="date_naiss_mere_hijri">
                                            <label class="control-label m-label-form droid-arabic-kufi"> تاريخ ولادة الأم </label>
                                            <input type="text" name="date_naiss_mere_hijri" value="` +
            data["date_naiss_mere_hijri_ar"] +
            `" class="form-control " >
                                         </div>`
        );

        $("#date_naiss_mere_miladi").replaceWith(
          `<div class="form-group label-floating" id="date_naiss_mere_miladi">
                                            <label class="control-label m-label-form droid-arabic-kufi"> الموافق ل </label>
                                            <input type="text" name="date_naiss_mere_miladi" value="` +
            data["date_naiss_mere_miladi_ar"] +
            `" class="form-control">
                                         </div>`
        );

        $("#nationalite_mere").replaceWith(
          `<div class="form-group label-floating" id="nationalite_mere">
                                           <label class="control-label m-label-form droid-arabic-kufi">الجنسية</label>
                                           <input type="text" name="nationalite_mere" value="` +
            data["nationalite_mere_ar"] +
            `" class="form-control">
                                        </div>`
        );

        $("#adresse_mere").replaceWith(
          `<div class="form-group label-floating" id="adresse_mere">
                                            <label class="control-label m-label-form droid-arabic-kufi"> الساكنة ب </label>
                                            <input type="text" name="adresse_mere" value="` +
            data["adresse_parent_ar"] +
            `" class="form-control">
                                         </div>`
        );

        $("#profession_mere").replaceWith(
          `<div class="form-group label-floating" id="profession_mere">
                                            <label class="control-label m-label-form droid-arabic-kufi">المهنة </label>
                                            <input type="text" name="profession_mere" value="` +
            data["profession_mere_ar"] +
            `" class="form-control">
                                         </div>`
        );
      }
    });
  }

  $("#numero_deces,#annee_deces").keyup(function() {
    var numero = $("#numero_deces").val();
    var annee = $("#annee_deces").val();
    console.log(numero + " " + annee);

    if (numero != "" && annee != "") {
      load_data(numero, annee);
    } else {
      load_data();
    }
  });
});
