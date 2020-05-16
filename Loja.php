<!DOCTYPE html>
<html manifest="manifest.appcache">
    <head>
        <title>Loja-</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="https://i.pinimg.com/originals/9e/8e/ab/9e8eab9ddabbefcb22a6365a9ff71311.png" sizes="16x16" />
        
        <!-- //Meta Tags -->
	    <!-- Style-sheets -->
	    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all">
	    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	    <link rel="stylesheet" href="css/lightbox.css">
	    <!-- // Style-sheets -->
	    <!-- Online-fonts -->
	    <link href="//fonts.googleapis.com/css?family=Montserrat:100,200,400,500,600" rel="stylesheet">
	    <link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
	    <!--// Online-fonts -->
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
        <script>
        $(document).ready(function(){
            $("#paraqit").click(function(){
                $("#paneli").slideToggle("slow");
                $("#paraqit").text("Shtyp p\u00ebr t\u00eb hapur apo mbyllur shpjegimin!");
            });
        });
        </script>
        <script>        
        #paraqit,#paneli { 
            padding: 5px;
            text-align: center;
            bacground-color: #e5eecc;
            border: solid 1px #999999;
        }
        #paneli {
            pading: 50px;
            display: none;
        }
        </script>
    </head>
    
    <body>
        <?php include"header.php"?>
       
        <div>
            <br>
            <center>
                <canvas id="canvas" width="400" height="250">
                    Nuk ju shfaqet asgj&euml;! Provojeni n&euml; nj&euml; shfletues tjet&euml;r.
                </canvas>
                <div id="paraqit">Shtyp p&euml;r t&euml; mbyllur shpjegimin!</div>
                <div id="paneli"><p><b><small>Shigjetat majtas, djathtas dhe sip&euml;rfaqja e miut</small></b></p></div>
                <audio autoplay loop controls>
                <source src="https://www.mfiles.co.uk/mp3-downloads/franz-liszt-liebestraum-3-easy-piano.mp3">
                Shfletuesi juaj nuk e perkrah elementin audio!
                </audio>
                <br>
                
                
                <p><button onclick="clickCounter()" type="button">Shtyp!</button></p>
                <div id="rezultatiK"></div>
                <p>Provoni t&euml; shtypni sa m&euml; shpejt&euml;!</p>
                <br>
                <p id="prova"></p>
                <Br>
                <a href="Loja.html">Lojaa</a>
                
                <script type="text/javascript" src="js/Loja.js"></script>
                
                <script>
                    function clickCounter() {
                        if(typeof(Storage) !== "undefined") {
                            if (localStorage.clickcount) {
                                localStorage.clickcount = Number(localStorage.clickcount)+1;
                            }
                            else{
                                localStorage.clickcount = 1;
                            }
                            document.getElementById("rezultatiK").innerHTML = "Keni shtypur tastin " + localStorage.clickcount + " her\u00eb!";
                            }
                        else{
                            document.getElementById("rezultatiK").innerHTML = "Shfletuesi juaj nuk e mb\u00ebshtet k\u00ebt\u00eb!";
                        }
                    }
                </script>
                
                
                
               
           </center>
        </div>
    <?php include"footer.php"?>

   
        
       
    </body>
</html>
