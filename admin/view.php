<?php
    require 'database.php';

    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }

    $db = Database::connect();
    $statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category
    FROM items LEFT JOIN categories ON items.category = categories.id
    WHERE items.id = ?');

    $statement->execute(array($id));
    $item = $statement->fetch();

    Database::disconnect();

    // Nettoyage data entree
    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Grainothèque</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="#">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

        <link rel="stylesheet" href="../css/styles.css">
    </head>

    <body>
        <h1 class="text-logo"><span class="bi-tree"></span> Grainothèque <span class="bi-tree"></span></h1>
        <div class="container admin">
            
            <div class="row">
                <div class="col-sm-6">
                    <h1><strong>Voir un item</strong></h1>
                    <br>
                    <form>
                        <div class="form-group">
                            <label>Nom:</label><?php echo ' ' . $item['name']; ?>
                        </div>
                        <div class="form-group">
                            <label>Description:</label><?php echo ' ' . $item['description']; ?>
                        </div>
                        <div class="form-group">
                            <label>Prix:</label><?php echo ' ' . number_format((float) $item['price'],2,'.','') . ' €'; ?>
                        </div>
                        <div class="form-group">
                            <label>Catégorie:</label><?php echo ' ' . $item['category']; ?>
                        </div>
                        <div class="form-group">
                            <label>Image:</label><?php echo ' ' . $item['image']; ?>
                        </div>
                    </form>
                    <br>
                    <div class="form-actions">
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                    
                </div>
                <div class="col-md-6 site">
                    <div class="img-thumbnail">
                        <img src="<?php echo ' ../images/' . $item['image'];?>" class="img-fluid" alt="...">
                        <div class="price"><?php echo number_format((float) $item['price'],2,'.','') . ' €'; ?></div>
                        <div class="caption">
                            <h4><?php echo $item['name']; ?></h4>
                            <p><?php echo $item['description']; ?></p>
                            <a href="#" class="btn btn-order" role="button"><span class="bi-cart-fill"></span> Echanger</a>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </body>

</html>