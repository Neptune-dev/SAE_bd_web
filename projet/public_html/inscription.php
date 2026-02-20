<html>
	<head>
		<title>Ajouter un elfe</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="login" style="max-width: ;">
        <h2>Création du compte d'un elfe</h2>
        <form action="ajout_elfe2.php" method="POST">
            <label for="id">Identifiant</label>
            <input type="text" id="id_elfe" name="id_elfe" required placeholder="Entrez l'identifiant de l'elfe">

            <label for="nom">Nom de l'elfe</label>
            <input type="text" id="nom_elfe" name="nom_elfe" required placeholder="Entrez le nom de l'elfe">

            <label for="login">Identifiant de connexion</label>
            <input type="text" name="login" required placeholder="Choisissez votre identifiant de connexion">

            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required placeholder="Choisissez votre mot de passe">

            <label for="elfe">Sélectionnez un elfe :</label>
        	<select name="id_elfe_remplacant" id="elfe_remplacant" required>
            	<option value="">Choisissez l'elfe remplaçant</option>
            	<?php
            		session_start();
            		include 'myparam.inc.php';
            		$conn = BDDConnection();

            		$sql = "SELECT id_elfe,nom_elfe FROM elfe";
            		$result = mysqli_query($conn,$sql);

            		if ($result && mysqli_num_rows($result)>0) {
            			while ($tb = mysqli_fetch_assoc($result)) {
            				echo "<option value='{$tb['id_elfe']}'>{$tb['nom_elfe']}</option>";
            			}
            		}
            		mysqli_close($conn);
            	?>
        	</select>
        	<br>
        	<label for="elfe">Sélectionnez les spécialités :</label>
            <?php
            	$conn = BDDConnection();

            	$sql = "SELECT id_specialite,nom_specialite FROM Specialite";
            	$result = mysqli_query($conn,$sql);

            	if ($result && mysqli_num_rows($result)>0) {
            		while ($tb = mysqli_fetch_assoc($result)) {
            			echo "<input type='checkbox' value='{$tb['id_specialite']}'>{$tb['nom_specialite']}</input><input type='radio' value='{$tb['id_specialite']}_primaire'>Primaire</input><input type='radio' value='{$tb['id_specialite']}_secondaire'>Secondaire</input><br>";
            		}
            	}
            	mysqli_close($conn);
            ?>
        	<br>
        	<label for="elfe">Sélectionnez une équipe :</label>
        	<select name="id_equipe" id="equipe" required>
            	<option value="">Choisissez une équipe</option>
            	<?php
            		$conn = BDDConnection();

            		$sql = "SELECT id_equipe FROM Equipe";
            		$result = mysqli_query($conn,$sql);

            		if ($result && mysqli_num_rows($result)>0) {
            			while ($tb = mysqli_fetch_assoc($result)) {
            				echo "<option value='{$tb['id_equipe']}'>{$tb['id_equipe']}</option>";
            			}
            		}
            		mysqli_close($conn);
            	?>
        	</select>
        	<br>
        	<label>Date de naissance :</label>

			<select name="jour" required>
    		<option value="">Jour</option>
    		<?php 
    			for ($i = 1; $i <= 31; $i++){
    				echo "<option value='{$i}'>$i</option>";
    			}
        	?>
        	</select>
        	<select name="mois" required>
        	<option value="">Mois</option>
        	<?php 
    			for ($i = 1; $i <= 12; $i++){
    				echo "<option value='{$i}'>$i</option>";
    			}
        	?>
        	</select>
        	<select name="annee" required>
        	<option value="">Année</option>
        	<?php
        		$annee_actuelle = date("Y");
    			for ($i = $annee_actuelle; $i >= 1900; $i--){
    				echo "<option value='{$i}'>$i</option>";
    			}
        	?>
        	</select>
        	<br>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
</body>
</html>