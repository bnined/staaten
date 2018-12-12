  <article>
    <section>
      <?php echo $bildupload1;?>
      <figure>
        <img <?php echo $start1;?>>

      </figure>
    </section>


    <section>
      <form action="edit" method="post">
        <textarea name="konz_teaser"><?php echo $konzeptteaser; ?></textarea>
        <input type="submit" name="konzept_aen" value="Konzeptteaser ändern">
      </form>
    </section>

    <section>
      <h2>Die wichtigsten Fragen und Antworten</h2>
      <form action="edit" method="post">
      <?php
        for ($i = 1; $i <= 5; $i++) {
        $nr = count($faqfragen);
        $value = array();
        for($j = 1; $j < $nr; $j++) {
          $value["faq$j"] = $faqfragen[$j];
        }
        foreach($faqselected as $id => $nr) {
          if($nr == "nr".$i) {
            $sel = $id;
          }
        }
        echo form_dropdown("$i", $value, $sel);
        }
      echo form_submit("faq_aendern", "Reihenfolge ändern");
      echo form_close();
      ?>
    </form>


    </section>

    <section>
      <?php echo $bildupload2; ?>
      <figure>
        <img <?php echo $start2;?>>
      </figure>
    </section>

    <section>
      <form action="edit" method="post">
        <textarea name="staat_teaser"><?php echo $staatenteaser; ?></textarea>
        <input type="submit" name="staaten_aen" value="Staatenteaser ändern">
      </form>
      <ul>
        <?php foreach ($laenderliste_shs as $id => $land):?>
          <li><?php echo $land;?></li>
        <?php endforeach;?>
      </ul>
    </section>

    <section>
      <form action="edit" method="post">
        <textarea name="krit_teaser"><?php echo $kritikteaser; ?></textarea>
        <input type="submit" name="kritik_aen" value="Kritikteaser ändern">
      </form>
    </section>

    <section>
      <h2>News</h2>
      <?php
      for ($i = 0; $i < 3; $i++) {
        echo $newsteaser[$i];
      }
       ?>
    </section>

  </article>
