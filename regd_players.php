<?php
$team = $_GET["team"];
$teamcsv = preg_replace("/[^a-zA-Z0-9]/", "", $team);
$localTime=time();
$localTime=$localTime - (60 * 60 * 1);
$mydate = date("G:i jS M Y",$localTime);
error_reporting(E_ALL);
set_time_limit(1800);
include 'pdf/class.ezpdf.php';
class Creport extends Cezpdf {
   var $reportContents = array();
   function Creport($p,$o){
      $this->Cezpdf($p,$o);
   }
}
$pdf = new Creport('a4','portrait');
$pdf -> ezSetMargins(30,30,30,30);
$all = $pdf->openObject();
$pdf->saveState();
$pdf->setStrokeColor(0,0,0,1);
$pdf->line(30,60,565,60);
$pdf->line(30,780,565,780);
$pdf->addText(230,810,8,'Berkeley and District Skittles League');
$pdf->addText(245,800,8,'Registered Players 2015/16');
$pdf->addJpegFromFile('resource/logo.jpg',525,786,40) ;
$pdf->addText(30,788,12,$team);
$pdf->addText(30,50,8,'www.berkeleydsl.org.uk');
$pdf->addText(490,50,8,$mydate);
$pdf->restoreState();
$pdf->closeObject();
$pdf->addObject($all,'all');
$pdf->ezSetDy(-40);
$mainFont = '/pdf/fonts/Helvetica.afm';
$codeFont = '/pdf/fonts/Courier.afm';
$pdf->selectFont($mainFont);
$listFile = 'csv/listteam.csv';
$fd = fopen ("$listFile", "r");
while (!feof ($fd)) {
   $buffer = fgetcsv($fd, 1024);
   for ($i = 0; $i < 9; ++$i){
         if ($i == 0){ $lName = $buffer[$i]; }
         if ($i == 1){ $lAlley = $buffer[$i]; }
         if ($i == 2){ $lNight = $buffer[$i]; }
         if ($i == 3){ $lDiv = $buffer[$i]; }
         if ($i == 5){ $lCapt = $buffer[$i]; }
         if ($i == 6){ $lPhone = $buffer[$i]; }
   }
   if ($lName == $team){
          $capt = $lCapt;
          $tel = $lPhone;
          $alley = $lAlley;
          $night = $lNight;
          $divid = $lDiv;
          $div = 'Division '.$lDiv; 
          if ($lDiv == 'P') { $div = 'Premier Division'; }
   }
}
if ($tel != '') { $tel = " ($tel)"; }
$pdf->ezText("$div\nCapt: $capt $tel\nAlley: $alley, $night",10);
$pdf->ezSetDy(-15);
$playercsv = 'player/'.$teamcsv.'.csv';
if (($handle = fopen($playercsv, "r")) !== FALSE) {
   $nn = 0;
   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $c = count($data);
      for ($x=0;$x<$c;$x++)
      {
         $nt='#';
         $csvarray[$nn][$nt] = $nn+1;
         switch($x){
            case '0':
               $nt='Name';
               break;
            case '1':
               $nt='M/F';
               break;
            case '2':
               $nt='Registered';
               $bits = explode('/',$data[$x]);
               $data[$x]=strtotime($bits[1].'/'.$bits[0].'/'.$bits[2]);
               $data[$x]=date('d/m/Y',$data[$x]);
               break;
            case '3':
               $nt='Note';
               break;
            }
         $csvarray[$nn][$nt] = $data[$x];
     }
     $nn++;
   }
   fclose($handle);
}
$pdf->ezTable($csvarray);
$pdf->ezStream();
?>
