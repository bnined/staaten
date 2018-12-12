<?php echo $laenderinfo; ?>

<div>
  <form id="laenderliste_shs" action="" method="post">
        <?php foreach ($laenderliste_shs as $id => $land):?>
          <button name="land" type="submit" value="<?php echo $id; ?>"><?php echo $land;?></button>
        <?php endforeach;?>
</form>
</div>

<article>
  <figure>
    <img <?php echo $staatenbild;?>>

  </figure>
  <?php
  foreach ($landinfo as $info) {
    echo $info;
  }
  ?>
</article>
