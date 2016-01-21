<?php
if (  $_SESSION[ 'NEWLR' ][ 'error' ][ 'rn'  ] ) { $rn  = '';} else { $rn  =  $_SESSION[ 'NEWLR' ][ 'LR' ][ 'cfullname'  ]; } 
if (  $_SESSION[ 'NEWLR' ][ 'error' ][ 'rkn' ] ) { $rkn = '';} else { $rkn =  $_SESSION[ 'NEWLR' ][ 'LR' ][ 'cshortname' ]; } 

#deb($_SESSION[ 'NEWLR' ]);

$lrn = '';

$out = '
<link rel="stylesheet" href="inc/css/layout.css" type="text/css" media="all" charset="utf-8" />
<link rel="stylesheet" href="inc/css/tooltipster.css"  type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.0.min.js"></script>

<script src="inc/js/jquery.infieldlabel.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">$(function(){ $("label").inFieldLabels(); }); 
</script>
<script src="inc/js/jquery.tooltipster.min.js"  type="text/javascript"></script>
</head>
<body onfocus="return false;">

<form  action="'.$_SERVER['PHP_SELF'] .'" method="get" accept-charset="utf-8">
    <input type="hidden" name="x" value="2" id="cancelForm">
   <input style="width:95%; color:#333; padding:10px; margin:25px; cursor: pointer;" type="submit" value="Zur Liste">
 </form>

<form action="'.$_SERVER['PHP_SELF'] .'" method="get" accept-charset="utf-8">
  <fieldset>
    <legend>Anmeldeformular:<br/> Neuer EMIL-RAUM</legend>   
    <p>
      <label for="lernraumname">Name der Lehrveranstaltung</label>
      <a href="#" onclick="return false" class="tooltip1" title="Name der Lehrveranstaltung, so wie er in EMIL aufgelistet werden soll"  style="float:right;" ><img src="inc/img/icon/Info.png" /></a>
      <input type="text" name="lernraumname" value="'.$rn.'" id="lernraumname" >';
      if ( ( $_SESSION[ 'NEWLR' ]['error']['rn'])) {  $out .= '<div style="color:red;">Name der Lehrveranstaltung fehlt</div>'; }
  $out .= ' 
    </p>
 
    <p>
      <label for="lernraumkurzname">Abkürzung/Modulname (aus Vorlesungsverzeichnis)</label>
      <a href="#" onclick="return false"  class="tooltip2" title="Kurzbezeichnung der Lehrveranstung, so wie er im Vorlesungsverzeichnis aufgeführt ist"  style="float:right;" ><img src="inc/img/icon/Info.png" /></a>
      <input style="background-color:#FFFFFF;" type="text" name="lernraumkurzname" value="'.$rkn.'" id="lernraumkurzname">';
        
      if ( ( $_SESSION[ 'NEWLR' ]['error']['rkn'])) {  $out .= ' <div style="color:red;">Abkürzung/Modulname fehlt</div>'; }
      if ( ( $_SESSION[ 'NEWLR' ]['error']['dbl'])) {  $out .= ' <div style="color:red;">Kurz/Modulname existiert schon, bitte anderen wählen</div>'; }

  $out .= ' 
</p>
    <p>
      <label for="dozkurzname">Ihr Namenskürzel</label>
      <a href="#" onclick="return false"  class="tooltip3" title="Ihr Namenskürzel"  style="float:right;" ><img src="inc/img/icon/Info.png" /></a>
      <input style="background-color:#FFFFFF;" type="text" name="dozkurzname" value="" id="dozkurzname">
    </p>

    <a href="#" onclick="return false"  class="tooltip4" title="Standardsprache des EMIL-Raums"  style="float:right;" ><img src="inc/img/icon/Info.png" /></a>
    <select style="float:right; color:#333; margin-right:4px;" name="sprache" size="1">
      <option  selected>deutsch</option>
      <option>englisch </option>
    </select>
    <br />
    <br />
    <p>
      <label for="zusatzinformationen">[optional] Zusätzliche Anmerkungen und Hinweise zur Einrichtung des neuen Lernraumes  </label>
      <br />
      <br />
      <textarea cols="20" rows="3" name="zusatzinformationen" id="zusatzinformationen"></textarea>
      <a href="#" onclick="return false" class="tooltip5" title="Weitere Informationen. Z.B einzutragende Tutoren, andere Einordnung als in der eigenen Fakultät"  style="float:right;" ><img src="inc/img/icon/Info.png" /></a>
</p>
  </fieldset>
 
    <input style="float:right; color:#333; padding:10px; margin:5px;" type="submit" value="Speichern">
    <input type="hidden" name="neuerLR"    value="1" id="neuerLR">
    <input type="hidden" name="servername" value="1111111111111111" >
</form>
 
<form style="margin-top:-40px;" action="'.$_SERVER['PHP_SELF'] .'" method="get" accept-charset="utf-8">
  <input type="hidden" name="x" value="2" id="cancelForm">
</form>

<script type="text/javascript" charset="utf-8">
$(".tooltip1").tooltipster({ animation: "fade", delay: 200, theme: "tooltipster-light", touchDevices: true,  trigger: "click"});
$(".tooltip2").tooltipster({ animation: "fade", delay: 200, theme: "tooltipster-light", touchDevices: true,  trigger: "click" });
$(".tooltip3").tooltipster({ animation: "fade", delay: 200, theme: "tooltipster-light", touchDevices: true,  trigger: "click" });
$(".tooltip4").tooltipster({ animation: "fade", delay: 200, theme: "tooltipster-light", touchDevices: true,  trigger: "click" });
$(".tooltip5").tooltipster({ animation: "fade", delay: 200, theme: "tooltipster-light", touchDevices: true,  trigger: "click" });
</script>

</body>
</html>
';
?>