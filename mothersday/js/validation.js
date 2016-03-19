function validate(){
var email = document.getElementById("inputEmail").value;
var password = document.getElementById("inputPassword").value;
var page = window.location.href = "upload.php";

if(email == ""){
    alert("Please enter a User Name")
    formLogin.email.focus()
    return false;
}
if(password == ""){
    alert("Please enter a Password")
    formLogin.password.focus()
    return false;
}
if( email == "testing@gmail.com" && password == "testing"){
    console.log("Login successfully");
    void(window.open("upload.php"));
    // window.open("/websites/mothersday/upload.php", "_blank");
    return false;
}
else{
 alert("Login failed - Only Donna M can log into this page")   
}
}