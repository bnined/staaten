<article>
  <form action="edit" method="post">
    Datum
    <input type="date" name="datum">
    Text Deutsch
    <textarea name="text_de"></textarea>
    Slug Deutsch
    <input type="text" name="slug_de">
    Text Englisch
    <textarea name="text_en"></textarea>
    Slug Englisch
    <input type="text" name="slug_en">
    Origin
    <input type="text" name="origin">
    URL
    <input type="url" name="link">
    <input type="submit" name="hinzufuegen" value="neuen Newsbeitrag erstellen">
  </form>

  <?php


  foreach($news as $id => $new) {
    echo $new;
    echo "<br/>";
    echo '<form action="edit" method="post"><input type="hidden" name="id" value='.$id.'><input type="submit" name="loeschen" value="Newsbeitrag löschen"></form>';

  }


  echo $this->pagination->create_links();
  ?>



</article>
