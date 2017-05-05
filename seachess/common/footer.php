<div class="col-md-12  col-xs-12 col-sm-12">
</div>
</div>

</div>
<script type="text/javascript">


    $(document).ready(function() {



        var symbol1=$('.gbutton').attr("value");
        var symbol2=$('.rbutton').attr('value');


        /* checking for existing horizontal line of equal symbols  in the matrix with dimension = n*/
        function check_horizontal_line(symbol,dimension){

            var limit=dimension;

            for(i=1;i<=limit;i++){
                var flag=true;
                for(j=1;j<=limit;j++)
                    if($('#'+((i-1)*dimension+j)).val()!= symbol){
                        flag=false;
                        break;
                    }
                if(flag) return true;
            }

            return flag;
        }

        /* checking for existing vertical line of equal symbols  in the matrix with dimension = n x n*/
        function check_vertical_line(symbol, dimension){

            var limit=dimension;
            for(i=1;i<=limit;i++){
                var flag=true;
                for(j=1;j<=limit;j++)
                    if($('#'+(i+(j-1)*dimension)).val() != symbol){
                        flag=false;
                        break;
                    }
                if(flag) return true;

            }
            return flag;
        }

        /*checking for existence of equal symbols in the main diagonal with indexes -11,22,33*/
        function chek_main_diagonal(symbol, dimension){

            var limit=dimension;

            var flag=true;
            for(i=1;i<=limit;i++){
                if($('#'+((i-1)*dimension+i)).val()!=symbol) {
                    flag = false;
                    break;
                }
            }
            return flag;
        }

        /*checking for exitence of equal elements in the second diagonal indexes - 13, 22, 31*/
        function check_second_diagonal(symbol,dimension){
            var limit=dimension;
            var flag=true;
            for(i=1;i<=limit;i++){
                if($('#'+(i*(dimension-1)+1)).val()!=symbol){
                    flag=false;
                    break;
                }

            }
            return flag;
        }
        /* final conclusion of existence or not existence of winner*/
        function winner_exists(symbol,dimension){

            if(check_vertical_line(symbol, dimension) || check_horizontal_line(symbol,dimension)
            || chek_main_diagonal(symbol, dimension) || check_second_diagonal(symbol,dimension))
                return true;
            return false;
        }

        $('.gbutton').on('click',function(){
            //var symbol1=$(this).attr("value");
           // alert(symbol1);
            if($(this).text()=='X') {
                $(this).text('O');
                $('.rbutton').text('X');
                $('#gtext').val('O - Gamer');
                $('#rtext').val('X - Robot');
                $(this).attr('value','O');
                $('.rbutton').attr('value','X');


            }else {
                $(this).text('X');
                $('.rbutton').text('O');
                $('#gtext').val('X - Gamer');
                $('#rtext').val('O - Robot');
                $(this).attr('value','X');
                $('.rbutton').attr('value','O').button('refresh');
                $(this).attr('value','X').button('refresh');
            }


        });


        counter=1;
        var gameover=false;
        var stepGamer=0;
        var stepRobot=0;
        var dimension=$('#matrix').val();
        if(dimension>4)
            $('.box').css({'width': '-=10', 'height':'-=10'});
        if(dimension>6)
            $('.box').css({'width': '-=15', 'height':'-=15'});

        $('.box')
            .focus(function () {
                symbol1=$('.gbutton').text();
                symbol2=$('.rbutton').text();

                if(winner_exists(symbol1,dimension)){
                    $('#gamerStep').text(stepGamer);
                    $('#gamerwin').show();
                    $('.reset').show();
                    $('#result').val('2').show();
                    gameover=true;

                }
                else if(winner_exists(symbol2,dimension)){
                    $('#robotStep').text(stepRobot);
                    $('#robotwin').show();
                    $('.reset').show();
                    $('#result').val('0').show();
                    gameover=true;

                }
                else {


                    if ( $(this).val() == '') {
                        stepGamer++;
                        $(this).val(symbol1);
                        $('#gtext').css({'backgroundColor': 'white'});
                        $('#rtext').css({'backgroundColor': 'powderblue'});
                        counter++;



                        var flag = false;
                        number = 0;
                        while (!flag && number<30) {
                            var index = Math.floor(Math.random() * Math.pow(dimension,2)) + 1;
                            if ($('#' + index).val() == '' || $('#' + index).val() == null) {
                                flag = true;
                                stepRobot++;
                                $('#' + index).val(symbol2).show();
                                break;
                            }
                            number++;
                        }
                        counter++;
                        setTimeout(function () {
                            $('#gtext').css({'backgroundColor': 'gold'});
                            $('#rtext').css({'backgroundColor': 'white'});
                        }, 1300);



                    }

                }//else

                if (!winner_exists(symbol1, dimension) && !winner_exists(symbol2, dimension) && (counter > Math.pow(dimension, 2) )) {
                    $('#nowinner').show();
                    $('.reset').show();
                    $('#result').val('1').show();
                }

                $('.reset').on('click',function(){
                    $(this).form.reset();
                });


            } );

    });




</script>
</body>
</html>
