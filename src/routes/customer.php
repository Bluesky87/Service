<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Kasperek
 */


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get All Customers
$app->add(new \Slim\Middleware\HttpBasicAuthentication(
    [
        "path" => "/api/customers",
        "secure" => false,
        "users" => [
            "admin" => "admin"
        ]
    ]
));


$app->get('/api/customers', function (Request $request, Response $response, $arguments) {
    $sql = "Select * from customers";

    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customers);
    } catch (PDOException $e) {
        echo '{"error": {"text": '. $e->getMessage().'}}';
    }
});


// Get single Customer

    $app->get('/api/customer/{id}', function (Request $request, Response $response) {
        $id = $request->getAttribute('id');

        $sql = "Select * from customers WHERE id = $id";

        try {
            $db = new db();
            $db = $db->connect();
            $stmt = $db->query($sql);
            $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo json_encode($customer);
        } catch (PDOException $e) {
            echo '{"error": {"text": '. $e->getMessage().'}}';
        }
    });

// add single Customer

$app->post('/api/customer/add', function (Request $request, Response $response) {
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');


    $sql = "INSERT INTO customers (first_name, last_name, phone) VALUES
            (:first_name,:last_name,:phone)";

    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':phone', $phone);

        $stmt->execute();

        echo '{"notice": {"text": "Customer add"}';
    } catch (PDOException $e) {
        echo '{"error": {"text": '. $e->getMessage().'}}';
    }
});


// update single Customer

$app->post('/api/customer/update{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');


    $sql = "UPDATE customers SET 
            first_name = :first_name,
            last_name = :last_name,
            phone = :phone WHERE id = $id";

    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':phone', $phone);

        $stmt->execute();

        echo '{"notice": {"text": "Customer updated"}';
    } catch (PDOException $e) {
        echo '{"error": {"text": '. $e->getMessage().'}}';
    }
});


// delete single Customer

$app->delete('/api/customer/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM customers WHERE id = $id";

    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;

        echo '{"notice": {"text": "Customer deleted"}';
    } catch (PDOException $e) {
        echo '{"error": {"text": '. $e->getMessage().'}}';
    }
});
