<?php DECLARE(STRICT_TYPES=1);

  $url    = $_SERVER['REQUEST_SCHEME'] 
          . '://'
          . $_SERVER['SERVER_NAME'] 
          . $_SERVER['REQUEST_URI'] 
          ; 
  $vEnc   = urlencode ($url) ;

//=======================================================
function getLink( string $url, string $title) : string 
{
  $result = '';

  $result = <<< ____EOT
    <a href="$url">
      $title
    </a>
____EOT;

  $result = "<a href='$url'> $title </a> ";
  
  return $result;
}//

# ====== GetLinks ==> v001, v002, v003, v004 ==================
  $tLink  = 'https://validator.w3.org/nu/?doc=' .$vEnc ;  
  $v001   = getLink($tLink, 'HTML');

  $tLink  = 'https://jigsaw.w3.org/css-validator/validator?uri='
          .   $vEnc
          . '&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en'
          ;
  $v002   = getLink($tLink, 'CSS') ; // JIgsaw Vaidator

  $tLink  = 'https://search.google.com/test/mobile-friendly?url=' 
        . $vEnc ;
  $v003 = getLink($tLink, 'GMF'); // Google Mobile Friendly

  $tLink = 'https://sharethemeal.org/donate?campaign=syria7&fbclid=IwAR1xGVjPM2wFtjj-EaBVa0BLg-2E7a8IrWTwBJBy_DYmRzF6deD4KXJI-Fw_aem_AeF1ocPc5Y-i-cnLDGoE5mkRIqDdqs_gCluWN8iOHdTk5IoKJLv71FVFq_ec8mFm3Ec4djR1J_zJ8hG0ccAbv2KryRqXhHkQtxNjTQ1ThLd8uYppoCpu4PpgwtJCYmdV3V0';
  $v004 = getLink($tLink, 'FTH'); // 'Feed the hungry';

# OLD VERSION
  $STYLE = '
    position: fixed; 
    top: 21em; right: 0;
    font-size: small;
    text-align:center;
    writing-mode: vertical-rl;
    background-color: snow; color: #f00;
    font-weight: 700;
    padding: 1em 0;
    ';

# NEW VERSION
# header.php    
# <link rel="stylesheet" href="//anetizer.com/assets/css/FOOTER-SIDE.css" type="text/css" >
    
  $tmp = <<< ____EOT
    \n\n
    <div id="FOOTER-SIDE">
        $v001
        &nbsp;&nbsp;
        $v002 
        &nbsp;&nbsp;
        $v003
        &nbsp;&nbsp;
        $v004 
  </div>
    \n\n
____EOT;
  echo $tmp;
