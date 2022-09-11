clear;
<?php



$texto0= file_get_contents('leer');



$texto1=explode('.',$texto0);


$res ='';
foreach ($texto1 as &$l){
    if ($l!=""){
        $l= str_replace('\' ', '\'',$l);
        $l= str_replace('  ',' ',$l);

        $p=str_split($l,50); 

        foreach($p as &$t){
            //            $t=utf8_encode($t);
            $res .= "echo '$t'".PHP_EOL;
        }
        $res .= "echo '$l' | iconv -f utf-8 -t iso-8859-1|festival --tts ; clear".PHP_EOL;        
    }
}
echo $res;
?>

read
    
