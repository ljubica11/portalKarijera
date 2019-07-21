<!DOCTYPE html>

<div class="wrapper">
    <div class="regwrapper">
        <div class="tabcontentInfo overflow-auto">
            <h4> Vasa interesovanja: </h4>
            <form name="formaInteresovanja" method="POST" action="<?php echo site_url('Registracija/dodajInteresovanjaZaKorisnika');?>">
                <input type="hidden" name='idKor' value="<?php echo $idKor; ?>">
                <?php foreach ($interesovanja as $interesovanje){
                    $idInt = $interesovanje['idInt'];
                    $nazivInt = $interesovanje['naziv'];
                    echo "<input type='checkbox' name='int[]' value='$idInt'>$nazivInt<br/>";
                }
                ?>
                <div id="dodataInteresovanja">
                </div>
                <br/><br/>
                Vasa interesovanja nisu na listi? Dodajte ih!
                <br>
                <input type='text' name='novoInt' id="novoInteresovanje" placeholder="Dodaj interesovanje">
                <input type="button" name='dodajNovoInt' value="Dodaj" onclick="dodajInt()">
                <br/><br/>
                <input type="submit" name='dalje' value="Dalje" class='nextButton'>
            </form>
        </div>
    </div>
</div>

    <script>
    function dodajInt(){
            inter = document.getElementById("novoInteresovanje").value;
            novaInt = document.getElementById("dodataInteresovanja");
            console.log(novaInt.innerHTML);
            xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4&&this.status==200){
                    document.getElementById("novoInteresovanje").value ="";
                    novaInt.innerHTML+=this.responseText;
                    //document.getElementById("dodataInteresovanja").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("POST", "<?php echo site_url('Registracija/dodajNovaInteresovanja'); ?>", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("inter="+inter);
  
        }
    </script>