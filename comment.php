<?php
session_start();
$id = $_POST['article_id'];
$collect=$_SESSION['collect'];
try {
 			$connection = new MongoClient();
            $database = $connection->selectDB('Nearby');
            $collection = $database->selectCollection($collect);
} catch (MongoConnectionException $e) {
die('Failed to connect to MongoDB '.$e->getMessage());
}
$article = $collection->findOne(array('_id' =>new MongoId($id)));
$comment = array(
'name' => $_POST['commenter_name'],
'email' => $_POST['commenter_email'],
'comment' => $_POST['comment'],
'posted_at' => new MongoDate()
);
$collection->update(array('_id' => new MongoId($id)),array('$push' => array('comments' => $comment)));
header('Location: index4.php?id='.$id);
?>