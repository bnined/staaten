<article>

  <form action="edit" method="post">

  <?php
    //echo form_open('edit');

    $text = array(
            'name' => 'volltext',
            'value' => $kontakt,
    );

    $aendern = array(
            'name' => 'aendern',
            'value' => 'Text ändern'
    );


    echo form_textarea($text);
    echo "<br/>";

    echo form_submit($aendern);
    echo "<br/>";
    echo form_close();
  ?>

  <p>Email-Adresse als Bild hochladen:</p>

  <form action="edit" method="post">
  <?php
  echo form_input('email');
  echo form_submit('generieren', 'Email als Bild erzeugen');

  echo form_close();
  ?>

</article>
