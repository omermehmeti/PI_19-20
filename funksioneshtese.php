<?php
        echo "<h4>Stafi jone perbehet nga: </h4>";
        $stafi = array("Erjon", "Omer", "Bledian");
        echo $stafi[0], "\t";
        echo $stafi[1], "\t";
        echo $stafi[2], "\t";
        echo "<br>";
        echo "<h4>Gjenerimi i vargut me foreach</h4>";
        foreach ($stafi as $val){
            echo $val. "\t";
            }
        echo "<h4>Vargjet associative</h4>";
        $mosha = array("Erjon"=>,"Omer"=>20,"Bledian"=>23);
        foreach($mosha as $x => $x_value) {
            echo "Emri=" . $x . ", Mosha=" . $x_value;
            echo "\n";
        }
?>
    <?php
        echo "<h4>Vargjet multidimensionale</h4>";
        $paga = array
        (
            array(1,"Genci",500),
            array(2,"Joni",550),
            array(3,"Eti",600)
        );

        for ($row = 0; $row < 3; $row++) {
            for ($col = 0; $col < 3; $col++) {
                echo $paga[$row][$col] . "  ";
            }
            echo "<br/>";
        }
        echo "<h4>Sortimet e vargjeve </h4>";
        $emrat = array("Diti"=>34,"Loriki"=>12,"Edi"=>52);
        echo "Sortimi normal: ";
        sort($emrat);

        foreach($emrat as $x => $x_value) {
            echo "Emri=" . $x . ", Vlera=" . $x_value;
            echo "\n";
        }
        echo "<br>";
        echo "\n Rsort: ";
        rsort($emrat);
        foreach($emrat as $x => $x_value) {
            echo "Emri=" . $x . ", Vlera=" . $x_value;
            echo "\n";
        }
        echo "<br>";
        echo "\n Asort: ";
        asort($emrat);
        foreach($emrat as $x => $x_value) {
            echo "Emri=" . $x . ", Vlera=" . $x_value;
            echo "\n";
        }
        echo "<br>";
        echo "\n Ksort: ";
        ksort($emrat);
        foreach($emrat as $x => $x_value) {
            echo "Emri=" . $x . ", Vlera=" . $x_value;
            echo "\n";
        }
        echo "<br>";
        echo "\n Arsort: ";
        arsort($emrat);
        foreach($emrat as $x => $x_value) {
            echo "Emri=" . $x . ", Vlera=" . $x_value;
            echo "\n";
        }
        echo "<br>";
        echo "\n Krsort: ";
        krsort($emrat);
        foreach($emrat as $x => $x_value) {
            echo "Emri=" . $x . ", Vlera=" . $x_value;
            echo "\n";
        }


        ?>
         <?php
    echo "<h4>Funksioni explode:</h4>";
    $njeString="Ky mesazh u shkrua ne windows 10";
    print_r(explode(" ",$njeString));
    $stringTjeter=(explode(" ",$njeString));
    echo "<br>";
    echo "<h4>Funksioni implode:</h4>";
    echo implode(" ",$stringTjeter);
    echo "<h4>Funksioni trim:</h4>";
    $str= "Welcome to Kosovo!";
    echo $str . "<br>";
    echo trim($str,"Wes!");
    echo "<h4>Funksioni printf</h4>";
    $val = 512;
    echo $val , "<br>";
    printf("%f",$val);
    ?>
    
    <?php
        echo "<h4>Funksioni substr</h4>";
        $fjalia="Beautiful Albania";
        echo substr($fjalia,6), "<br>";
        echo substr($fjalia,2,12);
        echo "<h4>Funksioni strlen</h4>";
        echo $fjalia, "\n";
        echo strlen($fjalia);
        echo "<h4>Funksioni str_replace</h4>";
        echo $fjalia, "<br>";
        $zv = str_replace('Albania','Kosovo',$fjalia);
        print_r($zv);
    ?>   
    <?php
//Funskioni per shkrim ne nje fajll ne server
$fajllii=fopen('Teksti.txt','w') or die('Nuk u mundesua hapja');
$text='Besojme i kemi implementuar te gjitha pikat e projektit';
fwrite($fajllii,$text);
$text1='Peace';
fwrite($fajllii,$text1);

fclose($fajllii);
 