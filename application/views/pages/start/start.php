  <article>
    <section>
      <figure>
        <img <?php echo $start1?>>
      </figure>

    <section>
      <?php echo $konzeptteaser;?>
      <a href="<?=site_url('konzept/index')?>">Mehr....</a>
    </section>

    <section>
      <h2>Die wichtigsten Fragen und Antworten</h2>
      <?php
      for ($i = 1; $i <= 5; $i++) {
        echo $faqteaser[$i];
      }
      ?>
      <a href="<?=site_url('faq/index')?>">Mehr....</a>
    </section>

    <section>
      <?php echo $staatenteaser; ?>
      <ul>
        <?php foreach ($laenderliste_shs as $id => $land):?>
          <li><?php echo $land;?></li>
        <?php endforeach;?>
      </ul>
      <a href="<?=site_url('staaten/index')?>">Mehr....</a>
    </section>

    <section>
      <figure>
        <img <?php echo $start2;?>>
      </figure>
    </section>

    <section>
      <?php echo $kritikteaser; ?>
      <a href="<?=site_url('kritik/index')?>">Mehr....</a>
    </section>

    <section>
      <h2>News</h2>
      <?php
      for ($i = 0; $i < 3; $i++) {
        echo $newsteaser[$i];
      }
       ?>
      <a href="<?=site_url('news/index')?>">Mehr....</a>
    </section>

  </article>
