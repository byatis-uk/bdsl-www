<?php
 // not under source control
 $pageName = basename($_SERVER['PHP_SELF']);
 $qryStr = basename($_SERVER['QUERY_STRING']);
 $breadcrumb = 'You are here : <b>';
 // $breadtitle derived from $pagetitle in pageheader(g).php
 if ($pageName == 'index.php'){
   $breadcrumb .= 'Home';
 }
 else {
   $breadcrumb .= "<a href=\"index.php\" title=\"Home page\">Home</a>";
   $testStr = $breadcrumb;
   // top
   if ($pageName == 'diary.php') {$breadcrumb .= " | Diary";}
   if ($pageName == 'officers.php') {$breadcrumb .= " | Officers";}
   if ($pageName == 'notices.php') {$breadcrumb .= " | News";}
   if ($pageName == 'rules.php') {$breadcrumb .= " | Rules";}
   if ($pageName == 'fbcontact.php') {$breadcrumb .= " | Contact Us";}
   if (substr($pageName,0,6) == 'awards') {$breadcrumb .= " | Awards &raquo " . substr($breadTitle,18,8) . " season"; }
   if ($pageName == 'tablearchive.php') { 
      if ($qryStr == "season=") {
	     $breadcrumb .= " | Tables &raquo; current season"; 
	  }
	  else {
	     $breadcrumb .= " | Tables &raquo; 20" . substr($qryStr,7,2) . "/" . substr($qryStr,9,2) . " season"; 
	  }
   }
   if ($pageName == 'archive.php') {$breadcrumb .= " | Awards Archive";}
   if (substr($pageName,0,3) == 'gal') {$breadcrumb .= " | Gallery &raquo; $breadTitle";}
   if ($pageName == 'links.php') {$breadcrumb .= " | Links";}
   if ($pageName == 'about.php') {$breadcrumb .= " | About";}
   // side - league
   if ($pageName == 'division.php') {
      $repStr = str_replace('div=','',$qryStr);
      if ($repStr == 'P'){
         $bcStr = 'League &raquo; Premier Division' ;
      }
      else {
         $bcStr = "League &raquo; Division $repStr" ;
      }
      $breadcrumb .= " | $bcStr";
   }
   if ($pageName == 'team.php') {
      $expStr = explode("&",$qryStr);
      $repStr = str_replace('div=','',$expStr[0]);
      if ($repStr == 'P'){
         $bcStr = "League &raquo; <a href=\"division.php?div=$repStr\" title=\"League Premier Division\">Premier Division</a>" ;
      }
      else {
         $bcStr = "League &raquo; <a href=\"division.php?div=$repStr\" title=\"League Premier $repStr\">Division $repStr</a>" ;
      }
      $breadcrumb .= " | $bcStr";
      $breadcrumb .= " | $breadTitle";
   }
   if ($pageName == 'player.php') { $breadcrumb .= " | Registered Players"; }
   if ($pageName == 'alleys.php') { $breadcrumb .= " | Alleys"; }
   if ($pageName == 'alley.php') {
      $breadcrumb .= " | <a href=\"alleys.php\" title=\"Alleys\">Alleys</a>";
      $expStr = explode("&",$qryStr);
      $repStr = str_replace('name=','',$expStr[1]);
      $repStr = str_replace('%20','&nbsp;',$repStr);
      $breadcrumb .= " | $repStr Alley";
   }
   if ($pageName == 'table.php') {
      $expStr = explode("&",$qryStr);
      $repStr = str_replace('div=','',$expStr[0]);
      if ($repStr == 'P'){
         $bcStr = 'Tables / Results &raquo; Premier Division' ;
      }
      else {
         $bcStr = "Tables / Results &raquo; Division $repStr" ;
      }
      $breadcrumb .= " | $bcStr";
   }
   // side - cups
   if ($pageName == 'cupai.php') { $breadcrumb .= " | Cups &raquo; All-in Cup"; }
   if ($pageName == 'cupfp.php') { $breadcrumb .= " | Cups &raquo; Front-pin Knockout"; }
   // side - tools
   if ($pageName == 'checkmain.php') {$breadcrumb .= " | Tools &raquo; Fixture Arranger";}
   if ($pageName == 'checker.php') {$breadcrumb .= " | Tools &raquo; Fixture Arranger";}
   // one-offs
   if ($pageName == 'agm.php') {
      $breadcrumb .= " | <a href=\"notices.php\" title=\"News and Notices\">News</a>";
      $breadcrumb .= " | AGM";
   }
   if ($pageName == 'scoresheet.php') {
      $breadcrumb .= " | <a href=\"rules.php\" title=\"Rules\">Rules</a>";
      $breadcrumb .= " | Scoresheet";
   }
   // catch-all
   if ($breadcrumb == $testStr){
     $breadcrumb .= " | Other &raquo; $breadTitle";
   }
 }
 $breadcrumb .= "</b>";
 echo "$breadcrumb";
?>