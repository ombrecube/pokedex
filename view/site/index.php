
<div id="div-search">
		<form>
			<label for="name">Nom</label>
			<input type="text" name="name">
			<label>Type</label>
			<select id="select-type">
				<option value="feu">Feu</option>
				<option value="eau">Eau</option>
				<option value="psy">Psy</option>
				<option value="plante">Plante</option>
				<option value="roche">Roche</option>
			</select>
			<input type="submit" name="rechercher">
		</form>
	</div>

<div class="table-container">
		<table role="grid" class="table table-striped table-hover table-condensed tablesorter text-center tablesorter-default">
			<tr>
				<th>ID</th>
				<th>Nom</th>
				<th>Image</th>
				<th>Type</th>
			</tr>
			<?php
			foreach ($data["pokemon"] as $pokemon) {
				echo "<tr>";
				echo "<td>".$pokemon->id_pokedex."</td>";
				echo "<td>".$pokemon->name."</td>";
				echo "<td><img src='img/".$pokemon->id_pokedex.".png' width='50' height='50'></td>";
				echo "<td>".'<img src="img/type/'.$pokemon->type1.'.png" width="60" height="30">';
				if($pokemon->type2 != ""){
					echo '/<img src="img/type/'.$pokemon->type2.'.png" width="60" height="30">'."</td>";
				}
				echo "</tr>";
			}
			?>

		</table>
	</div>