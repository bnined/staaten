<article>
  <form action="delete" method="post">
    <select name="eintr_loeschen">
    <?php
    foreach($laenderliste as $id => $land) {
      echo '<option value="' . $id . '">' . $land . '</option>';
    }
     ?>
   </select>
   <input type="submit" name="loeschen" value="Datensatz löschen">
  </form>
</article>
