document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login");

    loginForm.addEventListener("submit", (e) => {
        console.log("credentials submitted");
        e.preventDefault();

        //Add GET command
    })

    document.querySelector("#forgotPassword").addEventListener("click", () => {
        console.log("password forgotten");
        //pull up forgot password screen
    })
})

