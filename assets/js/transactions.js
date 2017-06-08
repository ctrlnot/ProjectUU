$(document).ready(function() {
    $(function(){
        $("#name").autocomplete({
            source: "transactions/getName"
            // source: ["ton", "not", "pecho"]
        });
    });
});