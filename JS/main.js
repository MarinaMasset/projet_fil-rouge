$(document).on("submit", "form", function (e) {
    e.preventDefault();

    let regexList = {
        email: /^[a-z]{2,}\.[a-z]{2,}@domaine\.com$/,
        pass: /^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/,
    };

    let formElements = $("form")[0];
    let error = false;
    $("small").text("");


    for (let i = 0; i < formElements.length - 1; i++) {
        if (formElements[i].type === "password") {
            $("#pass").removeClass("errorInput");

            const pattern = regexList.pass;

            if (pattern.test(formElements[i].value) === false) {
                error = true;
                $("#pass").addClass("errorInput");
                $("#" + $(formElements[i]).attr("aria-describedby")).html(
                    `<p class="errorMessage">${$(formElements[i]).attr(
                        "data-message"
                    )}</p>`
                );
            }
        }

        if (formElements[i].type === "email") {
            $("#login").removeClass("errorInput");
    
            const pattern = regexList.email;
    
            if (pattern.test(formElements[i].value) === false) {
                error = true;
                $("#login").addClass("errorInput");
                $("#" + $(formElements[i]).attr("aria-describedby")).html(
                    `<p class="errorMessage">${$(formElements[i]).attr(
                        "data-message"
                    )}</p>`
                );
            }
        }
    }
    if (!error) {
        $("form")[0].submit();
    }
});
