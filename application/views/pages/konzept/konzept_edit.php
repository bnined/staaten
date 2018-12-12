<article>

  <form action="edit" method="post">

  <?php
  //echo form_open('edit', 'konzepttexte');

  echo form_textarea('konzept', $konzept);
  ?>

  <section>
    <figure>
      <img <?php echo $konzeptbild1;?>>

    </figure>
  </section>

  <?php
  echo form_textarea('konzept2', $konzept2);
  echo form_textarea('konzept3', $konzept3);

  ?>

  <section>
    <figure>
      <img <?php echo $konzeptbild2;?>>

    </figure>
  </section>

  <?php

  echo form_textarea('konzept4', $konzept4);
  echo form_textarea('konzept5', $konzept5);

  echo form_submit('aendern', 'Texte ändern');

  echo form_close();

   ?>
   <section>
     <?php echo $bildupload1;?>
   </section>

   <section>
     <?php echo $bildupload2;?>
   </section>

</article>
