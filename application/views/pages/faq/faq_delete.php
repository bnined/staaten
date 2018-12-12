<article>

  <form action="delete" method="post">
    <select name="eintr_loeschen">
    <?php
    foreach($faq_liste as $id => $faq) {
      if($id != 'einleitung') {
        echo '<option value="' . $id . '">' . $faq . '</option>';
      }
    }
     ?>
   </select>
    <input type="submit" name="loeschen" value="FAQ löschen">
  </form>

</article>
