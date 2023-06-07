var eye = document.getElementById('eye');
var input = domcument.getElementById('Input');

eye.addEventListener("click", function(){
    if(input.type == "password"){
        input.type = "text"
        eye.style.opacity=0.8
    }else{
        input.type = "password"
        eye.style.opacity = 0.2
    }
})
