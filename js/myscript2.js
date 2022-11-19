$(document).ready(function(){
      $('ul li#link').click(function(){
        $('ul li#link').removeClass("active");
        $(this).addClass("active");
    });
});

// change to voucher mode
function myTipe() {
    var inputTipe = document.getElementById("inputTipe").value;
    var inputPassword = document.getElementById("inputPassword");
    var labelPassword = document.getElementById("labelPassword");

    if (inputTipe == "voucher") {
        inputPassword.type = "hidden";
        labelPassword.style.display = "none";
    } else {
        inputPassword.type = "password";
        inputPassword.placeholder = "Password";
        labelPassword.style.display = "block";
    }
}
