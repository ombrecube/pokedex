<?php

// Gestion des routes
// Déclenchement automatique des controleurs
// ToDo : gestion des erreurs d'accès


// Accès POST ou GET indifférent
$parameters = array();
if (isset($_POST))
	foreach($_POST as $k=>$v)
		$parameters[$k] = $v;
if (isset($_GET))
	foreach($_GET as $k=>$v)
		$parameters[$k] = $v;

// Pour accès ultérieur sans "global"
function parameters() {
	global $parameters;
	return $parameters;
}

function error($id) {
	$ec = new ErrorController();
	$ec->index($id);
	exit();
}

// Gestion des la route : paramètre r = controller/action
if (isset(parameters()["r"])) {

	$route = parameters()["r"];
	if (strpos($route,"/") === FALSE)
		list($controller, $action) = array($route, "index");
	else
		list($controller, $action) = explode("/", $route);

	// $controller = ucfirst($controller)."Controller";
	// $c = new $controller();
	// $c->$action();
	$controller = ucfirst($controller)."Controller";
	if(file_exists("controller/".$controller.".php")) {
		$c = new $controller();

		if(method_exists($c, $action))
			$c->$action();
		else
			error(404);
	}
	else
		error(404);

} else {

	$c = new SiteController();
	$c->index();

}
