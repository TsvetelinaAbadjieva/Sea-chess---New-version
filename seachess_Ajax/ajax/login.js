//document.ready(function(){


    $('form.ajax').on('submit',function(){
        var that=$(this),
            url=that.attr('action'),
            method=that.attr('method'),
            data={};

        that.find('[name]').each(function(index,value){
            var that=$(this),
                name=that.attr('name'),
                value=that.val();

            data[name]=value;
        });
        console.log(data);
        $.post(url,data, function(result){
            if(!result)
                window.location ='login.php';
            alert(result);
            $('#username').val(result['username']);
            $('#password').val(result['password']);

        });
/*
        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function(response){
                console.log(response);
                //clearFields();

            }

        });
        */
        return false;
    });
/*
 function clearFields(){
     $('form.ajax').find('[name]').each(function(){
         $(this).val('');
     })
 }
 */
//});