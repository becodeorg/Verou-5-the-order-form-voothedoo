<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_POST</h2>';
    echo '<pre>';
    print_r($_POST); 
    echo '</pre>';
    echo '<br>';
    echo '<br>';
    echo '<pre>';
    print_r($_POST['products']);
    echo '</pre>';
    echo '<br>';
    echo '<br>';
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

function checkEmailCookie($blabla) {
    if (!empty($blabla)) {
        echo $_COOKIE['e-mail'];
    };
}

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'Laptop Shaped Punching Bag Stress Reliever (for those learning PHP)', 'price' => 19.99],
    ['name' => 'Coffee Mug: \'I Speak Fluent PHP and Sarcasm\'', 'price' => 8.49],
    ['name' => 'Hot Sauce (PHP Spicy Syntax)', 'price' => 11.99],
    ['name' => 'PHP Coding Gloves (Don\'t get dirty)', 'price' => 9.99],
    ['name' => 'Error Message Translator Poster', 'price' => 7.49],
];

$totalValue = 0;

function validate()
{
    $invalidFields = [];

    $email = htmlspecialchars($_POST['email']);
    if (empty($email)) {
        $invalidFields[] = 'E-mail';
    }

    $street = htmlspecialchars($_POST['street']);
    if (empty($street)) {
        $invalidFields[] = 'Street name';
    }

    $streetNumber = htmlspecialchars($_POST['streetnumber']);
    if (empty($streetNumber)) {
        $invalidFields[] = 'Street number';
    }

    $city = htmlspecialchars($_POST['city']);
    if (empty($city)) {
        $invalidFields[] = 'City name';
    }

    $zipCode = htmlspecialchars($_POST['zipcode']);
    if (empty($zipCode)) {
        $invalidFields[] = 'Zip Code';
    }
    
    return $invalidFields;
}

function handleForm()
{
    global $products;
    $totalPrice = 0;

    $invalidFields = validate();
    $streetName = ucfirst(htmlspecialchars($_POST['street']));
    $streetNo = htmlspecialchars($_POST['streetnumber']);
    $cityName = ucfirst(htmlspecialchars($_POST['city']));
    $zipCodeNo = htmlspecialchars($_POST['zipcode']);
    if (!empty($invalidFields)) {
        $errors = array(); 
        foreach ($invalidFields as $field) {
            $errors[] = "<p class='alert alert-danger'>" . "Please write your " . $field . "</p>";
        }
        echo implode('<br>', $errors);
    } else { ?>
        <h2 class="alert alert-success"> <?= "Order sent succesfully!" ?> </h2>
        <p class="alert alert-info"> <?= "Delivery adress:" . " " . $streetName . " " . $streetNo . ", " . $cityName . ", " . $zipCodeNo ?> </p>
        <?php 
            $postProducts = $_POST["products"];
            if (is_array($postProducts)) {
            foreach ($postProducts as $i => $postProduct) { 
                echo "<p class='alert alert-light'>". "&euro; " . $products[$i]['price']." " .'<strong>'. htmlspecialchars($products[$i]['name']) . '</strong>'."</p>" ;
                $totalPrice += $products[$i]['price'];
            }
            } else {
                echo "No products selected";
            }
        echo '<p class="alert alert-warning">' . 'Order Total: ' . '<strong>' . '&euro; '  .$totalPrice .'</strong>'. '</p>' ; 
        ?>
    <?php }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    handleForm();
}


require 'form-view.php';

