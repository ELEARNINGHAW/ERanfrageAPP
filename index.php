<?php
session_start();

require_once( "inc/class.php/koll.conf.class.php" 	  	);
require_once( "inc/class.php/koll.class.php" 		       	);
require_once( "inc/class.php/koll.DB.class.php"		    	);
require_once( "inc/class.php/koll.renderHTML.class.php"	);

$CFG 			      = new Config();
$Ko 			      = new Koll( $CFG );
$db 				    = new KollDB( $CFG );
$render				  = new RenderHTML( $CFG );

$Ko->checkHost(); 												    // -- Zugriff auf diese Seite nur von registrierten Refferer
$Ko->decodeAuthData( $db );							  		// -- Nutzerdaten ermitteln (übergebene oder SESSION)
$Ko->actionHandler( $db );  

if (  $_SESSION[ 'DA' ][ 'state' ] != 11) 
{  
 echo $render->getBlockHTMLHeader();
}

if      ( $_SESSION[ 'DA' ][ 'state' ] == 1  )  { echo $render->renderButtonOutput();    }
else if ( $_SESSION[ 'DA' ][ 'state' ] == 2  )  { echo $render->renderForm();            }
else if ( $_SESSION[ 'DA' ][ 'state' ] == 3  )  { echo $render->renderUserLRList( $db ); }  
else if ( $_SESSION[ 'DA' ][ 'state' ] == 5  )  { echo $render->rendererMailForm( $db ); }
else if ( $_SESSION[ 'DA' ][ 'state' ] == 9  )  { echo $render->renderLRList( $db );     }  
else if ( $_SESSION[ 'DA' ][ 'state' ] == 11 )  { $Ko->sendAdminEmails($db, $render);             }  
?>