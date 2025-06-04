<?php
class plantilla{

    public static $intacioa = null;
    public static function aplicar(){

       if(self::$intacioa == null){
        self::$intacioa = new plantilla();
       } else {
       return self::$intacioa;
       }
    }
    public function __construct()
    {
        ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lo que he visto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <h1 class="mb-3">Lo que he visto</h1>
        <p>Listado de películas y series en la que he invertido mi tiempo ⌚</p>
        
        <?php
    }

    public function __destruct()
    {
        
    }
}
?>