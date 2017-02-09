$(function(){
    $("#inscription").submit(function(){
 
        valid = true;
 
        // Pour le pseudo
        if($("#pseudo").val() == ""){
            $("#pseudo").next(".error-input").fadeIn().text("Veuillez entrer votre pseudo.");
            valid = false;
        }
        else if(!$("#pseudo").val().match(/^[a-z0-9A-Z._-]+$/)) {
            $("#pseudo").next(".error-input").fadeIn().html("Le pseudo n'est pas au format valide.<br>Test");
            valid = false;
        }
        else
        {
            $("#pseudo").next(".error-input").fadeOut();
        }
 
        if($("#pseudo").val().length > 40){
            $("#pseudo").next(".error-input").fadeIn().text("La taille du pseudo doit être comprise entre 2 et 40 caractères.");
            valid = false;
        }
 
        if($("#pseudo").val().length < 2){
            $("#pseudo").next(".error-input").fadeIn().text("La taille du pseudo doit être comprise entre 2 et 40 caractères.");
            valid = false;
        }
 
        // Pour le mot de passe
        if($("#password").val() == ""){
            $("#password").next(".error-input").fadeIn().text("Veuillez entrer votre mot de passe.");
            valid = false;
        }
        else if(!$("#password").val().match(/^[a-z0-9A-Z._-]+$/)) {
            $("#password").next(".error-input").fadeIn().text("Le mot de passe n'est pas au format valide.");
            valid = false;
        }
        else
        {
            $("#password").next(".error-input").fadeOut();
        }
 
        if($("#password").val().length > 40){
            $("#password").next(".error-input").fadeIn().text("La taille du mot de passe doit être comprise entre 2 et 40 caractères.");
            valid = false;
        }
 
        if($("#password").val().length < 2){
            $("#password").next(".error-input").fadeIn().text("La taille du mot de passe doit être comprise entre 2 et 40 caractères.");
            valid = false;
        }
 
        // Pour la confirmation
        if($("#confirmation").val() == ""){
            $("#confirmation").next(".error-input").fadeIn().text("Veuillez entrer la confirmation de mot de passe.");
            valid = false;
        }
        else if(!$("#confirmation").val().match(/^[a-z0-9A-Z._-]+$/)) {
            $("#confirmation").next(".error-input").fadeIn().text("La confirmation du mot de passe n'est pas au format valide.");
            valid = false;
        }
        else
        {
            $("#confirmation").next(".error-input").fadeOut();
        }
 
        if($("#confirmation").val() != $("#password").val()) {
            $("#confirmation").next(".error-input").fadeIn().text("Le mot de passe de confirmation doit être identique au mot de passe.");
            valid = false;
        }
 
        // Pour l'email'
        if($("#email").val() == ""){
            $("#email").next(".error-input").fadeIn().text("Veuillez entrer un email.");
            valid = false;
        }
        else if(!$("#email").val().match(/^[a-z0-9._-]+@[a-z0-9.-]{2,}[.][a-z]{2,4}$/)) {
            $("#email").next(".error-input").fadeIn().text("L'email n'est pas au format valide.");
            valid = false;
        }
        else
        {
            $("#email").next(".error-input").fadeOut();
        }
 
        // Pour les conditions
        var $conditions = $('input[name=conditions]');
        if($conditions.is(':checked')) {
            $conditions.next('.error-input').fadeOut();
        }
        else {
            $conditions.next('.error-input').fadeIn().text('Vous devez accepter les conditions d\'utilisation.');
            valid = false;
        }
        return valid;
    });
});