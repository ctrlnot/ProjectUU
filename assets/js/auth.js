$(document).ready(function() {
    $("#loginForm").submit(function(e) {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success: function(res) {
                if(res.success) {
                    alert("success!");
                    setTimeout(function(){
                        window.location.href = "http://localhost/ProjectUU/";
                    }, 1500);
                } else {
                    alert("nope :(");
                }
            }
        });
    });
});