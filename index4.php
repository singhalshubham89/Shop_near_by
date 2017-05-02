<?php
    session_start();
    $id = $_GET['id'];
    $collect = $_SESSION['collect'];
    try {
            $connection = new MongoClient();
            $database = $connection->selectDB('Nearby');
            $collection = $database->selectCollection($collect);
        } 
     catch(MongoConnectionException $e) {
        die("Failed to connect to database ".$e->getMessage());
    }
   $article = $collection->findOne(array('_id' =>new MongoId($id)));
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        
        <!-- Font -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,700,600italic,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <!-- Font -->
        
        <link rel="stylesheet" href="css/new.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="style.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        
        
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <!-- Header Start -->
        <header id="home">
            
            <!-- Main Menu Start -->
            <div class="main-menu">
                <div class="navbar-wrapper">
                    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle Navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                
                                <a href="#" class="navbar-brand"><h1><b>SHOP NEARBUY!</b></h1></a>                          
                            </div>
                            
                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="index.php#home">Home</a></li>
                                    <li><a href="index.php#about">About</a></li>
                                    <li><a href="index.php#features">Food and Snacks</a></li>
                                    <li><a href="index.php#feature-work">Stationery and Gifts</a></li>
                                    <li><a href="index.php#testimonials">Emergency</a></li>
                                    <li><a href="index.php#blog">Other</a></li>
                                    
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Menu End -->

            <br><br><br>
            <div id="contentarea">
            <div id="innercontentarea">
            <div class="box">
            <h2 style="text-align:center"><?php echo $article['Name']; ?></h2>
            <p>
                Ratings : <?php echo $article['Ratings']; ?>
            </p>
            <p>
                Opening and closing Timing : <?php echo $article['Time']; ?>
            </p>
            <p> 
                Location : <?php echo $article['Address']; ?>
            </p>
            <p>
                Contact No : <?php echo $article['Phone no']; ?>
            </p>
            <p>
                Famous For : <?php echo $article['Famous for']; ?>
            </p>
            <p>
                Extras : <?php echo $article['Extra']; ?>
            </p>
            </div>
            <br>
            <div id="comment-section">
                
                    <?php if (!empty($article['comments'])): ?>
                <h3 style="text-align:center">Comments</h3>
                    <?php foreach($article['comments'] as $comment): ?>
                <div style="border-bottom: 1px solid #eee;">
                <h4><?php echo $comment['name'].' says...';?></h4>
                <p><?php echo $comment['comment']; ?></p>

                <span>
                <?php echo date('g:i a, F j', $comment['posted_at']->sec); ?>

                </span>
            </div><br/>
                <?php endforeach;endif;?>
                <h3>Post your comment</h3>
                <form action="comment.php" method="post">
                    <span class="input-label">Name</span>
                    <input type="text" name="commenter_name" class="comment-input"/>
                    <span class="input-label">Email</span>
                    <input type="text" name="commenter_email" class="comment-input"/><br><br>
                    <span class="input-label">Comment</span>
                    <textarea name="comment" rows="4"></textarea>
                    <input type="hidden" name="article_id" value="<?php echo $article['_id']; ?>"/><br>
                    <input type="submit" name="btn_submit" value="Save"/>
                 </form>
            </div>
        </div>
    </div>

    </body>
</html>