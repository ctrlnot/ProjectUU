$(document).ready(function(){
    // ============ INITIAL TWEAKS ============ //

    $("input[type=date]").each(function() {
        if (this.type != 'date' ) $(this).datepicker();
    });

    $('form').bind('submit', function () {
        $(this).find('option').prop('disabled', false);
    });

    // ============ PASSWORD STRENGTH ============ //

    var result = $(".strength");
  
    $('#password').keyup(function(){
        $(".result").html(checkStrength($('#password').val()))
    })
 
    function checkStrength(password){
 
        //initial strength
        var strength = 0
        
        if (password.length == 0) {
            result.removeClass()
            return ''
        }
        //if the password length is less than 6, return message.
        if (password.length < 6) {
            result.removeClass()
            result.addClass('short')
            return 'too short'
        }
     
        //length is ok, lets continue.
     
        //if length is 8 characters or more, increase strength value
        if (password.length > 7) strength += 1
     
        //if password contains both lower and uppercase characters, increase strength value
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
     
        //if it has numbers and characters, increase strength value
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1
     
        //if it has one special character, increase strength value
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
     
        //if it has two special characters, increase strength value
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) strength += 1
     
        //now we have calculated strength value, we can return messages
     
        //if value is less than 2
        if (strength < 2) {
            result.removeClass()
            result.addClass('weak')
            return 'weak'
        } else if (strength == 2 ) {
            result.removeClass()
            result.addClass('good')
            return 'good'
        } else {
            result.removeClass()
            result.addClass('strong')
            return 'strong'
        }

    }

    // ============ START REGISTER JS ============ //

    $("#registrationForm").submit(function(e){
        e.preventDefault();
        $("h3.success").text("");
        $("h3.error").text("");
        
        var me = $(this);

        $.ajax({
            url: me.attr('action'), 
            type: 'post',
            data: me.serialize(),
            dataType: 'json',
            success: function(response){
                if(response.success == true){
                    $("h3.success").text("Thank you! You are now registered! Redirecting to login page...");
                    setTimeout(function(){ 
                        window.location.href = "http://amis.likesyou.org/login"; 
                    }, 1500);
                } else {
                    $("h3.error").text("Please check the input fields!");
                    $.each(response.messages, function(key, value){
                        if (key == "year" || key == "section") $("#" + key).css("border", "1px solid rgb(230, 97, 97) !important");
                        $("#" + key).css("border", "1px solid rgb(230, 97, 97)");
                        $("." + key + "Err").text(value).css({"color":"#c00",
                                                  "text-align":"center"});
                        if(value == ""){
                            $("#" + key + "Err").text("");
                            $("#" + key).css("border", "1px solid #404040");
                        }
                    });
                }
            }
        });
    });

    // ============ END REGISTER JS ============ //

    // ============ START LOGIN JS ============ //

    $("#formlogin").submit(function(e){
        e.preventDefault();

        var me = $(this);
        var studentnumber = $("input[name=studentNumber]").val();
        var password = $("input[name=password]").val();
        $("p.error").css("display", "none");

        $.ajax({
            url: me.attr('action'), 
            type: 'post',
            data: me.serialize(),
            dataType: 'json',
            success: function(response){
                if(response.message == 'active'){
                    var temp = response.path;
                    var link = temp.replace("/index.php", "");
                    if(temp == null) {
                        setTimeout(function(){
                            window.location.href = "http://amis.likesyou.org/";
                        }, 1500);
                    }
                    setTimeout(function(){
                        window.location.href = link;
                    }, 1500);
                } else if (response.message == 'inactive') {
                    $("p.error").css("display", "block").text("This account is inactive! Pay to ACCESS first to reactivate this account!");
                } else if (response.message == 'pending') {
                    $("p.error").css("display", "block").text("This account isn't yet paid!");
                } else if (response.message == 'invalid') {
                    $("p.error").css("display", "block").text("Invalid username or password!");
                }
            }
        });
    });

    // ============ END LOGIN JS ============ //

});