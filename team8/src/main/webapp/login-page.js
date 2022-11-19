document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login");
    const request = new XMLHttpRequest();

    loginForm.addEventListener("submit", (e) => {
        console.log("credentials submitted");
        e.preventDefault();
        const email = e.target.querySelector("#email").value;
        const password = e.target.querySelector("#password").value;
        console.log(email)
        console.log(password)
        //Add GET command
    })

    document.querySelector("#forgotPassword").addEventListener("click", () => {
        console.log("password forgotten");
        //pull up forgot password screen
    })
})

