<?php require_once "common/header.php";?>

<?php
//require_once("common/init.php");
checkLogin();
showFlash();
unset ($_SESSION['flash']);

$url="game.php";
if(isset($_POST['logout'])) logout();




$matrix=isset($_GET['matrix'])?(int)htmlspecialchars(trim($_GET['matrix']),3):3;





?>

<div class="row map">
    <div class="border col-md-12 col-xs-12 col-sm-12">
    <div class="row "><div class="col-md-12 col-xs-12 col-sm-12 frame"><h1>Sea Chess</h1></div></div>

    <div class="col-md-9  col-xs-12 col-sm-12">

            <div class="col-md-9 col-xs-12 col-sm-12">
                <ul class="gamers">
                    <li><label for="" style="font-size:20px; color:limegreen; font-family: Gabriola; margin-top:15px;">Gamer with "X" turns first. Click the button 'X' to switch the order</label></li>
                    <li><button class="button button2 gbutton" id="#gbutton" value="X">X</button><input  id="gtext" type="text" value="X - <?php echo $_SESSION['username']; ?>"  disabled class="labels" style="margin-left:0px;"></li>
                    <li><button class="button button2 rbutton" id="#rbutton" value="O">O</button><input  id="rtext" type="text" value="O - Robot" disabled class="labels"style="margin-left:0px;"></li>
                </ul>
            </div>

    </div>
    <div class="col-md-3  col-xs-6 col-sm-6">
        <div>
            <button class="btn btn-logout" type="submit" name="logout" value="Logout"><span><a href="login.php">Logout</a> </span></button>
        </div>
        <div style="float:right; padding-top:10px;">
            <label for="" class="username" >Username:  </label>
            <label class="user" style="float:right;"><?php echo $_SESSION['username']; ?></label>

        </div>
    </div>


        <div class="">


            <div class="col-md-9 col-xs-12 col-sm-12">
                <form action="" method="post">

                    <table class="table" style="margin-left:-10px;">
                        <?php
                        $total_rows=$matrix;
                        $count=1;

                        for($i=1;$i<=$total_rows;$i++) {?>
                            <tr>
                                <?php for($j=1;$j<=$total_rows;$j++) {?>
                                    <td><input class="box" type="text" value="" name="cell" id="<?php echo $count; ?>"></td>
                                <?php $count++;} ?>
                            </tr>
                        <?php } ?>
                    </table>

                    <div class="row">
                        <label for="">Result</label>
                        <input type="text" name="result" id="result" class="result" value="" readonly>
                        <button class="reset save" id="save" name="save" hidden>Save</button>
                        <button class="reset" id="reset" name="reset"hidden>Reset</button>
                    </div>

                    <div class="row col-md-9 col-xs-12 col-sm-12">
                            <div class="gamer col-md-5 col-xs-3" id="gamerwin" hidden><span><?php echo $_SESSION['username']; ?>, you win on your <label for="" id="gamerStep"></label> step</span></div>
                            <div class="robot col-md-5 col-xs-3" id="robotwin" hidden><span>Robot is winner on his <label for="" id="robotStep"></label> step</span></div>
                            <div class="nowinner col-md-5 col-xs-3" id="nowinner"hidden ><span>No one, is winner. Try again! </span></div>
                            <div class="nowinner col-md-5 col-xs-3" id="message" hidden ><span><?php echo $message; ?> </span></div>
                    </div>
                    <div id="message"></div>

                </form>

            </div>

            <aside class="asside col-md-3 col-xs-5 col-sm-5 border">
                <div class="" >
                    <form action="game.php?=<?php echo $matrix ?>" method="get">
                        <label class="matrix" for="dimensions" style="float:left;margin-top:15px;">Matrix dimension </label>

                        <select name="matrix" id="matrix"  class="btn btn-default dropdown-toggle btn1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top:7px; margin-bottom:7px;  float:right;" onchange="this.form.submit()">
                            <option  value="3" selected>3 X 3</option>
                            <option  value="4" <?php echo (isset($matrix) && ($matrix=='4'))?'selected':''; ?>>4 X 4</option>
                            <option  value="5" <?php echo (isset($matrix) && ($matrix=='5'))?'selected':''; ?>>5 X 5</option>
                            <option  value="6" <?php echo (isset($matrix) && ($matrix=='6'))?'selected':''; ?>>6 X 6</option>
                            <option  value="7" <?php echo (isset($matrix) && ($matrix=='7'))?'selected':''; ?>>7 X 7</option>
                            <option  value="8" <?php echo (isset($matrix) && ($matrix=='8'))?'selected':''; ?>>8 X 8</option>
                            <option  value="9" <?php echo (isset($matrix) && ($matrix=='9'))?'selected':''; ?>>9 X 9</option>
                        </select>

                    </form>
                    <div>
                        <button  id="showResults" type="button" class="button button2 col-xs-3 col-sm-3" style="width:250px; height:38px; font-size:12px; float:right; padding-bottom:5px;">Show results</button>

                    </div>


                </div>
                <div>

                    <table class="table hover table-condensed table-bordered" hidden id="table2">

                    </table>

                </div>
                <div>
                    <ul class="pager">
                        <li><a href=""class="prev" id="">Prev</a></li>
                        <li><a href=""class="current" id=""></a></li>
                        <li><a href="" class="next" id="">Next</a></li>
                    </ul>
                </div>
                <div id="close" hidden><a type="button" href="">Close table</a></div>
                <div class="message">

                </div>

            </aside>

        </div>

        <div class="row "><div class="col-md-12 col-xs-12 col-sm-12 frame"></div></div>
</div>
</div>

    <script type="text/javascript" src="ajax/loadData.js"></script>
    <script type="text/javascript" src="ajax/insertResult.js"></script>
    <script src="js/game.js"></script>

<?php require_once "common/footer.php"?>