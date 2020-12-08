$(function(){
    $('#modelButton').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
});
$(function(){
        $('#ReplyButton').click(function (){
                $('.modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
        });

});



/* document.addEventListener('contextmenup', event => event.preventDefault());
 $(document).ready(function () {       
       //Disable cut copy paste
        $('body').bind('cut copy paste', function (e) {
            alert("cut copy paste functionalities are disabled for this page.");
            e.preventDefault();
        });       
    });
*/