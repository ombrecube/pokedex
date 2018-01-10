<?php

class ErrorController extends Controller {

	public function index($id = null) {
		if(!$id)
			$id = parameters()["id"];

		$this->render("error".$id);
	}
}
