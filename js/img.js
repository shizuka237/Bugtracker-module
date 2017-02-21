$('body').on('click ', '.show_pic', function () {
    // alert("2")
   $(this).find(".small").addClass("zoom");
   $(".img_overlay").show();
});

$("body").on("click",".img_overlay", function(){
    $(".small").removeClass("zoom");
    $(this).hide();
})
    