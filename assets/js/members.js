$(document).ready(function() {
    $('input.currency').currencyInput();

    $("#memberForm").submit(function(e) {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            dataType: 'json',
            success: function(res) {
                if(res) {
                    $('p.response').text("Member Inserted!").css('color', 'green');
                    setTimeout(function(){ 
                        window.location.reload();
                    }, 1000);
                } else {
                    $('p.response').text("Something went wrong :(").css('color', 'red');
                }
            }
        });
    });
});

(function($) {
    $.fn.currencyInput = function() {
        this.each(function() {
            $(this).change(function() {
                var min = parseFloat($(this).attr("min"));
                var max = parseFloat($(this).attr("max"));
                var value = this.valueAsNumber;

                if(value < min)
                    value = min;
                else if(value > max)
                    value = max;

                $(this).val(value.toFixed(2)); 
            });

        });
    };
})(jQuery);
