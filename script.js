$(document).ready(function () {
    $("#buyButton").click(function () {
        $("#paymentForm").show();
    });

    $("#paymentInfoForm").submit(function (event) {
        event.preventDefault();

        // Collect user information
        var name = $("#name").val();
        var email = $("#email").val();
        var address = $("#address").val();
        var city = $("#city").val();
        var state = $("#state").val();
        var zip = $("#zip").val();
        var county = $("#county").val();
        var phone = $("#phone").val();

        // Call a backend API to initiate PayPal payment
        $.ajax({
            url: "backend.php",
            method: "POST",
            data: {
                name: name,
                email: email,
                address: address,
                city: city,
                state: state,
                zip: zip,
                county: county,
                phone: phone
            },
            success: function (response) {
                // Redirect to PayPal for payment
                window.location.href = response.redirectUrl;
            },
            error: function () {
                alert("Error processing payment. Please try again.");
            }
        });
    });
});
