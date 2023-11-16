<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  /*$receiving_email_address = 'gwenaelpetit59@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  /*$contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();*/


  // Page : contact.php
//mettez ici votre adresse mail
//de préférence une adresse avec le même domaine de là où, vous utilisez ce code, cela permet un envoie quasi certain jusqu'au destinataire
$votre_adresse_mail = 'gwenaelpetit59@gmail.com';
// si le bouton "Envoyer" est cliqué
if(isset($_POST['envoyer'])){
  
  //on vérifie que le champ mail est correctement rempli
  if(empty($_POST['email'])) {
    echo "<p>Le champ mail est vide.</p>";
  
  //on vérifie que l'adresse est correcte
  }elseif(!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i", $_POST['email'])){
    
    echo "<p>L'adresse mail entrée est incorrecte.</p>";
  
  //on vérifie que le champ sujet est correctement rempli
  }elseif(empty($_POST['subject'])){
    
    echo "<p>Le champ sujet est vide.</p>";
  
  //on vérifie que le champ message n'est pas vide
  }elseif(empty($_POST['message'])){
    
    echo "<p>Le champ message est vide.</p>";
  
  //tout est correctement renseigné, on envoi le mail
  }else{
    
    
    //mail de l'utilisateur
    $mail_de_lutilisateur = $_POST['email']; 
    
    //on renseigne les entêtes de la fonction mail de PHP
    // Attention à ne pas mettre de caractère spéciaux à "nom de votre site" qui pourraient poser problème
    $entetes_du_mail = [];
    $entetes_du_mail[] = 'MIME-Version: 1.0';
    $entetes_du_mail[] = 'Content-type: text/html; charset=UTF-8';
    $entetes_du_mail[] = 'From: Nom de votre site <' . $mail_de_lutilisateur . '>';
    $entetes_du_mail[] = 'Reply-To: Gwenael-petit <' . $mail_de_lutilisateur . '>';
    
    //ajoute des sauts de ligne entre chaque headers
    $entetes_du_mail = implode("\r\n", $entetes_du_mail);
    
    //base64_encode() est fait pour permettre aux informations binaires d'être manipulées par les systèmes qui ne gèrent pas correctement les 8 bits (=?UTF-8?B? est une norme afin de transmettre correctement les caractères de la chaine)
    $sujet = '=?UTF-8?B?' . base64_encode($_POST['subject']) . '?=';
    
    //htmlentities() converti tous les accents en entités HTML, ENT_QUOTES Convertit en + les guillemets doubles et les guillemets simples, en entités HTML
    $message = htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8');
    
    //ajoute des sauts de ligne HTML si l'utilisateur en a utilisé
    $message = nl2br($message);
    
    //en fin, on envoi le mail
    
    
    if(mail($votre_adresse_mail, $sujet, $message, $entetes_du_mail)){
      
      echo "<p>Le mail à été envoyé avec succès !</p>";
    
    }else{
      
      echo "<p>Une erreur est survenue, le mail n'a pas été envoyé.</p>";
    
    }
  }
}
?>

