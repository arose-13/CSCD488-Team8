document.addEventListener("DOMContentLoaded", () => {
    const createdCredentials = document.querySelector("#createdCredentials");
    const homeButton = document.getElementById("backHome");

    homeButton.addEventListener("click", () => {
        window.location.href="../login.html";
    })

    createdCredentials.addEventListener("submit", (event) => {
        event.preventDefault();
        const fname = event.target.querySelector("#fname").value;
        const lname = event.target.querySelector("#lname").value;
        const email = event.target.querySelector("#email").value;
        const password = event.target.querySelector("#password").value;
        console.log(fname);
        console.log(lname);
        console.log(email);
        console.log(password);
    })
})