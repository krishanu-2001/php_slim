$app->get('/api/coders', function(Request $request, Response $response) {
    $sql = "SELECT * FROM coders";
    try{
        //get db object
        $db = new db();
        //connnect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customers);

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'} }';
    }
    
    return $response;
});