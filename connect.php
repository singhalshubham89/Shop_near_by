<?php
   // connect to mongodb
   $m = new MongoClient();
   echo "Connection to database successfully";
	
   // select a database
   $db = $m->shopnearby;
   echo "Database mydb selected";
   $collection = $db->Hotelandstall;
   echo "Collection selected succsessfully";

   $cursor = $collection->find();
	foreach ( $cursor as $id => $value )
	{
		//echo "$id: ";
		var_dump( $value );
	}
 
?>