<?php
	require 'dbconnection.php';
	$mongo = DBConnection::instantiate();
	$gridFS = $mongo->database->getGridFS();
	$objects = $gridFS->find();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>Uploaded Images</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>
	<body>
		<div id="contentarea">
			<div id="innercontentarea">
				<h1>Uploaded Images</h1>
				<table class="table-list" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th width="30%">Caption</th>
							<th width="40%">Filename</th>
							<th width="30#">Size</th>
						</tr>
					</thead>
					<tbody>
						<?php while($object = $objects->getNext()): ?>
						<tr>
							<td>
								<?php echo $object->file['caption'];?>
							</td>
							<td>
							<a href="stream.php?id=<?php echo $object->file['_id'];?>">
							<?php echo $object->file['filename'];?>
							</a>
							</td>
							<td >
								<?php echo ceil($object->file['length'] /1024).' KB';?>
							</td>
						</tr>
						<?php endwhile;?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>