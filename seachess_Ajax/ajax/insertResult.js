$(document).ready(function(){
    var save=$('#save');
    var showResults=$('#showResults');

    save.on('click',function(e){
        e.preventDefault();
        var result= $('#result').val();

        $.ajax({
            url:'http://mylocal.dev/MyPHP_files/seachess_Ajax/saveResult.php',
            type:       'POST',
            data:       {'result':result},
            dataType:   'html'
        }).done(function(response){
            $('#table2').show(1300);
            $('#message').html(response);
            $('#message').show();
        }).fail(function(){
            $('#message').html('Error').show();
        });
        showResults.click();
        save.hide();
        //$("#table2").slideDown(1800);

});
});
