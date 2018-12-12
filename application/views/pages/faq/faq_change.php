<article>
  <form action="change" method="post">

    <?php
    $nr = count($faq);
    for ($i = 1; $i <= $nr; $i++) {
      echo "<textarea class='large' name='faq$i'>".$faq[$i]."</textarea></br>";
    }?>

    <input type="submit" name="aendern" value="Änderungen speichern">

  </form>

</article>
