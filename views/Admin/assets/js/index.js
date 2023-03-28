const senhaInput = document.getElementById("verpass");
const eyeSvg = document.getElementById("eyeSvg");
function eyeClick() {
    let inputTypesenha = senhaInput.type == "password"
    if (inputTypesenha) {
        mostrar()
    }
    else{
        esconder()
    }
}
function mostrar() {
    senhaInput.setAttribute("type", "text")
    eyeSvg.setAttribute("src", "../assets/img/eye1.svg")
}
function esconder() {
    senhaInput.setAttribute("type", "password")
    eyeSvg.setAttribute("src", "../assets/img/eye.svg")
}