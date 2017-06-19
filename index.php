<?php
    include 'header.php';
?>
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <h4>Guest Book</h4>
            <?php
            include 'menu.php';
            ?>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
            </div>
        </div>

        <div class="col-sm-9">
            <h4><small>WELCOME!</small></h4>
            <hr>

            <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                <div class="form-group">

                    <label for="nickname">Nickname:</label>
                    <input type="text" name="nick" class="form-control" id="nickname" /><br/>

                    <label for="message">Message:</label>
                    <textarea name="msg" id="message" class="form-control" rows="3"/></textarea><br/>

                </div>

                <button type="submit" class="btn btn-success" name="button">Submit</button>
            </form>
            <br><br>

            <?php
            $nick=$msg="";
            $nickErr=$msgErr="";

            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(empty($_POST['nick'])){
                    $nickErr="<div class=\"alert alert-warning\"><strong>Warning!</strong> Nickname is required!</div>";
                    echo $nickErr;
                    echo "<br>";
                }
                if(empty($_POST['msg'])){
                    $msgErr="<div class=\"alert alert-warning\"><strong>Warning!</strong> Message is required!</div>";
                    echo $msgErr;
                    echo "<br>";
                }
                elseif(strlen($_POST['msg'])>10){
                    $msgErr="<div class=\"alert alert-warning\"><strong>Warning!</strong> Message cannot have more than 255 characters!</div>";
                    echo $msgErr;
                    echo "<br>";
                }
                else {
                    $myfile=fopen("guestbook.txt","a");
                    $txt=$_POST['nick']."(".date("d/M/y")."):"."\r\n".$_POST['msg']."\r\n"."\r\n";
                    fwrite($myfile,$txt);
                    fclose($myfile);

                    if(isset($_POST['button'])) {

                        echo "<div class=\"alert alert-success\">Successfull & Thanks</div>";
                        $doc=file_get_contents("guestbook.txt");
                        echo nl2br($doc);
                }}



            }


            ?>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'?>

</body>
</html>


</body>
</html>
