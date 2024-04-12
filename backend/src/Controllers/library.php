<?php

use Slim\Http\Request; //namespace 
use Slim\Http\Response; //namespace 

//include adminProc.php file 
include __DIR__ .'/function/bookProc.php';
include __DIR__ .'/function/visitorProc.php';


//alow cors
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
//end


// BOOK

// Read table book 
$app->get('/book', function (Request $request, Response $response, array $arg){

    return $this->response->withJson(array('data' => 'success'), 200); });  
 
// Read all data from table book 
$app->get('/allbook',function (Request $request, Response $response,  array $arg) { 

    $data = getAllbook($this->db); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 

// Request table order by condition (book id) 
$app->get('/book/[{id}]', function ($request, $response, $args){   
    $bookId = $args['id']; 
    if (!is_numeric($bookId)) { 

        return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);  
} 
    $data = getbook($this->db, $bookId); 
    if (empty($data)) { 

        return $this->response->withJson(array('error' => 'no data'), 500); 
} 

return $this->response->withJson(array('data' => $data), 200);});

// POST method order
$app->post('/book/add', function ($request, $response, $args) { 

    $form_data = $request->getParsedBody(); 
    $data = createbook($this->db, $form_data); 
    if (is_null($data)) {  

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 


// DELETE row Order
$app->delete('/book/del/[{id}]', function ($request, $response, $args){   
    $bookId = $args['id']; 
    
   if (!is_numeric($bookId)) { 

       return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
       $data = deletebook($this->db,$bookId); 
       if (empty($data)) { 

           return $this->response->withJson(array($bookId=> 'is successfully deleted'), 202);}; }); 
 

   
// PUT table order 
$app->put('/book/put/[{id}]', function ($request, $response, $args){
    $bookId = $args['id']; 
    
    if (!is_numeric($bookId)) { 
        
        return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
        $form_dat=$request->getParsedBody(); 
        $data=updatebook($this->db,$form_dat,$bookId); 
        if ($data <=0)
        return $this->response->withJson(array('data' => 'successfully updated'), 200); 
});

// --------------------------------------------------------------------------------------------------------------------------

// VISITOR

// Read table visitor 
$app->get('/visitor', function (Request $request, Response $response, array $arg){

    return $this->response->withJson(array('data' => 'success'), 200); });  
 
// Read all data from table visitor 
$app->get('/allvisitor',function (Request $request, Response $response,  array $arg) { 

    $data = getAllvisitor($this->db); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 

// Request table order by condition (visitor id) 
$app->get('/visitor/[{id}]', function ($request, $response, $args){   
    $visitorId = $args['id']; 
    if (!is_numeric($visitorId)) { 

        return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);  
} 
    $data = getvisitor($this->db, $visitorId); 
    if (empty($data)) { 

        return $this->response->withJson(array('error' => 'no data'), 500); 
} 

return $this->response->withJson(array('data' => $data), 200);});

// POST method order
$app->post('/visitor/add', function ($request, $response, $args) { 

    $form_data = $request->getParsedBody(); 
    $data = createvisitor($this->db, $form_data); 
    if (is_null($data)) { 

        return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404); 
} 
    return $this->response->withJson(array('data' => $data), 200); }); 


// DELETE row Order
$app->delete('/visitor/del/[{id}]', function ($request, $response, $args){   
    $visitorId = $args['id']; 
    
   if (!is_numeric($visitorId)) { 

       return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
       $data = deletevisitor($this->db,$visitorId); 
       if (empty($data)) { 

           return $this->response->withJson(array($visitorId=> 'is successfully deleted'), 202);}; }); 
 

   
// PUT table order 
$app->put('/visitor/put/[{id}]', function ($request, $response, $args){
    $visitorId = $args['id']; 
    
    if (!is_numeric($visitorId)) { 
        
        return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
        $form_dat=$request->getParsedBody(); 
        $data=updatevisitor($this->db,$form_dat,$visitorId); 
        if ($data <=0)
        return $this->response->withJson(array('data' => 'successfully updated'), 200); 
});
