/**
 * Created by seyr on 24/08/16.
 */

$(document).ready(function() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];

    /*Subcategory combo dynamic*/
    $("#category_id").change(function(){
        $.ajax({
            type: "GET",
            url: base_url + "/public/combobox/subcategory/"+ $("#category_id").val(),

            success: function (data) {
                $("div#subcategory").html(data);
            }
        })
    })
    /*Member combo dynamic*/
    $("#family_id").change(function(){
        $.ajax({
            type: "GET",
            url: base_url + "/public/combobox/member/"+ $("#family_id").val(),

            success: function (data) {
                $("div#member").html(data);
            }
        })
    })
});