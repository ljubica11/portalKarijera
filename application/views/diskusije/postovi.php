

<div id='wrapper'></div>
<?php
foreach ($postovi as $p) {
    
   $idPos = $p['idPos'];
    ?>
    <div class="postdesno">
    <?php
    echo $p['korisnik'] . ': ' . $p['tekst'] . '<br> ' . $p['datum'] .'  '."<input type='button' class='btn btn-outline-primary btn-sm' value='svidjanje' onclick='lajk($idPos)'>".
            '<div id="brLajkova'.$idPos.'">'.'<i class="far fa-thumbs-up"></i>' .$p['brLajkova'] .'</div>'.'<br>'
    . '</div>';
}
?>
