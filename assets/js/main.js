;(function($) {

  $('.dropdown-toggle').click(function() { 

    $('.dropdown').slideUp();
    $(this).next('.dropdown').slideToggle();
  });

  $(document).click(function(e) 
  { 
    var target = e.target; 
    if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle')) 
      { $('.dropdown').slideUp(); }
  });

  $('.btn__addServer').click(function(e) {

    $('.popup__addServer').addClass('open');

  });

  $('.popup__addServer .popup-overlay').click(function(e) {

    $('.popup__addServer').removeClass('open');

  });

  $("form#newServer").submit(function(e) {
    e.preventDefault(); 
    $("#msg").html('');


    var formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: '/ajax/new-server.php',
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.success) {
          $("#msg").html(response.msg);
          location.reload();
        }
        else {
          console.log(response.msg);
          $("#msg").html(response.msg);

        }
      },
    });


  });

  var catColor = $('#catColor');
  var catColorHex = $('#catColorHex');

  // Fonction pour mettre à jour la valeur des deux champs
  function updateColors() {
    var hexValue = catColorHex.val();

    if (hexValue.match(/^#[0-9a-fA-F]{6}$/)) { // Vérification de la validité de la couleur hexadécimale
      catColor.val(hexValue);
      $('.color-notify').text('');
    } else {
      $('.color-notify').text('La couleur hexadécimale saisie n\'est pas valide !');
    }
  }

  // Mise à jour du champ color lors de la saisie de la couleur hexadécimale
  catColorHex.on('input', function() {
    updateColors();
  });

  catColor.on('input', function() {
    var hexValue = $(this).val();
    catColorHex.val(hexValue);
  });
})(jQuery);