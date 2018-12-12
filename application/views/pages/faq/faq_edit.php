<article>
  <form action="edit" method="post">
    <textarea class="large" name="einleitungstext"><?php echo $faq_einleitung; ?></textarea></br>
    <input type="submit" name="aendern" value="Einleitungstext ändern"><br/>

    <button name="faq_aend" value="faq_aend" type="submit">FAQ ändern</button>
    <button name="faq_hinzuf" value="faq_hinzuf" type="submit">FAQ hinzufügen</button>
    <button type="submit" name="faq_entf" value="faq_entf">FAQ löschen</button>


  </form>

</article>
