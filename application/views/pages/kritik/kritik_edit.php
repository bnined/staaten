<article>

  <form action="edit" method="post">

  <?php
  //echo form_open('edit', 'kritiktexte');

  echo form_textarea('kritik', $kritik);
  ?>

  <section>
    <figure>
      <img <?php echo $kritikbild1;?>>

    </figure>
  </section>

  <?php
  echo form_textarea('kritik2', $kritik2);
  echo form_textarea('kritik3', $kritik3);
  ?>

  <section>
    <figure>
      <img <?php echo $kritikbild2;?>>

    </figure>
  </section>

  <?php
  echo form_textarea('kritik4', $kritik4);

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
