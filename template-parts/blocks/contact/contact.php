<?php
/**
 * Block Name: Contact
 *
 * This is the template that displays the contact form block.
 */

$message_success = get_field('message_succes');
$text_bouton_send = get_field('texte_bouton_send');
$color_ = get_field('color_');
$color_text_bouton_send = get_field('color_text_bouton_send');
$color_hover = get_field('color_hover');
$size_font_sent_message = get_field('size_font_sent_message');
$to = get_field('to');

if (isset($_GET['success'])) {
  $datas = $_GET['success']; ?>
  <div class="alert-message success">
    <span><?php echo $message_success; ?></span></br>
    <span><strong><?php echo $datas; ?></strong></span>
  </div>
<?php }

if(array_key_exists('errors', $_SESSION)):
  if (isset($_GET['errors'])) {
    $datas = $_GET['errors']; ?>
    <div class="alert-message error">
      <span><?php echo $datas; ?></span>
    </div>
  <?php }

endif; ?>

<div class="form1">

  <?php if( have_rows('input') ): ?>
    <form action="#" id="contactForm" method="post">
    <?php wp_nonce_field('contact-form', 'contact-verif');
    // loop through the rows of data
    while ( have_rows('input') ) : the_row();
	  // display a sub field value
	  $label = get_sub_field('label');

            switch ($label) {
              case 'name': ?>
                <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
            <input type="text" name="<?php echo $label; ?>" id="<?php echo $label; ?>" value="<?= isset($_SESSION['input']['nom']) ? $_SESSION['input']['nom']:'';   ?>" /><?php
                break;
               case 'email': ?>
                <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
            <input type="email" name="<?php echo $label; ?>" id="<?php echo $label; ?>" value="<?= isset($_SESSION['input']['email']) ? $_SESSION['input']['email']:'';   ?>" /><?php
                break;
              case 'phone': ?>
                <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
                <input type="text" name="<?php echo $label; ?>" id="<?php echo $label; ?>" value="<?= isset($_SESSION['input']['téléphone']) ? $_SESSION['input']['téléphone']:'';   ?>" /><?php
                break;
               case 'web site': ?>
                <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
                <input type="url" name="<?php echo $label; ?>" id="<?php echo $label; ?>" value="<?= isset($_SESSION['input']['site web']) ? $_SESSION['input']['site web']:'';   ?>" /><?php
                break;
               case 'subject': ?>
                <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
                <input type="text" name="<?php echo $label; ?>" id="<?php echo $label; ?>" value="<?= isset($_SESSION['input']['sujet']) ? $_SESSION['input']['sujet']:'';   ?>" /><?php
                break;
              default: ?>
                <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
        <textarea name="<?php echo $label; ?>" id="<?php echo $label; ?>" rows="20" cols="30"><?= isset($_SESSION['input']['message']) ? $_SESSION['input']['message']:'';   ?></textarea><?php
                break;
            }

      endwhile; ?>
      <button id="submit" type="submit"><?php echo $text_bouton_envoi; ?></button>
      <input type="hidden" name="submitted" id="submitted" value="true" />
      <input type="hidden" name="to" id="to" value="<?php echo $to; ?>" />
  </form>
</div>
<?php else :

    // no rows found

endif;
unset($_SESSION['errors']);
unset($_SESSION['input']);

?>

<style type="text/css">
.form1 button {
  background-color: <?php echo $color_; ?>;
  color:  <?php echo $color_text_bouton_send; ?>;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
  margin-top: 10px;
  font-size: <?php echo $size_font_sent_message; ?>px;
}

.form1 button:hover {
  background-color: <?php echo $color_hover; ?>;
}

.alert-message.success {
  background-color: <?php echo $color_; ?>;
  padding: 10px;
  line-height: 2em;
}

</style>
