<?php 
// GET all BOOK 
function getAllbook($db) {

    
    $sql = 'Select * FROM book '; 
    $stmt = $db->prepare ($sql); 
    $stmt ->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 

// GET BOOK by id 
function getbook($db, $bookId) {

    $sql = 'Select o.bookID, o.bookTitle, o.bookAuthor, o.bookRate FROM book o  ';
    $sql .= 'Where o.id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $bookId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}

// ADD new BOOK 
function createbook($db, $form_data) { 
    //stop at sisni
    $sql = 'Insert into book ( bookID, bookTitle, bookAuthor, bookRate )'; 
    $sql .= 'values (:bookID, :bookTitle, :bookAuthor, :bookRate)';  
    $stmt = $db->prepare ($sql); 
    $stmt->bindParam(':bookID', $form_data['bookID']);  
    $stmt->bindParam(':bookTitle', ($form_data['bookTitle']));
    $stmt->bindParam(':bookAuthor', ($form_data['bookAuthor']));
    $stmt->bindParam(':bookRate', ($form_data['bookRate']));
    $stmt->execute(); 
    return $db->lastInsertID();
}


// DELETE BOOK by id 
function deletebook($db,$bookId) { 

    $sql = ' Delete from book where id = :id';
    $stmt = $db->prepare($sql);  
    $id = (int)$bookId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
} 

// UPDATE BOOK by id 
function updatebook($db,$form_dat,$bookId) { 

    
    $sql = 'UPDATE book SET bookID = :bookID, bookTitle = :bookTitle , bookAuthor = :bookAuthor , bookRate = :bookRate'; 
    $sql .=' WHERE id = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$bookId;  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':bookID', $form_dat['bookID']);    
    $stmt->bindParam(':bookTitle', ($form_dat['bookTitle']));
    $stmt->bindParam(':bookAuthor', ($form_dat['bookAuthor']));
    $stmt->bindParam(':bookRate', ($form_dat['bookRate']));
    $stmt->execute(); 
}
