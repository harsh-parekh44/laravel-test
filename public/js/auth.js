$(document).ready(function () {

    // REGISTER AJAX
    $("#registerForm").submit(function (e) {
        e.preventDefault();

        $(".text-danger").text(""); // clear previous errors
        $("#registerMsg").html("");  // clear previous messages

        var isValid = true;

        var name = $("#name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var dob = $("#dob").val();
        var phone_number = $("#phone_number").val();
        var gender = $("#gender").val();

        // FRONTEND VALIDATION
        if(name === ""){
            $("#nameError").text("Name is required");
            isValid = false;
        }
        if(email === ""){
            $("#emailError").text("Email is required");
            isValid = false;
        }
        if(password.length < 6 ){
            $("#passwordError").text("Password must be at least 6 characters");
            isValid = false;
        }
        if(dob == "" || new Date(dob) > new Date()){
            $("#dobError").text("Date of birth is required and must be in the past");
            isValid = false;
        }
        if(phone_number === ""){
            $("#phone_numberError").text("Phone number is required");
            isValid = false;
        }
        if(!gender){
            $("#genderError").text("Gender is required");
            isValid = false;
        }
        if(!isValid) return false;

        // AJAX POST
        $.ajax({
            url: "/register",
            type: "POST",
            data: $(this).serialize(),
            success: function (res) {
                if(res.status === "success"){
                    alert("Registered Successfully");
                    window.location.href = "/dashboard";
                }
            },
            error: function (xhr) {
                if(xhr.status === 422){
                    // Laravel validation errors
                    let errors = xhr.responseJSON.errors;
                    if(errors.name) $("#nameError").text(errors.name[0]);
                    if(errors.email) $("#emailError").text(errors.email[0]);
                    if(errors.password) $("#passwordError").text(errors.password[0]);
                    if(errors.dob) $("#dobError").text(errors.dob[0]);
                    if(errors.phone_number) $("#phone_numberError").text(errors.phone_number[0]);
                    if(errors.gender) $("#genderError").text(errors.gender[0]);
                } else {
                    let msg = xhr.responseJSON?.message ?? "Something went wrong";
                    $("#registerMsg").html('<div class="alert alert-danger">'+ msg +'</div>');
                }
            }
        });
    });


    // LOGIN AJAX
    $("#loginForm").submit(function (e) {
        e.preventDefault();

        $(".text-danger").text(""); // clear previous errors
        $("#loginMsg").html("");     // clear previous messages

        var isValid = true;

        var email = $("#email").val();
        var password = $("#password").val();

        if(email === ""){
            $("#emailError").text("Email is required");
            isValid = false;
        }
        if(password === ""){
            $("#passwordError").text("Password is required");
            isValid = false;
        }
        if(!isValid) return false;

        $.ajax({
            url: "/login",
            type: "POST",
            data: $(this).serialize(),
            success: function (res) {
                if(res.status === "success"){
                    window.location.href = "/dashboard";
                }
            },
            error: function (xhr) {
                let msg = xhr.responseJSON?.message ?? "Invalid Email or Password";
                $("#loginMsg").html('<div class="alert alert-danger">'+ msg +'</div>');
            }
        }); 
    });

});