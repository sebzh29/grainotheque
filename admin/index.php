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
            <h1><strong>Liste des items   </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Actions</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require 'database.php';
                        $db = Database::connect();

                        $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category
                        FROM items LEFT JOIN categories ON items.category = categories.id
                        ORDER BY items.id DESC');
                        while($item = $statement->fetch())
                        {
                            echo '<tr>';
                                echo '<td>' . $item['name'] . '</td>';
                                echo '<td>' . $item['description'] . '</td>';
                                echo '<td>' . number_format((float) $item['price'],2,'.','') . '</td>';
                                echo '<td>' . $item['category'] . '</td>';
                               
                                echo '<td width=300>';
                                echo '<a class="btn btn-default" href="view.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                                echo ' ';                            
                                echo '<a class="btn btn-primary" href="update.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                                echo ' ';                    
                                echo '<a class="btn btn-danger" href="delete.php?id=' . $item['id'] . '"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                                echo '</td>';
                            echo '</tr>';
                        }

                        Database::disconnect();
                    ?>
                    
                </tbody>
            </table>
        </div>

    </div>
    </body>

</html>