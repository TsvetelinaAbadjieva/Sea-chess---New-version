
$(document).ready(function(){
    var page=1;
    var perPage=10;
    var prev=$('.prev');
    var next=$('.next');
    var current =$('.current');
    var showResults=$('#showResults');
    var results=$('#table2');
    prev.hide();
    current.hide();
    next.hide();

    showResults.click(function(e){

        e.preventDefault();
        $('.prev').show();
        $('.current').show();
        $('.current').text(page);
        $('.next').show();

        $.ajax({
            url:'http://mylocal.dev/MyPHP_files/seachess_Ajax/loadResults.php',
            dataType: 'json',
            type:'GET',
            data:page

        }).done(function(response){
            var totalRows=response.length;
            var totalPages=Math.ceil(totalRows/perPage);
            var offset =(totalPages-2)*perPage+(totalRows%perPage);
            page=totalPages;
            current.text(page);
            next.hide();
            prev.show();

            results.append('<tr><th>ID</th><th>Result</th></tr>');
            i=offset;
            $.each(response.slice(offset,totalRows),function(index,item) {

                //for(i in response.slice(offset,totalRows)) {
                //i=offset;
                results.append('<tr><td>' + response[i].id + '</td><td>' + response[i].result +  '</td></tr>').show(1000);
                $('#table2 tr:nth-child(even)').css({'backgroundColor': 'lightGrey', 'border': '1px solid blue'});
                i++;
                //}
            });
            $('#showResults').hide();
            $('#close').show();

        }).fail(function(){
            results.html('No data retrieved from DB');
        });

    });

    $('#close').click(function(){
        $('#showResults').fadeIn(1000);
        $('#close').hide();
    });

    function pager(totalPages){
        if(page<=1){
            page=1;
            prev.hide();
            current.text(1);
            next.show();
        }else if(page>totalPages){
            page=totalPages;
            next.hide();
            current.text(totalPages);
            prev.show();
        }else {
            current.text(page);
            prev.show();
            next.show();

        }

    }
    current.click(function(e){
        e.preventDefault();
        current.addClass('active');
    });

    prev.click(function(e){
        e.preventDefault();
        results.html('');
        page--;
        if(page>=1)
            current.text(page);
        else {
            page=1;
            current.text(1);
        }

        getResults(page);

    });

    next.click(function(e){
        e.preventDefault();
        results.html('');
        page++;
        current.text(page);
        if(page>1)
            prev.show();
        getResults(page);

    });

    function getResults(page){

        $.ajax({
            url:'http://mylocal.dev/MyPHP_files/seachess_Ajax/loadResults.php',
            dataType: 'json',
            type:'GET'


        }).done(function(response){

            length=response.length;
            totalPages=Math.ceil(length/perPage);
            var offset=(page-1)*perPage;

            results.append('<tr><th>ID</th><th>Result</th></tr>');
            //raboti $.each(response,function(index,item) {
            i=offset;
            $.each(response.slice(offset,offset+perPage),function(index,item) {

                //for(i in response.slice(offset,totalRows)) {
                results.append('<tr><td>' + response[i].id + '</td><td>' + response[i].result +  '</td></tr>').show(1000);
                $('#table2 tr:nth-child(even)').css({'backgroundColor': 'lightGrey', 'border': '1px solid blue'});
                i++;
                //}
            });
            pager(totalPages);
            // });
            showResults.hide();
            $('#close').show();

        }).fail(function(){
            results.html('No data retrieved from DB');
        });

    }
});
