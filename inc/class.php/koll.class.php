<?php 
class Koll 
{
  var $dep;
  var $fak;
  var $ok_host ; 
  var $status;
  var $ansprechpartner;

  function Koll( $conf )
  {  
    $this->status          = $conf->status;
    $this->dep             = $conf->dep;
    $this->ok_host         = $conf->ok_host;
    $this->ansprechpartner = $conf->ansprechpartner;
  }
  
  function checkHost()
  {  
	  if  ( isset ($_SERVER['HTTP_REFERER' ] ) )                
    {   $host1 = explode('/', $_SERVER['HTTP_REFERER']);  
        if ( ! in_array( $host1[2], $this->ok_host ) )  {  die("<div style='text-align:center;'><h1>ACCESS ERROR<h1><h3>Unzul&auml;ssiger Zugriff!</h3><a href=\"javascript:window.back()\">Zur&uuml;ck</a></div>"); }
    }
    else
    {  if( $_SERVER['SERVER_NAME' ] != 'localhost' )
      {      
         header("Location:index.html");
         die("<div style='text-align:center;'><h1>ACCESS ERROR<h1><h3>Unzul&auml;ssiger Zugriff!</h3><a href=\"javascript:window.back()\">Zur&uuml;ck</a></div>"); 
      }
    }
  }
	
	function decodeAuthData( $db )
	{
    if ( isset( $_GET[ 'cid' ] ) ) /* LR ID wird IMMER aktualisiert*/
		{        
			$LR[ 'cid' 			]	=  rawurldecode( base64_decode( $_GET[ 'cid' ] ) ); # -1 == MyEMIL
		}
     	
		if ( isset($_GET[ 'uun' ] )) /* DATEN VON EMIL Übergeben (beim ersten Aufruf dieses Tools)*/		 
		{		  
			$US[ 'uusername' 	  ]	=  rawurldecode( base64_decode( $_GET[ 'uun' ] ) );                                   
			$US[ 'ufirstname'   ]	=  rawurldecode( base64_decode( $_GET[ 'ufn' ] ) );                                   
			$US[ 'ulastname' 	  ] =  rawurldecode( base64_decode( $_GET[ 'uln' ] ) );                                   
			$US[ 'uemail' 		  ] =  rawurldecode( base64_decode( $_GET[ 'uem' ] ) );                                   
			$US[ 'ufakultaet'   ]	=  rawurldecode( base64_decode( $_GET[ 'ufa' ] ) );                                   
			$US[ 'uinstitution' ]	=  rawurldecode( base64_decode( $_GET[ 'uin' ] ) );                                   
			$US[ 'udepartment' 	]	=  rawurldecode( base64_decode( $_GET[ 'ude' ] ) );                                   
			$US[ 'uid'          ]	=  rawurldecode( base64_decode( $_GET[ 'uid' ] ) );                                   
      
      $LR[ 'ccategory' 	  ]	=  rawurldecode( base64_decode( $_GET[ 'cca' ] ) );                                   
			$LR[ 'csortorder' 	]	=  rawurldecode( base64_decode( $_GET[ 'cso' ] ) );                                   
			$LR[ 'cfullname' 	  ]	=  rawurldecode( base64_decode( $_GET[ 'cfn' ] ) );                                   
			$LR[ 'cshortname' 	]	=  rawurldecode( base64_decode( $_GET[ 'csn' ] ) );                                   
      $LR[ 'servername' 	]	=  rawurldecode( base64_decode( $_GET[ 'svn' ] ) );                                   
			$LR[ 'state'	      ] =  0;
			$LR[ 'level'	 	    ] =  0;
			$LR[ 'info'	 	      ] =  " ";
			$LR[ 'ukurzel'      ] =  " ";
      $LR[ 'noStudi'      ]	=  $_GET[ 'ist' ];                                   
      
      $DA[ 'targetSem'    ]   =  1;  # Dirty FIX 
			$DA[ 'state'        ]   =  1;
			$DA[ 'sortorder1'   ]   =  1;
			$DA[ 'sortorder2'   ]   =  $US[ 'ufakultaet'   ];
            
			$_SESSION[ 'US' ] = $US;
			$_SESSION[ 'LR' ] = $LR;
			$_SESSION[ 'DA' ] = $DA;
		}
    
   $this->getLRState( $db );
  }

  function getLRFak( $LR2 )
  {
      if ( isset( $this->kukat[ $LR2[ "ccategory" ] ] ) )
      { if ( $this->kukat[ $LR2[ "ccategory" ] ] % 10 )
        { $LR[ "fak" ] =  $this->kukat[ $LR2[ "ccategory" ] ];
        }
        else 
        { $LR[ "fak" ] =  ( $this->kukat[ $LR2[ "ccategory" ] ] / 10) * 10 ;
        }
      }
      else
      { $LR[ "fak" ] =  '00' ;
      }
  }
  
  function getLRState($db) # ermittelt den EMIL-Raum Status
  {
    if    (  $_SESSION[ 'LR' ][ 'cid' ] != '-1' && $db->isLRInList( $_SESSION[ 'LR' ] )  )   
    { $_SESSION[ 'LR' ]            = $db->getLRData( $_SESSION[ 'LR' ] ); }
    else                                                                                     
    { $_SESSION[ 'LR' ][ 'state' ] = 0; }
  }
 
 
	function actionHandler( $db)
	{   
    $_SESSION[ 'NEWLR' ][ 'error' ][ 'rkn' ] = false;
    $_SESSION[ 'NEWLR' ][ 'error' ][ 'rn'  ] = false;
    $_SESSION[ 'NEWLR' ][ 'error' ][ 'dbl' ] = false;
    $_SESSION[ 'NEWLR' ][ 'LR' ][ 'cfullname'   ] = '';
    $_SESSION[ 'NEWLR' ][ 'LR' ][ 'cshortname'  ] = '';
    
    if ( isset( $_POST[ 'info'                ] ) ) $_POST['info'                ]  = htmlspecialchars( $_POST[ 'info'                ] );
    if ( isset( $_POST[ 'infoL'               ] ) ) $_POST['infoL'               ]  = htmlspecialchars( $_POST[ 'infoL'               ] );
    if ( isset( $_GET [ 'zusatzinformationen' ] ) ) $_GET[ 'zusatzinformationen' ]  = htmlspecialchars( $_GET[  'zusatzinformationen' ] );
       
    if ( isset ( $_POST[ 'status' ] ) ) 
    {   $_SESSION[ 'DA' ][ 'state' ] = 1;
		  if      ( $this->status[$_POST[ 'status' ]]['next'] == 1 )        { $_SESSION['LR']['state'] = 1;              $db->updateLRStatus( $_SESSION ); }  // LR Anfrage canceln                                // Anfrage canceln
      else if ( $this->status[$_POST[ 'status' ]]['next'] == 2 )                                                                                          // LR anfragen 
      {  
		    if      ( $_SESSION['LR']['state'] == 0 )    { $_SESSION['LR']['state'] = 2;       $db->insertLRData(   $_SESSION ); }  // nagelneuer Eintrag
        else if ( $_SESSION['LR']['state'] == 1 )    { $_SESSION['LR']['state'] = 2;       $db->updateLRStatus( $_SESSION ); }  // gecancelter Eintrag wiederherstellen
      }
    }     

		if ( isset( $_POST[ 'info' ] ) )
		{
			if ( isset ( $_POST[ 'myEMIL' ]))
			{ $_SESSION[ 'DA' ][ 'state'     ] = 1;
				$_SESSION[ 'LR' ][ 'info'      ] = $_POST[ 'info'   ] ;
				$_SESSION[ 'LR' ][ 'cshortname'] = $_POST[ 'myEMIL' ];
				$db->updateLRInfo( $_SESSION );
			}
    }
		
		if ( isset( $_POST[ 'infoL' ] ) )
		{
			if ( isset ( $_POST[ 'myEMIL' ] ) )
			{
				$SESS[ 'LR' ][ 'info'       ] = $_POST[ 'infoL'  ] ;
				$SESS[ 'LR' ][ 'cshortname' ] = $_POST[ 'myEMIL' ];
        $SESS[ 'US' ][ 'uusername'  ] = $_SESSION[ 'US' ][ 'uusername' ]; 	
       	$db->updateLRInfo( $SESS );
			}
    }
		
		if ( isset( $_GET[ 'a' ] ) )
		{
      $SESS[ 'LR' ][ 'state'      ] =  $_GET[ 'a' ] ;
      $SESS[ 'LR' ][ 'cshortname' ] =  $_GET[ 'lr' ] ;
			$SESS[ 'US' ][ 'uusername'  ] =  $_SESSION[ 'US' ][ 'uusername'  ]; 
			$SESS[ 'US' ][ 'ufirstname' ] =  $_SESSION[ 'US' ][ 'ufirstname' ]; 
			$SESS[ 'US' ][ 'ulastname'  ] =  $_SESSION[ 'US' ][ 'ulastname'  ]; 
			$db->updateLRStatus( $SESS );
			$ret = true;
		}
		
		if ( isset ($_GET['so1'] ))
		{
			$_SESSION[ 'DA' ]['sortorder1'] = $_GET['so1'];
		}

		if ( isset ($_GET['so2'] ))
		{
			$_SESSION[ 'DA' ]['sortorder2'] = $_GET['so2'];
		}

    if ( isset ($_POST['cid2'] ))
		{
     # deb($_POST['cid2'],1);
			$_SESSION[ 'LR' ]['cid'] = $_POST['cid2'];
		}
    
		if ( isset( $_GET[ 'x' ] ) )
		{
      if      ( $_GET[ 'x' ] == 1  ) { $_SESSION[ 'DA' ]['state'] = 2; }
		  else if ( $_GET[ 'x' ] == 2  ) { $_SESSION[ 'DA' ]['state'] = 3; }
		  else if ( $_GET[ 'x' ] == 5  ) { $_SESSION[ 'DA' ]['state'] = 5;  $_SESSION[ 'DA' ][ 'cshortname' ] =  $_GET[ 'lr' ]; }
		  else if ( $_GET[ 'x' ] == 9  ) { $_SESSION[ 'DA' ]['state'] = 9;  ;}
		  else if ( $_GET[ 'x' ] == 11 ) { $_SESSION[ 'DA' ]['state'] = 11; }
		}
		
		if ( isset( $_GET['neuerLR'] ) )
		{
      $error[ 'rkn' ] = false;
      $error[ 'rn'  ] = false;
      $error[ 'dbl' ] = false;
      
      if (isset( $_GET[ 'dozkurzname'            ])) { $LR[ 'ukurzel'    ] = $_GET[ 'dozkurzname'      ]      ; } else {$LR[ 'ukurzel'    ] = '';} 
      if (isset( $_GET[ 'lernraumname'           ])) { $LR[ 'cfullname'  ] = $_GET[ 'lernraumname'     ]      ; } else {$LR[ 'cfullname'  ] = '';}   
      if (isset( $_GET[ 'lernraumkurzname'       ])) { $LR[ 'cshortname' ] = $_GET[ 'lernraumkurzname' ]      ; } else {$LR[ 'cshortname' ] = '';} 
      if (isset( $_GET[ 'servername'             ])) { $LR[ 'servername' ] = $_GET[ 'servername'       ]      ; } else {$LR[ 'servername' ] = '';} 
      if (isset( $_SESSION[ 'US' ][ 'ufakultaet' ])) { $LR[ 'ccategory'  ] = $_SESSION[ 'US' ][ 'ufakultaet' ]; } else {$LR[ 'ccategory'  ] = '';}    
      if (isset( $_GET[ 'zusatzinformationen'    ])) { $LR[ 'info'       ] = "Sprache:" . $_GET[ 'sprache' ] . ":\n" . $_GET[ 'zusatzinformationen'];  } 
      else                                           { $LR[ 'info'       ] = "Sprache:" . $_GET[ 'sprache' ] . "";} 

      if ( $LR[ 'cshortname' ]!='' && ( $db->isLRInList( $LR ) ) != "" )   { $error[ 'dbl' ] = true; }
      if ( ( $_GET['lernraumkurzname'           ] ) == "" ) { $error[ 'rkn' ] = true; }
      if ( ( $_GET['lernraumname'               ] ) == "" ) { $error[ 'rn'  ] = true; }

      $LR['cid'] 	       = 1;  
			$LR['csortorder']  = 0;   
			$LR['state']       = 2;
			$LR['level']       = 1;

      $SESS['US']        = $_SESSION[ 'US' ];
      $SESS['LR']        = $LR;
      
      $SESS[ 'error' ][ 'rkn' ] = false;
      $SESS[ 'error' ][ 'rn'  ] = false;
      $SESS[ 'error' ][ 'dbl' ] = false;
             
      $_SESSION[ 'NEWLR' ]= $SESS;
      
      if ( $error['rn']  || $error['rkn']|| $error['dbl'] )
      {
        $_SESSION[ 'NEWLR' ]['error'] = $error;
        $_SESSION[ 'DA' ]['state']    = 2;
        $ret = false;
      }
      else
      {
       $db->insertLRData( $SESS );
       $_SESSION[ 'DA' ]['state'] = 3;
       $_SESSION[ 'NEWLR' ][ 'error' ][ 'rkn' ] = false;
       $_SESSION[ 'NEWLR' ][ 'error' ][ 'rn'  ] = false; ;
       $_SESSION[ 'NEWLR' ][ 'LR' ][ 'cshortname' ] = '';
       $_SESSION[ 'NEWLR' ][ 'LR' ][ 'cfullname'  ] = '';
      }
    }
  }
  
  function sendAdminEmails( $db )
  {
    $statusliste = '';
    $statusliste = $db->getERStatusListe();

    foreach ($this->status as $snr => $s )                                      # INIT ansp_stat[][] = 0  
    {  foreach ($this->ansprechpartner as $dshort => $d )  
       { $ansp_stat[ $dshort ][ $snr ] = 0;   
       }
    }    

    foreach ( $statusliste as $stat )                                           # Ermittelt alle EMIL Raum Anfragen. Erzeugt ein Array über Ansprechpartner und ER-Status
    { if ( isset( $this->dep[ $stat['udepartment'] ] ) )
      { $ansp_stat[ $this->dep[ $stat['udepartment'] ]['anpartner']  ][$stat['state']]  +=   $stat['COUNT (*)'];
      }
      else  ## -- Alle nicht zuördenbaren Departments werden als XX gespeichert 
      { $ansp_stat[ 'XX'  ][$stat['state']]  +=   $stat['COUNT (*)'];
      }
    }
 
    foreach ($ansp_stat as $ansp=>$st)                                          # ------- MAIL VERSAND AN ELKO Ansprechpartner der Fakultäten/Departments 
    { 
      $message ="";
      if ( $this->ansprechpartner[ $ansp ][ 'gender' ] == 'f')
      { $message .= "Liebe ".  $this->ansprechpartner[ $ansp ]['name'] . " \r\n\r\n";
      }
      else 
      { $message .= "Lieber ".  $this->ansprechpartner[ $ansp ]['name'] . " \r\n\r\n";
      }

      if ( $st[2] > 0 )   
      { 
        {                    $subject  = 'EMIL-RAUM ANFRAGE: Statusbericht für '. $ansp . ' --'. " [ N:".$st[2]."] [ B:".$st[3]." ] ";
		                         $message .= "Der EMIL-RAUM ANFRAGE Statusbericht für ". $ansp .": \r\n\r\n";
          if(  $st[2] > 0 ) {$message .= $this->status[2]['msg']. " : ".$st[2]. "\r\n"; }
          if(  $st[3] > 0 ) {$message .= $this->status[3]['msg']. " : ".$st[3]. "\r\n"; }
         }

        $message .= "\r\n\r\nIhr EMIL Server \r\n\r\n";
        $message .= "http://www.elearning.haw-hamburg.de/course/view.php?id=7809  \r\n\r\n";

        $to =  $this->ansprechpartner[ $ansp ][ 'email' ]; 
        
		    $this->sendAMail( $to, $subject, $message );
       }
    }
  }
  
  function sendAMail($to, $subject, $message , $from = "EMIL-noreply@haw-hamburg.de" )
  {
	  #$message = "DIESE TESTMAIL BITTE (per reply) EINFACH ZURUECKSENDEN. \r\nDAMIT ICH SEHE OB DIE MAIL KORREKT AN ALLE ADRESSATEN VERSENDET WIRD \r\n\r\nVIELEN DANK \r\n\r\nWerner Welte\r\n\r\n\r\n ". $message;
    
    #$to       = $to.', werner.welte@haw-hamburg.de' ;
    $to       = 'werner.welte@haw-hamburg.de' ;
 
    $bcc      = 'werner.welte@haw-hamburg.de' ;
    #$from     = 'EMIL-noreply@haw-hamburg.de' ;
    #$rpto     = 'werner.welte@haw-hamburg.de';

    $header  = 'From: '         . $from . "\r\n" ;
    $header .= 'Reply-To: '     . $rpto . "\r\n" ;
    $header .= 'Bcc: '          . $bcc  . "\r\n" ;
    $header .= "Mime-Version: 1.0\r\n" ;
    $header .= "Content-type: text/plain; charset=iso-8859-1" ;
    $header .= 'X-Mailer: PHP/' . phpversion () ;

    # deb($header );
    # deb( $to );
    # deb( $subject );
    # deb( $message );
	
    $sendok = mail ( $to , $subject , $message , $header ) ;
    
    if ( $sendok )
    {
      $linkTxt = $subject ;
    }
    else
    {
      $linkTxt = "ERROR: Mail nicht versendet! ". $subject ;
    }
  }
}
?>