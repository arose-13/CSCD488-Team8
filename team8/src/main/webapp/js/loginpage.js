document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login"); //type form element
    const request = new XMLHttpRequest();

    const createAccountButton = document.getElementById("createAccount");//input element
    const forgotPasswordButton = document.getElementById("forgotPassword");

    createAccountButton.addEventListener("click", function () {
        window.location.href = "html/signup.html";
    })

    forgotPasswordButton.addEventListener("click", function () {
        window.location.href = "html/passwordrecovery.html";
    })

    loginForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const email = e.target.querySelector("#email").value;
        const password = e.target.querySelector("#password").value;
        console.log("email: " + email)
        console.log("password: " + password)
    })
})

