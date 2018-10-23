
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

function updateFormVisibility(){
    var participation = $("input[name=field-1]:checked");
    if (participation.val() === "Yes"){
        $("#participant-form").show();
    } else {
        $("#participant-form").hide();
    }

    if (participation.val() === "No"){
        $("#field-group-2").show();
    } else {
        $("#field-group-2").hide();
    }

    $("form input").each(function(){
        var input = $(this);
        var group = $(this).closest(".form-group");
        var condition = group.attr("data-condition");
        if (condition !== undefined && condition !== ""){
            group.hide();
            var inputId = condition.split(":")[0];
            var expectedValue = condition.split(":")[1];
            if ($("input[name=field-"+inputId+"]:checked").val() === expectedValue){
                group.show();
            } else {
                group.hide();
            }
        }

    });

}

$(document).ready(function () {
    $("input").on( "change", updateFormVisibility);
    updateFormVisibility();
});
