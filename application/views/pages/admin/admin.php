<?php
if (isset($logout_message)) {
  echo "<div class='message'>";
  echo $logout_message;
  echo "</div>";
}
?>
<?php
if (isset($message_display)) {
  echo "<div class='message'>";
  echo $message_display;
  echo "</div>";
}
?>

<?php echo form_open('admin/login_process');?>

<?php
echo "<div class='error_msg'>";
  if (isset($error_message)) {
  echo $error_message;
  }
  echo validation_errors();
  echo "</div>";
?>

<h5>Name</h5>
<input type="text" name="benutzername" value="<?php echo set_value('benutzername'); ?>" size="50" />

<h5>Password</h5>
<input type="password" name="password" value="" size="50" />

<div><input type="submit" value="Login" /></div>

<?php echo form_close(); ?>
