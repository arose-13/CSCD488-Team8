document.addEventListener("DOMContentLoaded", () => {
    const recoveryEmail = document.querySelector("#passwordRecovery");
    const homeButton = document.getElementById("backHome");

    homeButton.addEventListener("click", () => {
        window.location.href = "login.html";
    })

    recoveryEmail.addEventListener("submit", (event) => {
        event.preventDefault();
        const recoveryEmail = event.target.querySelector("#recoveryPassword");
        console.log(recoveryEmail);
    })
})