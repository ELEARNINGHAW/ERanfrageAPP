<?php
#error_reporting(E_ALL);
class RenderHTML
{ 
  var $kurskat; 
  var $faculty; 
  var $dep; 
  var $facID; 
  var $emil_URL;      
  var $status;
  var $sem;	
  var $kuka_dep;
  var $kuka_fak;  
  var $ansprechpartner;
  
  function RenderHTML( $conf)
	{
     $this->kurskat         = $conf->kurskat;
     $this->dep             = $conf->dep;
     $this->faculty         = $conf->faculty;
     $this->facID           = $conf->facID;
     $this->emil_URL        = $conf->emil_URL;
   	 $this->status          = $conf->status ;
   	 $this->sem             = $conf->sem ;
     $this->ansprechpartner = $conf->ansprechpartner;
  }
	
	function renderButtonOutput()
  { 
    $LR = $_SESSION[ 'LR' ];
    $out = '<div style="background-color:#FFF; ">';	

    if ( $LR['cid'] == -1 || $LR['cid'] == 1   ) # DASHBOARD oder Startseite
    {
  #    $out .= '<a style ="font-family:verdana; font-size:12px; text-decoration:none; padding:4px;" target="_blank" href="'.$_SERVER['PHP_SELF'] .'?x=1"><div style="background-color:#FFF; padding:15px; border: solid 1px black;">Ich möchte einen komplett neuen EMIL-Raum beantragen</div></a>';
    } 
    else
    {
      if( $LR[ 'state' ] == 0 ||  $LR[ 'state' ] == 1 ||  $LR[ 'state' ] == 2   ) 
      {
        $out .= '<div class="status'.$LR['state'].'">  '. $this->status[ $LR['state'] ][ "description" ] .' </div> <div style="display:block">';
        $out .= '<form action="'.$_SERVER['PHP_SELF'] .'" method="post">';
        $out .= '<input type="hidden"  name="status" value="'. $LR['state']  .'"/>';
        $out .= '<input type="hidden"  name="cid2"   value="'. $LR[ 'cid' ]  .'"/>';
      # $out .= '<label class="buttext2">'. $this->status[ $LR['state'] ][ "txt2" ].'</label>';
        $out .= '<input style="cursor:pointer; width:100%" class="buttTXT4" type="submit" value="'. $this->status[ $LR['state'] ][ "butt" ] .'" border="0" />';
        $out .= '<a href="#" onclick="show_block(\'zusinfo\'); return false;" style="font-family:arial; font-size:9px; border:1px outset black; margin:6px;margin-left:0px; padding:4px; background-color:#EEE; text-decoration:none; float:left; ">Ihre Anmerkungen:&darr;</a>';
        $out .= '</form>';
        $out .= '</div>';
      }
        
     if( $LR['state'] == 3 ) 
     { $out .= '<div style="display:block;"> <div class="status3"> '. $this->status[ 3 ][ "description" ] .' </div> </div>'; }
     if( $LR['state'] == 4 ) 
     { $out .= '<div style="display:block;"> <div class="status4"> '. $this->status[ 4 ][ "description" ] .' </div> </div>'; } 
      
      $out .= '<div style="height:17px; width:17px; background-color:#FFFFFF; border: 1px solid black; padding:1px; padding-bottom:2px ; position:absolute; top:14px; right:10px; cursor: pointer;"> <a title="Zur Info und Hilfeseite" style="font-family:verdana;  font-size:11px; text-decoration:none; padding:4px" href="http://www.elearning.haw-hamburg.de/mod/glossary/showentry.php?courseid=1&eid=1528&displayformat=dictionary" target="_blank">?</a></div>';
      $out .= '<div id="zusinfo" style="font-family:verdana; font-size:9px;  display:none; background-color:#FFF; padding:2px; margin:1px;float:right;">Ihre Anmerkungen und Hinweise an das EMIL-Team zur Einrichtung dieses EMIL-Raumes ';   #  
      $out .= ' <form action="'.$_SERVER[ "PHP_SELF" ] .'" method="post">';
      $out .= '  <label for="info2" >  </label>';
      $out .= '  <textarea name="info" id="info" style="width:95%;"  rows="3">'.$LR["info"].'</textarea><br />	';
      $out .= '  <input type="hidden" name="myEMIL" value="'. $LR["cshortname"].'" />';
      $out .= '  <input  style=" margin:6px;margin-right:0px; font-size:10px; border: 1px outset #000000; float:right" class="butt2"  type="submit" border="0" value="Ihre Anmerkungen speichern" title="Hier können Sie zusätzliche Informationen oder besondere Wünsche zu Ihrem EMIL-Raum speichern, z.B Tutoren oder weitere Lecturer"/>';
      $out .= '  </form>';
      $out .= '</div>';
    }

    $out .= '</div>';	
     
	  return $out;
	}
 
	function renderLRList( $db )
	{ 
    $sortMode1 =  $_SESSION[ 'DA' ]['sortorder1'];
    $sortMode2 =  $_SESSION[ 'DA' ]['sortorder2'];

    $out0 = $out1 =	$out2 =	$out3 =	$out4 =	$out5 =	$out = "";
  	$i11  = $i14  = $i15 = $i24 = $i23 = $i22 = $i21 = $i51 = 0; 
      
    $outA = '<html>
    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
    <style type="text/css">
 	  td { font-size: 14px;color: #000;font-family:Verdana;/*margin: 2px;padding: 2px;*/}
    h1 { font-size: 25px;color: #000;font-family:Verdana;margin: 2px;margin-top: 20px;padding: 2px;}
     a { font-size: 14px;color: #000;font-family:Verdana; text-decoration:none;/*border: 1px solid #000;*/    }
    </style>
	</head>
  <body>	
	<a href = "'.$_SERVER['PHP_SELF'] .'?so1=1&x=9" >'; 
  
    if ( $sortMode1 == 1 ){ $outA .= '<img src="inc/img/todo2.png" /></a>'; } else { $outA .= '<img src="inc/img/todo.png" /></a>'; } 
        $outA .= '<a href = "'.$_SERVER['PHP_SELF'] .'?so1=2&x=9" >';
    if ( $sortMode1 == 2 ){ $outA .= '<img src="inc/img/status2.png" /></a>'; } else { $outA .= '<img src="inc/img/status.png" /></a>'; } 
        $outA .= '<a href = "'.$_SERVER['PHP_SELF'] .'?so1=3&x=9" >';
    if ( $sortMode1 == 3 ){ $outA .= '<img src="inc/img/delete2.png" /></a>'; } else { $outA .= '<img src="inc/img/delete.png" /></a>'; } 

    $outA .= '
    <a href = "'.$_SERVER['PHP_SELF'] .'?so2=20&x=9"><img src="inc/img/DMI.png" /></a>
    <a href = "'.$_SERVER['PHP_SELF'] .'?so2=30&x=9"><img src="inc/img/LS.png"  /></a>
   	<a href = "'.$_SERVER['PHP_SELF'] .'?so2=50&x=9"><img src="inc/img/TI.png"  /></a>
 	  <a href = "'.$_SERVER['PHP_SELF'] .'?so2=60&x=9"><img src="inc/img/WuS.png" /></a>
   	<a href = "'.$_SERVER['PHP_SELF'] .'?so2=0&x=9" ><img src="inc/img/HAW.png" /></a>
  	';
   
   $LRList =  $db->getListOfLR( );
	if (  $LRList  )
  foreach ( $LRList  as $LR )
  {  
    $LR = $this->getLRnfos( $LR, $sortMode2 ); 
    if (  $sortMode2 == $LR[ "cfac" ] )
    {
    $outX = '
     <td width="50px"  style="background-color:'.$this->faculty[ $LR["cfac"] ][ "color" ].'">' . $LR["cdep_txt"]. '</td> 
     <td width="5px" style="background-color:'.$this->faculty[ $LR["ufakultaet"] ][ "color" ].'">'
  . '<a target="_blank" title="'.$LR["ufirstname"].' '.$LR["ulastname"]. ' '. $LR["ukurzel"] .'" href="'.$this->emil_URL.'/user/profile.php?id='.$LR["uid"].'">[' . $LR["udep_txt"]. '] '  .$LR["ulastname"].$LR["krzl"]. '&nbsp;</a></td> 
     <td width="20px"><a href = "'.$_SERVER['PHP_SELF'] .'?&x=5&lr='.$LR["lrsn"].'" target="_blank" > <div class="stateNr"  style="background-color:'.$this->status[ 0 ][ "color" ] .'" title = " '.$this->status[ 0 ][ "butt" ] .' "><img src="inc/img/icon/Pen.png" /></div></a></td> 
     <td style="background-color:'.$this->status[ $LR["state"] ][ "color" ].'">'
  . '<a target="_blank" href="'.$this->emil_URL.'/course/view.php?id='.$LR["cid"].'">'
  . '<div style="width:500px;">'.$LR["neu"].''. $LR["cfullname"].'</a></div></td> 
     <td width="20px"><a href = "'.$_SERVER['PHP_SELF'] .'?a=2&x=9&lr='.$LR["lrsn"].'"> <div class="stateNr"  style="background-color:'.$this->status[ 2 ][ "color" ] .'" title = " '.$this->status[ 1 ][ "butt" ] .' "><img src="'.$this->status[ 1 ][ "iconlink" ] .'" /></div></a></td> 
     <td width="20px"><a href = "'.$_SERVER['PHP_SELF'] .'?a=1&x=9&lr='.$LR["lrsn"].'"> <div class="stateNr"  style="background-color:'.$this->status[ 1 ][ "color" ] .'" title = " '.$this->status[ 2 ][ "butt" ] .' "><img src="'.$this->status[ 2 ][ "iconlink" ] .'" /></div></a></td> 
     <td width="20px"><a href = "'.$_SERVER['PHP_SELF'] .'?a=3&x=9&lr='.$LR["lrsn"].'"> <div class="stateNr"  style="background-color:'.$this->status[ 3 ][ "color" ] .'" title = " '.$this->status[ 3 ][ "butt" ] .' "><img src="'.$this->status[ 3 ][ "iconlink" ] .'" /></div></a></td> 
     <td width="20px"><a href = "'.$_SERVER['PHP_SELF'] .'?a=4&x=9&lr='.$LR["lrsn"].'"> <div class="stateNr"  style="background-color:'.$this->status[ 4 ][ "color" ] .'" title = " '.$this->status[ 4 ][ "butt" ] .' "><img src="'.$this->status[ 4 ][ "iconlink" ] .'" /></div></a></td> 
     <td width="20px"><a href = "'.$_SERVER['PHP_SELF'] .'?a=5&x=9&lr='.$LR["lrsn"].'"> <div class="stateNr"  style="background-color:'.$this->status[ 5 ][ "color" ] .'" title = " '.$this->status[ 5 ][ "butt" ] .' "><img src="'.$this->status[ 5 ][ "iconlink" ] .'" /></div></a></td> 
     <td style=" font-size:8px; width.50px">'.$LR["changetime"] .'<br/>'  .$LR["changedate"]       .'&nbsp;</td> 
     
<td>'.$LR["info"]         .'&nbsp;</td>
     </tr>';

     if ($sortMode1 == 1 ) // Nur erledigte LR sind seperat (am Ende der Liste)
     {
       if       ( $LR["state"]  ==  1) { $out1 .= '<td width="20px"  style="background-color:'.$this->faculty[ $LR["cfac"] ][ "color" ].'">'.++$i11.'</td>'. $outX ;  }
       else  if ( $LR["state"]  ==  4) { $out4 .= '<td width="20px"  style="background-color:'.$this->faculty[ $LR["cfac"] ][ "color" ].'">'.++$i14.'</td>'. $outX ;  }
       else  if ( $LR["state"]  !=  5) { $out0 .= '<td width="20px"  style="background-color:'.$this->faculty[ $LR["cfac"] ][ "color" ].'">'.++$i15.'</td>'. $outX ;  }
     }

     if ($sortMode1 == 2 ) // Alle LR Statuse sind seperat 
     { $out0 .= $outX ;
       if  ( $LR["state"]  ==  4 )     { $out4 .= '<td width="20px"  style="background-color:'.$this->faculty[ $LR["cfac"] ][ "color" ].'">'.++$i24.'</td>'. $outX ; }
       if  ( $LR["state"]  ==  3 )     { $out3 .= '<td width="20px"  style="background-color:'.$this->faculty[ $LR["cfac"] ][ "color" ].'">'.++$i23.'</td>'. $outX ; }
       if  ( $LR["state"]  ==  2 )     { $out2 .= '<td width="20px"  style="background-color:'.$this->faculty[ $LR["cfac"] ][ "color" ].'">'.++$i22.'</td>'. $outX ; }
       if  ( $LR["state"]  ==  1 )     { $out1 .= '<td width="20px"  style="background-color:'.$this->faculty[ $LR["cfac"] ][ "color" ].'">'.++$i21.'</td>'. $outX ; }
     }

     if ($sortMode1 == 3 ) // Alle LR Statuse sind seperat 
     { 
       if  ( $LR["state"]  ==  5 )     { $out5 .= '<td width="20px"  style="background-color:'.$this->faculty[ $LR["cfac"]  ][ "color" ].'">'.++$i51.'</td>'.$outX  ; }
     }
  
     }
   }

   $out .= $outA;
  
   $out .= '<h1 style="color:#FFFFFF; background-color:'.$this->faculty[ $sortMode2  ][ "color" ].'">'.$this->faculty[ $sortMode2 ][ "name" ].'</h1>';

    if ($sortMode1 == 1 )
    {
      $out .= '<br/><hr><h1>Todo:</h1>'; 
      $out .= '<table border ="0">';
      $out .= $out0;
      $out .= '<table>';

      $out .= '<br/><hr><h1>Erledigt:</h1>';
      $out .= '<table border ="0">';
      $out .= $out4;
      $out .= $out1;
    }

    if ( $sortMode1 == 2 )
    {
        $out .= '<br/><hr><h1>Angefordert:                  </h1><table border ="0">'. $out2 .'<table>';
        $out .= '<br/><hr><h1>In Bearbeitung:               </h1><table border ="0">'. $out3 .'<table>';
        $out .= '<br/><hr><h1>Erledigt:                     </h1><table border ="0">'. $out4 .'<table>';
        $out .= '<br/><hr><h1>Zurückgestellt / Abgebrochen: </h1><table border ="0">'. $out1 .'<table>';
    }
    
    if ( $sortMode1 == 3 )
    {
        $out .= '<br/><hr><h1>Gelöscht:                     </h1><table border ="0">'. $out5 .'<table>';
    }
    
    $out .= '</body></html>';
    return $out;
}
	
function renderUserLRTable( $lrlist,  $db )
{
	if ( isset (  $lrlist ) )
    {
    	$tmp = "<table style=\"width:95%; margin:25px; margin-top:5px\">";
     	$tmp .= "<tr class='liste1' ><th style=\"width:70%;\">EMIL Raum Name</th> <th>aktueller&nbsp;Status</th><th style=\"width:110px; text-align:left; padding-left:35px;\">Aktion</th></tr>";

      foreach ( $lrlist as $lr )
   	 	{
			$stat = 0;
      $stat =  $db->getStatus( $lr[2] ); 
      $info =  $db->getInfo( $lr[2] ); 
      $disable = '';   if ( $stat == 0 ) $disable =  'disabled="disabled"'; 
      $title = "[Klick] um weitere Informationen zum EMIL-Raum  $lr[3] zu speichern"; if ( $stat == 0 )  $title = "Nichts zu speichern";
      $tmp .= "<tr>" ; 
			$tmp .= '<td  style = "height:35px; padding-right:10px; text-align:right; border:2px solid '.$this->status[ $stat         ][ "color" ] .'">';
      $tmp .= $lr[3] ;
      $tmp .= ' </td>'; 
			$tmp .=  $this->getMiniStatus (  $lr, $stat  ) ; 
      $tmp .= "</tr>" ; 
		  }
		$tmp .= '</table>';
	}
  else
  {
    $tmp =  "<h3  style=\"margin-left:30px; margin-top:10px; font-size: 13px;	color: #000;	font-family:Verdana;\">Es wurden noch keine EMIL-Räume angefordert:</h3>";
  }
	return $tmp;
}	
function getMiniStatus (  $lr, $stat  )
{
  $msg =  $this->status[ $stat         ][ "msg" ];
  $tmp = '<td style="font-size: 9px;	color: #000;	font-family:Verdana; text-align: center ; width:100px; border:2px solid '.$this->status[ $stat         ][ "color" ] .'; " >'. $msg .'</td>';
  
  if( $stat == 2  || $stat == 1    || $stat == 0  )   {$bgCol = '#EEE'; } else {$bgCol = '#FFF'; } 

  $tmp .=  ' <td style="background-color:'.$bgCol.'; border:1px outset #CCC  ; width:110px; display:block;">  ' ;
 
  $nextStat =  $this->status[ $stat ]['next'];
  if( $stat == 2  || $stat == 1    || $stat == 0  )
  { 
  $tmp .= '<a  href= " '.$_SERVER['PHP_SELF'] .'?a=' .$nextStat .'&lr='.$lr[2]. '" onclick="return xfalse;" >';
  }
  $tmp .= '<div style="padding:1px";><img style="float:left;" src="' .$this->status[ $stat ][ "iconlink" ] .'" title="'.$this->status[ $stat ][ "butt" ] .'" />'.$this->status[ $stat ][ "butt2" ] .'</div>';
  if( $stat == 2  || $stat == 1    || $stat == 0  )
  {
    $tmp .= ' </a>';
  }
  $tmp .= '</td>';   
  return $tmp;
}

function renderUserLRList( $db )
{ 
  $out  = "</head><body>"; 
  $out .= '<form action="'.$_SERVER['PHP_SELF'] .'" method="get" accept-charset="utf-8">
    <input class="mainbutton2" type="submit" value="Für '.  $_SESSION[ 'US' ]['ufirstname'].' '. $_SESSION[ 'US' ]['ulastname'].' einen komplett neuen EMIL-RAUM beantragen"> <input type="hidden" name="x" value="1">	
    <input class="mainbutton3" type="button" value="refresh" onclick="location.reload();"></form>';	
  
  if ( $db->isUSInList( $_SESSION[ 'US' ] ) )                                           //  -- Anfrage kam aus der myEMIL Seite UND User hat schon einen LR in der Liste
  { $out .=  "<div class=\"div1\">";
    
    $newLRs =  $db->getListOfNewLR(  $_SESSION['US']['uusername'] );  
	  if (isset($newLRs['short']))
    {  $out .=  "<h3>Ihre angeforderten Lernräume:</h3>";
       $out .=  $this->renderUserLRTable(  $newLRs['short'] ,$db );
    }

    $ansprechpartner = (  $this->ansprechpartner[  $this->getAnsprechpartnerID($_SESSION[ 'US' ]['udepartment'] )  ] );
    
    if( $ansprechpartner['gender']  == 'f' )
    { $out .=  "<h3>werden bearbeitet von Ihrer Ansprechpartnerin:</h3>";
    }
    else 
    { $out .=  "<h3>werden bearbeitet von Ihrem Ansprechpartner:</h3>";
    }
       #deb($_SESSION[ 'US' ]);
        
       $out .= '<div class="liste1" style="margin-left:30px;" >';
       $out .= '<br/>'    . $ansprechpartner['name'    ];
       $out .= '<br/>'    . $ansprechpartner['raum'    ];
       $out .= ' / Tel. ' . $ansprechpartner['telefon' ];
       $out .= '<br/>'    . $ansprechpartner['email'   ];
       $out .=  "</div>";
    
       $out .=  "</div></body></html>";
  }
  return $out;
}

function renderForm()
{ 
  include ("inc/template/renderform.php");
  return $out;
}

function getAnsprechpartnerID( $department )
{
  if (  isset ( $this->dep[ $department ] ) )  
    { $ret =  $this->dep[ $department ]['anpartner']; }
  else 
    { $ret =  'XX'; }

  return $ret;  
}

function getBlockHTMLHeader()
{
return '
<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Formular: Neuer LR</title>
  <link rel="stylesheet" href="inc/css/layout2.css" type="text/css" media="all" charset="utf-8" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="inc/js/jquery.infieldlabel.min.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
function show_block(block, anzBlocks)
{
if(anzBlocks) hide_block(anzBlocks);
if ( document.getElementById(block).style.display == "block" )
 { document.getElementById(block).style.display = "none";        }
 else
 { document.getElementById(block).style.display = "block";    }
}
</script>
';
}

function rendererMailForm( $db )
{
  $ER =  $db->getLRData( $_SESSION[ 'DA' ] );
  
  if (isset ( $this->dep[ $ER[ 'udepartment' ] ] [ 'anpartner' ] ) )
  {
    $anspFAK = $this->dep[ $ER[ 'udepartment' ] ] [ 'anpartner' ];
  } 
  else
  {
    $anspFAK = 'XX';
  }
  

  #deb( $ER        )    ;

  $ER[ 'ufirstname' ];   # => Robert
  $ER[ 'ulastname'  ];   # => Heß
  $ER[ 'cfullname'  ];   # => Programmieren 2 (HSS) WiSe 2014/15 
  $ER[ 'uemail'     ];   #

  $ansprechPAinfo = $this->ansprechpartner[ $anspFAK ];

  #deb(  $this->ansprechpartner  )    ;
  #deb( $ansprechPAinfo        )    ;
  #deb($this->ansprechpartner) ;
  #deb( $anspFAK );
}

function getLRnfos($LR , $sortMode2)
{  
  if ( $LR["cid"] == 1)            { $LR["neu"] = "<span style=\"font-weight:600;\">".$LR["cshortname"].": </span>"; } else { $LR["neu"] = ''; } # Komplett neu angeforderter LR hat den LR Kurznamen fett als Prefix vor den LR Namen stehen
  if ( $LR["ufakultaet"] == "")    { $LR["ufakultaet"] = "00";                                                 }  #Alle unbekannten Fakultäten sind global HAW

  ## -- Course Department als ID  --
  $this->cdep = '00' ;
  
  if ( isset( $this->faculty[ $LR[ "ccategory"      ] ] ))
  {
     $this->cdep = $LR[ "ccategory"      ];
  }
  else
  {
    foreach ( $this->kurskat as $kuka => $depa )
    { 
      if   ( in_array( $LR[ "ccategory" ], $depa ) ) {  $this->cdep = $kuka;   break; }  
    } 
  }
  $LR["cdep"] =  $this->cdep ;

  #deb($LR,1) ;
  
  ## -- Course Department als Text  --
  if (isset ($this->dep[$LR[ "cdep" ]][0]))
  {  
    $LR["cdep_txt"] = $this->dep[$LR[ "cdep" ]][0];
  }
  elseif (isset ($this->faculty[$LR[ "cdep" ]]['kname']))
  {  
    $LR["cdep_txt"] = $this->faculty[$LR[ "cdep" ]]['kname'];
  }
  else  
  {  
    $LR["cdep_txt"] = 'HAW';
  }
  
  ## -- Course Fakultät als ID  --
  if     ( isset( $this->faculty[ $LR[ "ccategory" ] ] ) )   # Wenn Kurs-Category eine Fak-ID ist, dann ist es die ID der Fakultät des NEUEN LR
  {
     $LR["cfac"] = $LR[ "ccategory" ];
  }
  elseif ( isset( $this->faculty[ $LR[ "cdep"      ] ] ) )   # Wenn Kurs-Department eine Fak-ID ist, dann ist es die ID der Fakultät
  {
     $LR["cfac"] = $LR[ "cdep" ];
  }
  else
  {  
    $LR["cfac"] =  $this->dep[ $LR["cdep"] ] [2];
  }
  
  ## -- Course Fakultät als Text  --
  $LR["cfac_txt"] =  $this->faculty[  $LR["cfac"] ]['kname'] ;
  

  ## -- User Department als Text  --
  if (isset ($this->dep[$LR[ "udepartment" ]][0]))
  {  
    $LR["udep_txt"] = $this->dep[$LR[ "udepartment" ]][0];
  }
  elseif (isset ($this->faculty[$LR[ "udepartment" ]]['kname']))
  {  
    $LR["udep_txt"] = $this->faculty[$LR[ "udep" ]]['kname'];
  }
  else  
  {  
    $LR["udep_txt"] = 'HAW';
  }

  ## -- User Namenskürzel Text  --
  $t= trim($LR["ukurzel"]);
  if (  $t!='' ) 	{	$LR["krzl"] = '/'.$LR["ukurzel"];  }
  else             { $LR["krzl"] = '';  }
   
  ## -- LR Kurzname  --
  $LR["lrsn"] = ($LR["cshortname"]);

 if( $LR["cfac"] != 20 && $LR["cfac"] != 30 && $LR["cfac"] != 50 && $LR["cfac"] != 60 )  $LR["cfac"] = '00' ;
 return $LR;
 }
}