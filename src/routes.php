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
//getting the list
$app->get('/list/{list_id}',function($request, $response, $args){
	include_once '../lib/controller/listFunc.php';
	return get_list($args['list_id']);
});

// $app->post('/list/{user_id}/add',function($request, $response, $args){
// 	include_once '../lib/model/db.php';
// 	return new_entry($args['user_id'],$request->getParam('list_id'),$request->getParam('item_name'),$request->getParam('quantity'));
// });
$app->post('/list/{user_id}/add',function($request, $response, $args){
    include_once '../lib/model/db.php';
    $list=json_decode($request->getParam('list'),true);
    return new_entry($args['user_id'],$list['list_id'],$list['item_name'],$list['quantity']);
});

$app->post('/list/{user}/edit/{id}',function($request, $response, $args){
    include_once '../lib/controller/listFunc.php';
    return edit_item($args['id'],$args['user'],$request->getParam('list'));
});

//deleting an item
$app->get('/list/{item_id}/delete',function($request, $response, $args){
    include_once '../lib/model/db.php';
    return delete_item($args['item_id']);
});

//this route is for checking the offer suggesting 
$app->get('/list/{user_id}/ideamart',function($request, $response, $args){
    include_once '../lib/controller/offerFunc.php';
    return match_discount_user($args['user_id']);
});

$app->get('/list/{user_id}/offer',function($request, $response, $args){
    include_once '../lib/controller/offerFunc.php';
    return match_offer_push($args['user_id']);
});

$app->get('/list/{user_id}/discount',function($request, $response, $args){
    include_once '../lib/controller/offerFunc.php';
    return match_discount_push($args['user_id']);
});
?>
