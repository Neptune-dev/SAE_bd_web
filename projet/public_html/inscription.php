<html>
    <head>
        <title>Changer le mots de passe</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <div class="login" style="max-width: ;">
        <h2>Changement du mots de passe</h2>

        <?php
            session_start();
            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['user'])) {
                require_once 'db.php';
                $user=$_SESSION['user'];
                echo $user;
                $id=$user['ID_PERSONNEL'];

                $sql="SELECT pwd,actif FROM personnel WHERE id_personnel=:id";
                $row = db_one($sql,[":id" => $id]);

                $mdp1=$_POST['mdp1'];
                $mdp2=$_POST['mdp2'];

                if ($_POST['id_pers']==$user['ID_PERSONNEL']) {
                    echo "1";
                    if (password_verify($_POST['mdp'], $row['PWD'])) {
                        echo "2";
                        if ($mdp1==$mdp2) {
                            echo "3";
                            $hash=password_hash($mdp1, PASSWORD_DEFAULT);
                            $sql="UPDATE personnel SET actif=1 WHERE id_personnel=:id";
                            db_exec($sql,[":id"=>$id]);
                            $sql="UPDATE personnel SET pwd =:mdp WHERE id_personnel=:id";
                            db_exec($sql,[":id"=>$id,":mdp"=>$hash]);
                            header("Location: logout.php");
                            exit();
                        } else {
                            // Mot de passe 1 et 2 pas identique
                        }
                    } else {
                        // Mot de passe ancien pas bon
                    }
                }

            } else {
                echo "pb session";
            }           
        ?>

        <form action="#" method="POST">
            <label for="id">Identifiant</label>
            <input type="text" id="" name="id_pers" required placeholder="Entrez votre identifiant">

            <label for="nom">Ancien mots de passe</label>
            <input type="password" id="" name="mdp" required placeholder="Entrez votre ancien mots de passe">

            <label for="nom">Nouveau mots de passe</label>
            <input type="password" id="" name="mdp1" required placeholder="Entrez votre nouveau mots de passe">

            <label for="nom">Confirmez le mots de passe</label>
            <input type="password" id="" name="mdp2" required placeholder="Retapez votre nouveau mots de passe">

            <br>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
</body>
</html>