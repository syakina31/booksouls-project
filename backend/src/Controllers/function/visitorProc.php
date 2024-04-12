<?php 
// GET all VISITOR 
function getAllvisitor($db) {

    
    $sql = 'Select * FROM visitor '; 
    $stmt = $db->prepare ($sql); 
    $stmt ->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 

// GET VISITOR by id 
function getvisitor($db, $visitorId) {

    $sql = 'Select o.visitorID, o.visitorName, o.bookTitle, o.borrowDate, o.returnDate FROM visitor o  ';
    $sql .= 'Where o.id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $visitorId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}

// ADD new VISITOR 
function createvisitor($db, $form_data) { 
    //stop at sisni
    $sql = 'Insert into visitor ( visitorID, visitorName, bookTitle, borrowDate, returnDate )'; 
    $sql .= 'values (:visitorID, :visitorName, :bookTitle, :borrowDate, :returnDate)';  
    $stmt = $db->prepare ($sql); 
    $stmt->bindParam(':visitorID', $form_data['visitorID']);  
    $stmt->bindParam(':visitorName', ($form_data['visitorName']));
    $stmt->bindParam(':bookTitle', ($form_data['bookTitle']));
    $stmt->bindParam(':borrowDate', ($form_data['borrowDate']));
    $stmt->bindParam(':returnDate', ($form_data['returnDate']));
    $stmt->execute(); 
    return $db->lastInsertID();
}


// DELETE VISITOR by id 
function deletevisitor($db,$visitorId) { 

    $sql = ' Delete from visitor where id = :id';
    $stmt = $db->prepare($sql);  
    $id = (int)$visitorId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
} 

// UPDATE VISITOR by id 
function updatevisitor($db,$form_dat,$visitorId) { 

    
    $sql = 'UPDATE visitor SET visitorID = :visitorID,  visitorName = :visitorName, bookTitle = :bookTitle, borrowDate = :borrowDate, returnDate = :returnDate'; 
    $sql .=' WHERE id = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$visitorId;  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':visitorID', $form_dat['visitorID']);    
    $stmt->bindParam(':visitorName', ($form_dat['visitorName']));
    $stmt->bindParam(':bookTitle', ($form_dat['bookTitle']));
    $stmt->bindParam(':borrowDate', ($form_dat['borrowDate']));
    $stmt->bindParam(':returnDate', ($form_dat['returnDate']));
    $stmt->execute(); 
}
