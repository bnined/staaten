<?php
if($this->session->userdata('logged_in')) {
  $username = $this->session->logged_in['benutzername'];
} else {
  die("Umleitung muss noch konfiguriert werden!");        /* Umleitung konfigurieren  */
}
?>

<div>
<?php
  echo "Hi <b id='welcome'><i>" . $username . "</i> !</b>";
  echo "<br/>";
  echo "<br/>";
  echo "Du bist angemeldet und kannst nun Texte verändern, hinzufügen und löschen.";
  echo "<br/>";
?>
<b id="logout"><a href="logout">Logout</a></b>
</div>
<br/>
