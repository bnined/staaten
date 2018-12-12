<article>

  <?php
  echo form_open('test');
  ?>
  Länderkürzel
  <input type="text" name="kuerzel"><br/>
  Ländername
  <input type="text" name="name"><br/>
  Ländername_en
  <input type="text" name="name_en"><br/>
  Ländername für Navi
  <input type="text" name="navi"><br/>
  Ländername_en für Navi
  <input type="text" name="navi_en"><br/>

  <input type="radio" name="shs" value="shs">Sicherer Herkunftsstaat<br/>
  <input type="radio" name="shs" value="ahs">Anderer Herkunftsstaat<br/>

  <p>Abschnitt 1:
    <textarea class="large" name="staatentext1"><h1>Hauptüberschrift</h1><p>erster Absatz</p><p>zweiter Absatz</p></textarea>
  </p>
  <p>Abschnitt 2:
    <textarea class="large" name="staatentext2"><h2>ggf. Zwischenüberschrift</h2><p>erster Absatz</p><p>zweiter Absatz</p></textarea>
  </p>
  <p>Abschnitt 3:
    <textarea class="large" name="staatentext3"><h2>ggf. Zwischenüberschrift</h2><p>erster Absatz</p><p>zweiter Absatz</p></textarea>
  </p>
  <p>Abschnitt 4:
    <textarea class="large" name="staatentext4"><h2>ggf. Zwischenüberschrift</h2><p>erster Absatz</p><p>zweiter Absatz</p></textarea>
  </p>



  <?php
  echo form_submit('aendern', 'Ändern');
  echo form_close();

  ?>


</article>
