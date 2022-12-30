
function callPhp(email) {
    jQuery.ajax({
        type: "POST",
        url: 'shellcommand.php',
        // dataType: 'json',
        data: {email: email},

        success: function (result) {
            //console.log("sent ajax request");
            console.log(result);
        },
        error: function() {
            console.log("error");
        }
    })
}

document.addEventListener("DOMContentLoaded", () => {
    const recoveryForm = document.querySelector("#passwordRecovery");
    const homeButton = document.getElementById("backHome");

    homeButton.addEventListener("click", () => {
        window.location.href = "login.html"; //go back home
    })

    recoveryForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const recoveryEmail = event.target.querySelector("#recoveryEmail").value; //get recovery email
        const myEmail = "nathannelsondude@gmail.com"
        callPhp(myEmail);
    })
}) 

