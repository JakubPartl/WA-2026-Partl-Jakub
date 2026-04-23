<?php
$name = "";
$message = "";
$age = 0;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["my_name"];
    if($name == "Jake") {
        $message = "Nazdar Jakube";
        $age = $_POST["my_age"];
    } else {    
        $message = "Neznám tě";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test PHP</title>
</head>
<body>
    <h1>Test formuláře</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet eaque similique, reiciendis, nesciunt quo reprehenderit fuga quos voluptates enim, explicabo doloremque praesentium. Qui recusandae hic totam velit unde est soluta.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto debitis, dicta accusantium facilis accusamus quisquam quod nostrum, quidem non a fuga laudantium. Et doloribus veniam ducimus neque, laudantium ea eveniet!</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, iure est odit impedit optio magnam, minima voluptatem dicta debitis illo molestias tempora exercitationem aliquam quasi, incidunt recusandae? Dignissimos, qui dolore?</p>
    <p>Lorem ipsum dolor smrdí ti kokot consectetur adipisicing elit. Unde sapiente amet explicabo repudiandae quidem quae, recusandae veritatis reiciendis est ab cumque aperiam? Deleniti pariatur excepturi ex impedit id quibusdam ut.</p>
    <form method="post">
        <input type="text" name="my_name" placeholder="Zadejte jméno">
        <input type="number" name="my_age" placeholder="Zadejte věk">
        <button type="submit">Odeslat</button>
    </form>

    <p>
        <?php 
            echo "Výstup: "; 
            echo $message;
        ?>
              
    </p>

    <p>
        <?php 
            echo "  Tvůj věk: ";
            echo $age;
        ?>
              
    </p>



</body>
</html>
