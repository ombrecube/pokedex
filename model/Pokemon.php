<?php

class Pokemon{

	protected $_id_pokemon;
	protected $_id_pokedex;
	protected $_name;
	protected $_description;
	protected $_type1;
	protected $_type2;

	public function __construct($id=null){
		if ($id == null) {
			$st = db()->prepare("insert into pokemon default values returning ID_POKEMON");
			$st->execute();
			$row = $st->fetch();
			$this->_id_pokemon = $row["id_pokemon"];
		}
		else{
			$st = db()->prepare("select *
								 from pokemon pok
								 where ID_POKEMON=:id
								 order by pok.ID_POKEMON ASC ;");

			$st->bindValue(":id", $id);
			$st->execute();
			if ($st->rowCount() != 1) {
				error(404);
			}
			else {
				$row = $st->fetch(PDO::FETCH_ASSOC);
				$this->_id_pokemon = $row["id_pokemon"];
				$this->_id_pokedex = $row["id_pokedex"];
				$this->_name = $row["name"];
				$this->_description = $row["description"];
				$this->_type1 = $row["type1"];
				$this->_type2 = $row["type2"];
			}
		}
	}


	public function __get($fieldName) {
		$varName = "_".$fieldName;
		if (property_exists(get_class($this), $varName))
			return $this->$varName;
		else
			throw new Exception("Unknown variable: ".$fieldName);
	}

	public function __set($fieldName, $value) {
		$varName = "_".$fieldName;
		if ($value != null) {
			if (property_exists(get_class($this), $varName)) {
				$this->$varName = $value;

				$st = db()->prepare("update pokemon set $fieldName=:val where ID_POKEMON=:id");
				$st->bindValue(":val", $value);
				$st->bindValue(":id", $this->id_pokemon);
				$st->execute();
			} else
				throw new Exception("Unknown variable: ".$fieldName);
		}
	}

	/////////////////////////////////////////////////////////////
	//	            Renvoie touts les articles                 //
	/////////////////////////////////////////////////////////////
	public static function findAll() {
		$st = db()->prepare("select id_pokemon from pokemon order by id_pokemon ASC ;");
		$st->execute();
		$list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC)) {
			$list[] = new Pokemon($row["id_pokemon"]);
		}
		return $list;
	}
}