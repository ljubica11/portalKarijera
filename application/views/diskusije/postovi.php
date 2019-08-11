

<div id='wrapper'></div>
<?php
foreach ($postovi as $p) {
    
   $idPos = $p['idPos'];

   
    echo    '<div class="postdesno"><div class="porAut">'. $p['korisnik'] . ':</div>'. '<div class="poruka">'. $p['tekst'] . '</div>'.
            '<div class="porDatum">Poslato:'.'  '.$p['datum'] .'</div>'.
            "<input type='button' class='btn btn-outline-primary btn-sm' value='svidjanje' onclick='lajk($idPos)'>".
            '<span><div class="lajk" id="brLajkova'.$idPos.'">'.'<i class="far fa-thumbs-up"></i>' .$p['brLajkova'].'</span></div></div>';
}
?>