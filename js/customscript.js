
      //$('[data-toggle="dropdown"]').bootstrapDropdownHover();
      $.fn.bootstrapDropdownHover();
      //$('#dropdownMenu1').bootstrapDropdownHover();
      //$('.navbar [data-toggle="dropdown"]').bootstrapDropdownHover();

      // demo for realtime configuration and destroy
      $('[data-toggle="tooltip"]').tooltip({container: 'body'});

      $('#setSticky').on('click', function () {
        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('setClickBehavior', 'sticky');
      });

      $('#setDefault').on('click', function () {
        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('setClickBehavior', 'default');
      });

      $('#setDisable').on('click', function () {
        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('setClickBehavior', 'disable');
      });

      $('#set1000').on('click', function () {
        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('setHideTimeout', 1000);
      });

      $('#set200').on('click', function () {
        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('setHideTimeout', 200);
      });

      $('#destroy').on('click', function () {
        $('[data-toggle="tooltip"]').tooltip('hide');
        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover('destroy');
        $('#destroy, #set200, #set1000, #setDisable, #setDefault, #setSticky').prop('disabled', 'disabled');
        $('#reinitialize').prop('disabled', false);
        $('.setdemo').addClass('destroyed');
      });

      $('#reinitialize').on('click', function () {
        $('[data-toggle="tooltip"]').tooltip('hide');
        $('.setdemo [data-toggle="dropdown"]').bootstrapDropdownHover();
        $('#destroy, #set200, #set1000, #setDisable, #setDefault, #setSticky').prop('disabled', false);
        $(this).prop('disabled', 'disabled');
        $('.setdemo').removeClass('destroyed');
      });
	  
	  jQuery(document).ready(function($) {
	   	$( "#recherche_liste_noir" ).autocomplete({
        source: 'blackliste_autocomplete.php'
		  });
    });
    jQuery(document).ready(function($) {
      $( "#recherche_liste_noir2" ).autocomplete({
        source: 'blackliste_autocomplete.php'
      });
    });
    jQuery(document).ready(function($) {
      $( "#recherche_guilde" ).autocomplete({
        source: 'guilde_autocomplete.php'
      });
    });
