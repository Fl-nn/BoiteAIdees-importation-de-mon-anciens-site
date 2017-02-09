<?php
if(!defined ("INC")){
		
		header("location:index.php?portails_info");
		exit;
	}
?>
<div class="container">
	<h1>Explications sur les dimensions et les modificateurs</h1>
	<p>
		<b>À savoir dans les dimensions :</b><br/>							
- Aucun monstre de dimension aggresse (sauf reine et nidas). <br/>					
- Le trousseau de clefs ne fonctionne PAS. Obligation d'avoir la clef du donjon souhaité.<br/>							
- Le déplacement dans Xelorium entre les différentes sous-zones se fait grace à des montres craftable dans un atelier a l'intérieur de l'avant-poste.<br/>							
- Dans chaque dimension un modificateur est actif et undebuffable ! Il change a chaque fois que le boss de la dimension est tué et tourne parmi ceux résumé dans le tableau ci-dessous! <br/>
- Le Modificateur est aussi activé en PVPM.<br/>
	</p>
	<table class="table table-striped">
		<tr>
			<td>Portails</td><td>Modificateurs</td><td>Explications</td>
		</tr>
		<tr><td rowspan="5">Enutrosor</td><td>Entraves blessantes</td><td>Les ennemis perdent des points de vie supplémentaires à chaque retrait de PM subi.</td></tr>
		<tr><td>Déplacements incapacitant</td><td>Lorsqu'un ennemi est porté, poussé, attiré ou transposé, la durée de ses envoûtements est réduite de 1 tour.</td></tr>
		<tr><td>Solitude revigorante</td><td>À chaque début de tour d'un allié, s'il n'a aucun allié à moins de 5 cases de lui, il est soigné de 10% de sa vitalité.</td></tr>
		<tr><td>Solidaires</td><td>À chaque début de tour, le personnage se soigne en fonction du nombre d'alliés à moins de 3 cases.</td></tr>
		<tr><td>Distance mesurée</td><td>Les ennemis perdent 1 PM lorsqu'ils sont attaqués en mêlée. Limite de cumul à 3. Les alliés subissent 20% de dommages en moins à distance.</td></tr>
		<tr><td rowspan="5">Srambad</td><td>Coups bas</td><td>Les dommages occasionnés par les glyphes, pièges, poisons, bombes et invocations sur les ennemis sont multipliés par 1,25.</td></tr>
		<tr><td>Berserker</td><td>Au début de leur tour, les alliés gagnent une augmentation de 33% de dommage s'ils ont moins de 50% de leur vie.</td></tr>
		<tr><td>Jeu dangereux</td><td>Chaque allié pose un piège à ses pieds au début de son tour. Ce piège occasionne des dommages aux ennemis et n'affecte pas les alliés.</td></tr>
		<tr><td>Larcin</td><td>Les alliés volent de la vie quand ils attaquent en mêlée.</td></tr>
		<tr><td>Evasion</td><td> Les attaques en mêlée poussent les ennemis de 3 cases.</td></tr>
		<tr><td rowspan="5">Xelorium</td><td>Enquête d'action</td><td>Les ennemis perdent des points de vie supplémentaires à chaque retrait de PA subi.</td></tr>
		<tr><td>Saute-Bouftou</td><td> Quand un allié subit des dommages d'un autre allié, ce dernier est téléporté symétriquement par rapport à sa cible.</td></tr>
		<tr><td>Retour arrière</td><td>Quand un ennemi reçoit des dommages de mêlée, il retourne à sa position précédente.</td></tr>
		<tr><td>Actions entravées</td><td>Les dommages d'arme retirent des PA aux adversaires.</td></tr>
		<tr><td>Solitude Momifiante</td><td>Solitude momifiante : A chaque début de tour d'un allié, s'il n'a aucun allé à moins de 5 cases de lui, il se transforme en momie et réduit les dommages reçus pendant 1 tour.</td></tr>
		<tr><td rowspan="5">Ecaflipus</td><td>Régénation critique</td><td>À chaque fois qu'un allié occasionne un coup critique, il est soigné de 2% de sa vitalité maximale.</td></tr>
		<tr><td>Roulette élémentaire</td><td>À chaque début de tour d'un allié, il gagne aléatoirement 200 d'intelligence, de chance, d'agilité ou de force pendant 1 tour.</td></tr>
		<tr><td>Case bonus</td><td>À chaque début de tour d'un allié, des cellules bonus sont posées à 4 cases de distance en ligne avec cet allié. S'il se déplace sur une de ces cellules, il gagne 2PA pour le tour en court. Non-cumulable.</td></tr>
		<tr><td>Bonne distance</td><td>Quand un ennemi subit des dommages, 20 % de ses dommages soignent les alliés situés à une distance d'exactement 7 cases de la cible.</td></tr>
		<tr><td>Cible prioritaire</td><td>À chaque début de tour d'un ennemi, il y a 10% de chance pour que cet ennemi devienne une cible prioritaire : la première fois qu'il subit des dommages dans le tour, son attaquant gagne 2PA pendant 2 tours. Non-cumulable.</td></tr>
		<tr><td rowspan="5">Communs à toutes les dimensions</td><td>Liaison longue portée</td><td>Quand un ennemi est attaqué, 20% des dommages qu'il subit sont renvoyés aux ennemis à plus de 10 PO.</td></tr>
		<tr><td>Poussées revigorantes</td><td>Quand un ennemi reçoit des dommages de poussée, une fois par tour, il génère du soin aux alliés autour de lui.</td></tr>
		<tr><td>Invocations incapacitantes</td><td>Les dommages occasionnés par les invocations non-statiques enlèvent un tour d'envoûtement aux ennemis.</td></tr>
		<tr><td>Puissance cyclique</td><td>Les ennemis ont 50% de vitalité supplémentaire. Les alliés gagnent 25% de dommages supplémentaires par tour à partir du second tour et reviennent à leurs dommages de base tous les 5 tours.</td></tr>
		<tr><td>Disparitions détonantes</td><td>Quand un ennemi meurt, il occasionne des dommages à ses alliés autour de lui proportionnellement à son nombre maximal de points de vie.</td></tr>
		</table>
</div> 																				