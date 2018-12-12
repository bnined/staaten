<?php
  if(!$this->input->post('land')) {
?>
<form action="edit" method="post">
  <textarea name="einleitung"><?php echo $laenderinfo; ?></textarea>
  <input type="submit" name="einl_aendern" value="Einleitungstext ändern">
</form>

<div>
  <form id="laenderliste" action="" method="post">
        <?php foreach ($laenderliste as $id => $land):?>
          <button name="land" type="submit" value="<?php echo $id; ?>"><?php echo $land;?></button>
        <?php endforeach;?>
        <button name="staat_hinzuf" value="staat_hinzuf" type="submit">Eintrag hinzufügen</button>
        <button type="submit" name="staat_entf" value="staat_entf">Eintrag löschen</button>
</form>
</div>
<?php
}
 ?>

<article>
  <section>
    <?php
    if($this->input->post('land')) {
      $land = $this->input->post('land');
      ?>
      <a href="">zurück zur Länderübersicht</a>

      <?php

      echo $bildupload;
      ?>
      <figure>
        <img <?php echo $staatenbild;?>>

      </figure>
  </section>

  <form action="edit" method="post">
    <input type="hidden" name="kuerzel_alt" value="<?php echo $land;?>"
    Kürzel <br/>
    <input type="text" name="kuerzel" value="<?php echo $staat->id; ?>">
    <br/>
    Ländername
    <br/>
    <input type="text" name="land_lang" value="<?php echo $staat->land_lang; ?>">
     <br/>
    Ländername Englisch
     <br/>
    <input type="text" name="land_lang_en" value="<?php echo $staat->land_lang_en; ?>">
     <br/>
    Ländername Navi
     <br/>
    <input type="text" name="land_navi" value="<?php echo $staat->land_navi; ?>">
     <br/>
    Ländername Navi Englisch
     <br/>
    <input type="text" name="land_navi_en" value="<?php echo $staat->land_navi_en; ?>">
     <br/>
    Sicherer Herkunftsstaat oder anderer Herkunftsstaat
     <br/>
    <input type="radio" name="shs_ahs" value="shs" <?php if($staat->shs_ahs == "shs") {echo 'checked';}?>>Sicherer Herkunftsstaat<br/>
     <br/>
    <input type="radio" name="shs_ahs" value="ahs" <?php if($staat->shs_ahs == "ahs") {echo 'checked';}?>>Anderer Herkunftsstaat<br/>
     <br/>

     <?php
     foreach ($landinfo as $key => $info) {
       $nr = $key+1;
       echo '<textarea name="absatz'.$nr.'">';
       echo $info;
       echo '</textarea>';
     }
     ?>

    <input type="submit" name="landinfo_aend" value="Länderinfo ändern">
  </form>
      <?php
    }

    ?>

</article>
