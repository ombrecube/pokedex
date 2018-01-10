<?php

class SiteController extends Controller {

	public function index() {
		$data = [ "pokemon" => Pokemon::findAll(),
		];
		$this->render("index", $data);
	}
}


