<?php

class Config
{ 
#$kukatTargetSem  = array ( 134, 142, 140, 141, 135, 136, 143, 144, 145, 148, 147, 137, 138 ); /* ALLE LV WS1415  -- Neuer LR f�r SS15 .*/

var $sem;
var $facID;
var $faculty;
var $dep;
var $kurskat;
var $ok_host;
var $emil_URL;
var $status;
var $ansprechpartner;

function Config()
{  
  
#if ( $_SESSION['DA'][ 'targetSem' ] ==  1 ) { $this->sem = 'WS15/16'; } 
#else                                        { $this->sem = 'WS15/16'; } 	

$this->sem = 'SS16';

/* Fakuläten */
$this->facID = array ( 10, 20, 30, 40, 50, 60, 100 ); 

$this->ansprechpartner['LS'] = array ( 'name' => 'Heiko Thämlitz'    , 'raum'  => 'Bergedorf / Raum 0.42a'        , 'telefon' => '(428 75) 6312',  'email' => 'heiko.thaemlitz@haw-hamburg.de'   ,'gender' => 'm');
$this->ansprechpartner['MD'] = array ( 'name' => 'Markus Alpers'     , 'raum'  => 'Finkenau 35 / Raum U49'        , 'telefon' => '(428 75) 7619',  'email' => 'markus.alpers@haw-hamburg.de'     ,'gender' => 'm');
$this->ansprechpartner['IM'] = array ( 'name' => 'Claudia ter Meer'  , 'raum'  => 'Finkenau 35 / Raum 265'        , 'telefon' => '(428 75) 3657',  'email' => 'claudia.terMeer@haw-hamburg.de'   ,'gender' => 'f');
$this->ansprechpartner['DS'] = array ( 'name' => 'Patrick Surdziel'  , 'raum'  => 'Finkenau 35 / Raum F151'       , 'telefon' => '(428 75) 4830',  'email' => 'Patrick.Surdziel@haw-hamburg.de'  ,'gender' => 'm');
$this->ansprechpartner['TI'] = array ( 'name' => 'Steven Peemöller'  , 'raum'  => 'Berliner Tor 21 / Raum 127'    , 'telefon' => '(428 75) 8611',  'email' => 'steven.peemoeller@haw-hamburg.de' ,'gender' => 'm');
$this->ansprechpartner['WS'] = array ( 'name' => 'Christine Hoffmann', 'raum'  => 'Alexanderstrasse 1 / Raum 6.31', 'telefon' => '(428 75) 7022',  'email' => 'christine.hoffmann@haw-hamburg.de','gender' => 'f');
$this->ansprechpartner['XX'] = array ( 'name' => 'Heiko Thämlitz'    , 'raum'  => 'Bergedorf / Raum 0.42a'        , 'telefon' => '(428 75) 6312',  'email' => 'heiko.thaemlitz@haw-hamburg.de'   ,'gender' => 'm');

$this->faculty = array 
(
  '0'   =>  array( "color" => "#ABBADE" ,  "name" => "HAW" , "kname" => "HAW"  , "lname" => "Hochschule für Angewandte Wissenschaften" , "iconlink" => "inc/img/icon/HAW.png"   ), 
  '00'  =>  array( "color" => "#ABBADE" ,  "name" => "HAW" , "kname" => "HAW"  , "lname" => "Hochschule für Angewandte Wissenschaften" , "iconlink" => "inc/img/icon/HAW.png"   ), 
  '01'  =>  array( "color" => "#FFFFFF" ,  "name" => "---" , "kname" => "---"  , "lname" => ""                                         , "iconlink" => "inc/img/icon/empty.png" ), 
  '10'  =>  array( "color" => "#E0E0E0" ,  "name" => "I&O" , "kname" => "IO"   , "lname" => "Information und Organisation"             , "iconlink" => "inc/img/icon/IuO.png"   ), 
  '20'  =>  array( "color" => "#008B95" ,  "name" => "DMI" , "kname" => "DMI"  , "lname" => "Design, Medien und Information"           , "iconlink" => "inc/img/icon/DMI.png"   ),
	'30'  =>  array( "color" => "#E98300" ,  "name" => "LS"  , "kname" => "LS"   , "lname" => "Life Science"                             , "iconlink" => "inc/img/icon/LS.png"    ),
  '50'  =>  array( "color" => "#0E905A" ,  "name" => "TI"  , "kname" => "TI"   , "lname" => "Technik und Informatik "                  , "iconlink" => "inc/img/icon/TI.png"    ),
 	'60'  =>  array( "color" => "#C60C30" ,  "name" => "W&S" , "kname" => "WS"   , "lname" => "Wirtschaft & Soziales  "                  , "iconlink" => "inc/img/icon/WuS.png"   ),
 	'100' =>  array( "color" => "#ABBADE" ,  "name" => "HAW" , "kname" => "HAW"  , "lname" => "Hochschule für Angewandte Wissenschaften" , "iconlink" => "inc/img/icon/HAW.png"   ), 
 	'200' =>  array( "color" => "#ABBADE" ,  "name" => "HAW" , "kname" => "HAW"  , "lname" => "Hochschule für Angewandte Wissenschaften" , "iconlink" => "inc/img/icon/HAW.png"   ), 
 	'400' =>  array( "color" => "#ABBADE" ,  "name" => "HAW" , "kname" => "HAW"  , "lname" => "Hochschule für Angewandte Wissenschaften" , "iconlink" => "inc/img/icon/HAW.png"   ) 
 );

  $this->dep[ '20'   ] = array( "DMI"     , "Fak. Design Medien Information"                                , "20" , 'anpartner' => 'IM'  );
  $this->dep[ '21'   ] = array( "DS"      , "Dep. Design"                                                   , "20" , 'anpartner' => 'DS'  );
  $this->dep[ '22'   ] = array( "IM"      , "Dep. Information"                                              , "20" , 'anpartner' => 'IM'  );
  $this->dep[ '23'   ] = array( "MD"      , "Dep. Medientechnik"                                            , "20" , 'anpartner' => 'MD'  );
  $this->dep[ '420'  ] = array( "FV.DMI"  , "SB. Fakultätsverwaltung"                                       , "20" , 'anpartner' => 'IM'  );
  $this->dep[ '421'  ] = array( "FSB.DMI" , "SB. Fakultäts-Servicebüro"                                     , "20" , 'anpartner' => 'IM'  );
  $this->dep[ '2100' ] = array( "DS"      , "Dep. Design"                                                   , "20" , 'anpartner' => 'DS'  );
  $this->dep[ '2200' ] = array( "IM"      , "Dep. Bibliothek und Information"                               , "20" , 'anpartner' => 'IM'  );
  $this->dep[ '2300' ] = array( "MT"      , "Dep. Medientechnik"                                            , "20" , 'anpartner' => 'MD'  );
  
  $this->dep[ '30'   ] = array( "LS"      , "Fak. Lifesciences"                                             , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '31'   ] = array( "BT"      , "Dep. Biotechnologie"                                           , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '32'   ] = array( "GW"      , "Dep. Gesundheitswissenschaften"                                , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '33'   ] = array( "MT"      , "Dep. Medizintechnik"                                           , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '34'   ] = array( "OT"      , "Dep. Ökotrophologie"                                           , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '35'   ] = array( "UT"      , "Dep. Umwelttechnik"                                            , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '36'   ] = array( "VT"      , "Dep. Verfahrenstechnik"                                        , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '37'   ] = array( "HW"      , "Dep. Wirtschaftsingenieurwesen"                                , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '39'   ] = array( "GL"      , "Dep. Gewerbelehrer"                                            , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '430'  ] = array( "FV.LS"   , "SB. Fakultätsverwaltung"                                       , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '431'  ] = array( "FSB.LS"  , "SB. Fakultäts-Servicebüro"                                     , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '3100' ] = array( "BT"      , "Dep. Biotechnologie"                                           , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '3200' ] = array( "GW"      , "Dep. Gesundheitswissenschaften"                                , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '3300' ] = array( "MT"      , "Dep. Medizintechnik"                                           , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '3400' ] = array( "OT"      , "Dep. Ökotrophologie"                                           , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '3500' ] = array( "UT"      , "Dep. Umwelttechnik"                                            , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '3600' ] = array( "VT"      , "Dep. Verfahrenstechnik"                                        , "30" , 'anpartner' => 'LS'  );
  $this->dep[ '3700' ] = array( "WI"      , "Dep. Wirtschaftsingenieurwesen"                                , "30" , 'anpartner' => 'LS'  );
  
  $this->dep[ '50'   ] = array( "TI"      , "Fak. Technik und Informatik"                                   , "50" , 'anpartner' => 'TI'  );
  $this->dep[ '51'   ] = array( "FF"      , "Dep. Fahrzeugtechnik und Flugzeugbau"                          , "50" , 'anpartner' => 'TI'  );
  $this->dep[ '52'   ] = array( "IN"      , "Dep. Informatik"                                               , "50" , 'anpartner' => 'TI'  );
  $this->dep[ '53'   ] = array( "IE"      , "Dep. Informations- und Elektrotechnik"                         , "50" , 'anpartner' => 'TI'  );
  $this->dep[ '54'   ] = array( "MP"      , "Dep. Maschinenbau und Produktion"                              , "50" , 'anpartner' => 'TI'  );
  $this->dep[ '55'   ] = array( "ME"      , "Dep. Mechatronik"                                              , "50" , 'anpartner' => 'TI'  );
  $this->dep[ '450'  ] = array( "FV.TI"   , "SB. Fakultätsverwaltung"                                       , "50" , 'anpartner' => 'TI'  );
  $this->dep[ '451'  ] = array( "FSB.TI"  , "SB. Fakultäts-Servicebüro"                                     , "50" , 'anpartner' => 'TI'  );
  $this->dep[ '5100' ] = array( "FF"      , "Dep. Fahrzeugtechnik und Flugzeugbau"                          , "50" , 'anpartner' => 'TI'  );
  $this->dep[ '5200' ] = array( "IN"      , "Dep. Informatik"                                               , "50" , 'anpartner' => 'TI'  );
  $this->dep[ '5300' ] = array( "IE"      , "Dep. Informations- und Elektrotechnik"                         , "50" , 'anpartner' => 'TI'  );
  $this->dep[ '5400' ] = array( "MP"      , "Dep. Maschinenbau und Produktion"                              , "50" , 'anpartner' => 'TI'  );
  $this->dep[ '5500' ] = array( "ME"      , "Dep. Mechatronik"                                              , "50" , 'anpartner' => 'TI'  );
  
  $this->dep[ '60'   ] = array( "WS"      , "Fak. Wirtschaft & Soziales"                                    , "60" , 'anpartner' => 'WS'  );
  $this->dep[ '61'   ] = array( "PM"      , "Dep. Public Management"                                        , "60" , 'anpartner' => 'WS'  );
  $this->dep[ '62'   ] = array( "WI"      , "Dep. Wirtschaftsingenieurwesen"                                , "60" , 'anpartner' => 'WS'  );
  $this->dep[ '63'   ] = array( "PM"      , "Dep. Pflege und Management"                                    , "60" , 'anpartner' => 'WS'  );
  $this->dep[ '64'   ] = array( "SA"      , "Dep. Soziale Arbeit"                                           , "60" , 'anpartner' => 'WS'  );
  $this->dep[ '460'  ] = array( "FV.WS"   , "SB. Fakultätsverwaltung"                                       , "60" , 'anpartner' => 'WS'  );
  $this->dep[ '461'  ] = array( "FSB.WS"  , "SB. Fakultäts-Servicebüro"                                     , "60" , 'anpartner' => 'WS'  );
  $this->dep[ '6100' ] = array( "PM"      , "Dep. Public Management"                                        , "60" , 'anpartner' => 'WS'  );
  $this->dep[ '6200' ] = array( "WI"      , "Dep. Wirtschaft"                                               , "60" , 'anpartner' => 'WS'  );
  $this->dep[ '6400' ] = array( "SA"      , "Dep. Soziale Arbeit"                                           , "60" , 'anpartner' => 'WS'  );
  $this->dep[ '6300' ] = array( "PM"      , "Dep. Pflege und Management"                                    , "60" , 'anpartner' => 'WS'  );
  
  $this->dep[ '100'  ] = array( "IB"      , "HAW. Institute und Betriebseinheiten"                          , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '101'  ] = array( "EQA"     , "IB. Evaluierung, Qualitätsmanagement und Akkreditierung (EQA)" , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '102'  ] = array( "HIBS"    , "IB. Hochschulinformations- und Bibliotheksservice"             , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '103'  ] = array( "ITSC"    , "IB. IT Service Center"                                         , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '104'  ] = array( "IWS"     , "IB. IWS"                                                       , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '105'  ] = array( "WINQ"    , "IB. WINQ"                                                      , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '106'  ] = array( "CC3L"    , "IB. Competence Center Lebenlanges Lernen(CC3L)"                , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '107'  ] = array( "AKU"     , "IB. Arbeitsschutz-, Konflikt- und Umweltmanagement"            , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '108'  ] = array( "C4E"     , "IB. Competence Center Erneuerbare Energien und Energieeffiz"   , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '200'  ] = array( "STS"     , "HAW. Stabsstellen"                                             , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '201'  ] = array( "PB"      , "STS. Präsidialbüro "                                           , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '202'  ] = array( "PK"      , "STS. Presse und Kommunikation"                                 , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '203'  ] = array( "PL"      , "STS. Planung und Strategie"                                    , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '204'  ] = array( "IR"      , "HAW. Innenrevision und Recht"                                  , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '205'  ] = array( "GS"      , "HAW. Gleichstellung"                                           , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '206'  ] = array( "FT"      , "HAW. Forschung und Transfer"                                   , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '207'  ] = array( "ASD"     , "HAW. Arbeitsstelle Studium und Didaktik"                       , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '400'  ] = array( "SB"      , "HAW. Servicebereiche"                                          , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '401'  ] = array( "PS"      , "SB. Personalservice "                                          , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '402'  ] = array( "SS"      , "SB. Studierendensekretariat"                                   , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '403'  ] = array( "FR"      , "SB. Finanz- u. Rechnungswesen"                                 , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '404'  ] = array( "FM"      , "SB. Facility Management "                                      , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '405'  ] = array( "TS"      , "SB. Team Studieneinstieg"                                      , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '406'  ] = array( "IO"      , "SB. International Office"                                      , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '407'  ] = array( "ZS"      , "SB. Zentrale Studienberatung"                                  , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '1000' ] = array( "GAST"    , "HAW. Gast"                                                     , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '1001' ] = array( "GAST"    , "HAW. Gast"                                                     , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '001'  ] = array( "XX"      , "Dep.. Keine Department"                                        , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '002'  ] = array( "XX"      , "Dep.. Keine Department"                                        , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '003'  ] = array( "XX"      , "Dep.. Keine Department"                                        , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '004'  ] = array( "XX"      , "Dep.. Keine Department"                                        , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '005'  ] = array( "XX"      , "Dep.. Keine Department"                                        , "100" , 'anpartner' => 'LS'  );
  $this->dep[ '006'  ] = array( "XX"      , "Dep.. Keine Department"                                        , "100" , 'anpartner' => 'LS'  );
  
                                 /* W14, S14, S15, W15 */
  $this->kurskat =  array(
                    '20'  => array( 134, 106, 159, 199, ),
                    '21'  => array( 142, 118, 169, 203, ), 
                    '23'  => array( 140, 116, 170, 204, ),
                    '22'  => array( 141, 117, 171, 205, ),
                    '30'  => array( 135, 107, 160, 200, ),                           
                    '50'  => array( 136, 108, 161, 201, ), 
                    '51'  => array( 143, 110, 164, 206, ), 
                    '52'  => array( 144, 111, 165, 207, ), 
                    '53'  => array( 145, 112, 166, 208, ), 
                    '54'  => array( 148, 114, 167, 209, ), 
                    '55'  => array( 147, 113, 168, 210, ),   
                    '60'  => array( 137, 109, 162, 202, ),   
                    '00'  => array( 20 , 30 , 50 , 60,  ),   
                   );      
  
  $this->ok_host =  array( "www.elearning.haw-hamburg.de", "lernserver.el.haw-hamburg.de", "www.emil2-test.ls.haw-hamburg.de", "www.emil2-archiv.haw-hamburg.de", "localhost"  ); 
  
  $this->emil_URL         = "http://www.elearning.haw-hamburg.de";
  # $emil_URL      = "http://localhost/moodle";
  # $emil_URL      = "http://lernserver.el.haw-hamburg.de/moodle";
  # $emil_URL      = "http://www.emil2-test.ls.haw-hamburg.de";
  
  $this->status = array
  (
	'0'  =>  array( 'next' => '2', 'color' => '#EEEEEE' ,  'description' => 'Dieser EMIL-Raum <br/>wurde noch NICHT  für '  .$this->sem. '<br/> angefordert'      , 'butt' => 'Diesen EMIL RAUM anfordern'                   , 'butt2' => 'anfordern<br/>'            ,  'msg'  => 'KEIN'            , 'shortname' => 'A'  , 'iconlink' => 'inc/img/icon/Add.png'    ,  'txt2' => 'Diesen EMIL-Raum bitte für ' .$this->sem . '<br>'   ),
	'1'  =>  array( 'next' => '2', 'color' => '#CC583C' ,  'description' => 'Dieser EMIL-Raum <br/>wurde für '              .$this->sem. '<br/> abbestellt'       , 'butt' => 'Diesen EMIL RAUM wieder anfordern'            , 'butt2' => 'wieder<br/>anfordern'      ,  'msg'  => 'STORNIERT'       , 'shortname' => 'A'  , 'iconlink' => 'inc/img/icon/Add.png'    ,  'txt2' => 'Diesen EMIL-Raum bitte für ' .$this->sem . '<br>'   ),
	'2'  =>  array( 'next' => '1', 'color' => '#3762F2' ,  'description' => 'Dieser EMIL-Raum <br/>wurde für das '          .$this->sem. '<br/> bestellt'         , 'butt' => 'Diese EMIL RAUM Anfrage wieder stornieren'    , 'butt2' => 'wieder<br/>stornieren'     ,  'msg'  => 'ANGEFORDERT'     , 'shortname' => 'X'  , 'iconlink' => 'inc/img/icon/Delete.png' ,  'txt2' => 'Die Bestellung für diesen EMIL-Raum wieder<br>'  ),
	'3'  =>  array( 'next' => '3', 'color' => '#ECF039' ,  'description' => 'Dieser EMIL-Raum <br/>wird zur Zeit für '      .$this->sem. '<br/> vorbereitet'      , 'butt' => 'Diese EMIL RAUM Anfrage wird jetzt Bearbeitet', 'butt2' => 'wird jetzt<br/>bearbeitet' ,  'msg'  => 'In BEARBEITUNG'  , 'shortname' => 'B'  , 'iconlink' => 'inc/img/icon/Heart.png'  ),
	'4'  =>  array( 'next' => '4', 'color' => '#8EE754' ,  'description' => 'Dieser EMIL-Raum <br/>ist jetzt für '          .$this->sem. '<br/> vorbereitet'      , 'butt' => 'Diese EMIL RAUM Anfrage ist vorbereitet'      , 'butt2' => 'ist<br/>vorbereitet'       ,  'msg'  => 'ERLEDIGT'        , 'shortname' => 'E'  , 'iconlink' => 'inc/img/icon/Check.png'  ),
	'5'  =>  array( 'next' => '5', 'color' => '#666666' ,  'description' => 'Dieser EMIL-Raum <br/>ist<br/> gelöscht'                                       , 'butt' => 'Diesen EMIL RAUM Anfrage wird jetzt gelöscht' , 'butt2' => 'ist<br/>gelöscht'          ,  'msg'  => 'GELÖSCHT'        , 'shortname' => 'D'  , 'iconlink' => 'inc/img/icon/Skull.png'  ),
   );  							 
  
if (!function_exists ('deb'))    
{    
  function deb($obj, $kill=false) {   echo "<pre>";  print_r ($obj);  echo "<pre>";  if($kill){die();} }
} 
}


}
?>