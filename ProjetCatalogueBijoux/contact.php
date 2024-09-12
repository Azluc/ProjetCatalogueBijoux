

<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';


    $donnees_valides = true;
    $date_valide = true;
    $nom_valide = true;
    $prenom_valide = true;
    $email_valide = true;
    $date_naissance_valide = true;
    $sujet_valide = true;
    $contenu_valide = true;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_du_contact = $_POST['date_du_contact'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $genre = $_POST['genre'];

    $date_naissance = $_POST['date_naissance'];
    $fonction = $_POST['fonction'];
    $sujet = $_POST['sujet'];
    $contenu = $_POST['contenu'];

    $objet = "Nouveau formulaire : " . $sujet;
    $messageH = "Formulaire rempli par Mr " . $nom . " " . $prenom . " (" . $email . "), le sujet du mail est le suivant : " . $sujet . ". Voici le contenu du message : " . $contenu;
    $messageF = "Formulaire rempli par Mme " . $nom . " " . $prenom . " (" . $email . "), le sujet du mail est le suivant : " . $sujet . ". Voici le contenu du message : " . $contenu;

    if(empty($date_du_contact)) {
        $date_valide = false;
        $donnees_valides = false;
    }

    if(!ctype_alpha($nom)){
        $nom_valide = false;
        $donnees_valides = false;
    }

    if(!ctype_alpha($prenom)){
        $prenom_valide = false;
        $donnees_valides = false;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_valide = false;
        $donnees_valides = false;
    }

    if(empty($date_naissance)) {
        $date_naissance_valide = false;
        $donnees_valides = false;
    }

    if(empty($sujet)){
        $sujet_valide = false;
        $donnees_valides = false;
    }

    if(empty($contenu)){
        $contenu_valide = false;
        $donnees_valides = false;
    }

    if ($donnees_valides) {

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'formulaireperlfect@gmail.com';
        $mail->Password = 'rnvjwhteuhltylkl';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('formulaireperlfect@gmail.com');
        $mail->addAddress('webmasterpearlfect@gmail.com');
        $mail->isHTML(true);

        $mail->Subject = $objet;

        if($genre=='Homme'){
            $mail->Body = $messageH;
            $mail->send();
        }
        else{
            $mail->Body = $messageF;
            $mail->send();
        }
        
    }
    }

?>

<link rel="stylesheet" href="css/contact.css">
<section>
        <h2>Contactez-nous</h2><br /><br />
        <form novalidate action="/index.php?page=contact" method="post"> <!--l'attribut novalidate nous permet d'avoir le controle sur la validation-->
            <div>
                <label for="date_du_contact">
                    <span>Date du contact</span>
                    <input type="date" id="date_du_contact" name="date_du_contact" placeholder="04/11/2020" value="<?php if (!$donnees_valides) echo $date_du_contact ?>">
                    <span class="error <?php if (!$date_valide) echo 'active' ?>" id="error-dateContact"><?php if (!$date_valide) echo "Vous n'avez pas saisi de date valide : jj/mm/aaaa" ?></span>
                </label>
                <br /><br />

                <label for="nom">
                    <span>Nom</span>
                    <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" value= "<?php if (!$donnees_valides) echo $nom ?>">
                    <span class="error <?php if (!$nom_valide) echo 'active' ?>" id="error-nom"><?php if (!$nom_valide) echo "Vous n'avez pas saisi un nom valide : seules  les lettres sont autorisées" ?></span>
                </label>
                <br /><br />

                <label for="prenom">
                    <span>Prenom</span>
                    <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" value= "<?php if (!$donnees_valides) echo $prenom ?>">
                    <span class="error <?php if (!$prenom_valide) echo 'active' ?>" id="error-prenom" ><?php if (!$prenom_valide) echo "Vous n'avez pas saisi un prenom valide : seules les lettres sont autorisées" ?></span>
                </label>
                <br /><br />

                <label for="email">
                    <span>Email</span>
                    <input type="email" id="email" name="email" placeholder="monmail@monsite.org" value= "<?php if (!$donnees_valides) echo $email ?>">
                    <!--message erreur à afficher-->
                    <span class="error <?php if (!$email_valide) echo 'active' ?>" id="error-email" aria-live="polite"><?php if (!$email_valide) echo "Vous n'avez pas saisi un email valide : monmail@monsite.org " ?></span>
                </label>
                <br /><br />

                <label>Genre</label>
                <input type="radio" id="femme" name="genre" value="Femme" checked>
                <label for="femme">Femme</label>
                <input type="radio" id="homme" name="genre" value="Homme">
                <label for="homme">Homme</label><br /><br /><br />

                <label for="date_naissance">
                    <span>Date de Naissance</span>
                    <input type="date" id="date_naissance" name="date_naissance" value= "<?php if (!$donnees_valides) echo $date_naissance ?>">
                    <span class="error <?php if (!$date_naissance_valide) echo 'active' ?>" id="error-dateNaissance"><?php if (!$date_naissance_valide) echo "Vous n'avez pas saisi de date valide : jj/mm/aaaa" ?></span>
                </label>
                <br /><br />

                <label for="fonction">
                    <span>Fonction :</span>
                    <select id="fonction" name="fonction">
                        <option value="Enseignant">Enseignant</option>
                        <option value="Etudiant">Etudiant</option>
                        <option value="Artisan">Artisan</option>
                        <option value="Agriculteur">Agriculteur</option>
                        <option value="Cadre">Cadre</option>
                        <option value="Ouvrier">Ouvrier</option>
                        <option value="Retraité">Retraite</option>
                        <option value="Sans-profession">Sans-profession</option>
                    </select>
                </label>
                <br /><br />

                <label for="sujet">
                    <span>Sujet :</span>
                    <input type="text" id="sujet" name="sujet" placeholder="Entrez le sujet de votre mail" value= "<?php if (!$donnees_valides) echo $sujet ?>">
                    <span class="error <?php if (!$sujet_valide) echo 'active' ?>" id="error-sujet" aria-live="polite"><?php if (!$sujet_valide) echo "Vous n'avez pas saisi de sujet" ?></span>
                </label>
                <br /><br />


                <label for="contenu">
                    <span> Contenu :</span>
                    <textarea id="contenu" name="contenu" rows="4" placeholder="Tapez ici votre mail" value= "<?php if (!$donnees_valides) echo $contenu ?>"></textarea>
                    <span class="error  <?php if (!$contenu_valide) echo 'active' ?>" id="error-contenu" aria-live="polite"><?php if (!$contenu_valide) echo "Vous n'avez pas saisi de contenu" ?></span>
                </label>
                <br /><br />

                <input type="submit" value="Envoyer">
            </div>
        </form>
    </section>
  </div>

<script src="js/contact.js"></script>

<?php

if (!$nom_valide)
{
    echo "<script>document.getElementById('nom').setCustomValidity('Invalid Field');</script>";
}

if (!$prenom_valide)
{
    echo "<script>document.getElementById('prenom').setCustomValidity('Invalid Field');</script>";
}


if (!$sujet_valide)
{
    echo "<script>document.getElementById('sujet').setCustomValidity('Invalid Field');</script>";
}

if (!$contenu_valide)
{
    echo "<script>document.getElementById('contenu').setCustomValidity('Invalid Field');</script>";
}




?>