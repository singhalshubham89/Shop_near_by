<?php
    session_start();
    $type=$_GET['Type'];
    $_SESSION['collect'] = $_GET['Collect'];
    try {
            $connection = new MongoClient();
            $database = $connection->selectDB('Nearby');
            $collection = $database->selectCollection($_SESSION["collect"]);
        } 
     catch(MongoConnectionException $e) {
        die("Failed to connect to database ".$e->getMessage());
    }
    $cursor = $collection->find(array('Type'=>$type));
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
            <h1 style="text-align : center">Shops</h1>
            <?php while ($cursor->hasNext()):$article = $cursor->getNext(); ?>
            <div class="box">
            <h2><?php echo $article['Name']; ?></h2>
             <p>
                Ratings : <?php echo $article['Ratings']; ?>
            </p>
            <p>
                Opening and closing Timing : <?php echo $article['Time']; ?>
            </p>
            <p>
                <div class="button">
                            <a href="index4.php?id=<?php echo $article['_id'];?>">Read more</a>
                </div>
               
            </p>
        </div>
            <?php endwhile; ?>
        </div>
    </div>

    </body>
</html>
