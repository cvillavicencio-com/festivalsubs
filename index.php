#/bin/sh
clear;
<?php
$texto0= file_get_contents('leer');
$texto1=explode('.',$texto0);
$largodelinea=60;
$res ='';
$res .= "# largo de linea que se muestra: $largodelinea ".PHP_EOL;

foreach ($texto1 as &$l){
    if ($l!=""){
        $l= str_replace('\' ', '\'',$l);
        $l= str_replace('  ',' ',$l);
        $l= str_replace(PHP_EOL.PHP_EOL,PHP_EOL,$l);
        $l= $l.'.';
        $cora=strlen($l);
        $res .= "# largo de oracion: $cora".PHP_EOL;                   
        $colita = ($cora % $largodelinea != 0) ? intval($cora/$largodelinea): false;
        if ($colita){
            $agrega=(($colita+1)*$largodelinea)+10;
            $res .= "# se agrega hasta: $agrega".PHP_EOL;           
            $l = str_pad($l,$agrega);
            $res .= "# largo actual de oracion: ".strlen($l).PHP_EOL;           

        }
        $p=explode(' ',$l);
        $r='';
        $clinea=1;
        $linea='';
        $va=0;
        for ($i=0; $i <= (count($p)); $i++){
            $estalinea=strlen($linea);
            if (($estalinea+strlen(@$p[($i+1)])) >= $largodelinea){
                $res .= PHP_EOL.PHP_EOL."# linea: $clinea de $colita. ".PHP_EOL."# caracteres en esta linea: $estalinea".PHP_EOL;
                $res .= "echo '$linea'".PHP_EOL;
                $clinea++;
                $va +=$clinea;
                $i--;
                $linea='';
                $finlinea=true;
            }  else {
                $linea .= @$p[$i].' ';
            }

            if (empty($p[($i+1)]) && $cora < $largodelinea){
                $res .= "echo '$linea' #linea corta".PHP_EOL;
                $clinea++;
                $va +=$clinea;
                $i--;               
                $linea='';
                $finlinea=true;
                break;
            }


            
            if (($colita > $clinea && $finlinea)){
                $res .= PHP_EOL."# va: $va";
                $finlinea=false;
            }
            
        }
        
        $res .= PHP_EOL.PHP_EOL."echo '$l' | iconv -f utf-8 -t iso-8859-1|festival --tts ; clear".PHP_EOL;        
    }
}
echo $res;
?>

read
    
