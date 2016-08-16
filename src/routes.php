<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);


});

//creating new account
$app->post('/auth/new', function ($request, $response, $args) {
    include_once '../lib/controller/memberFunc.php';
    return sign_up($request->getParam('username'),$request->getParam('password'));
    //return $request->getParam('username');
});

$app->post('/auth/login/{user}',function($request, $response, $args){
	include_once '../lib/controller/memberFunc.php';
	return login($args['user'],$request->getParam('pass'));
});

$app->get('/list/{user}',function($request, $response, $args){
	include_once '../lib/controller/listFunc.php';
	return get_item($args['user']);
});

$app->post('/list/{user}/add',function($request, $response, $args){
	include_once '../lib/controller/listFunc.php';
	return add_item($args['user'],$request->getParam('list'));
});
?>
