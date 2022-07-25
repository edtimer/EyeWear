<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// use Selective\BasePath\BasePathMiddleware;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/db.php';

$app = new \Slim\App;

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello, Softtech Geeks!");
    return $response;
});

// friend routes
$app->get('/records', function (Request $req, Response $res) {
    $table = $_GET['table'];
    $where = $_GET["where"];
    $sql = "SELECT * FROM $table $where";

    try {
        $db = new db();
        $con = $db->connect();

        $stmt = $con->query($sql);
        $friends = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;
        $res->getBody()->write(json_encode($friends));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
            "message" => $e->getMessage()
        );
        $res->getBody()->write(json_encode($error));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

$app->post('/user', function (Request $req, Response $res, array $args) {
    $request = (array) $req->getParsedBody();
    $name = $request['name'];
    $email = $request["email"];
    $pass = $request["pass"];
    $avatar = $request['avatar'];
    $createdAt = $request['createdAt'];

    try {
        $sql = 'INSERT INTO users(name, email, pass, avatar, createdAt) VALUES (:name, :email, :pass, :avatar, :createdAt)';

        $db = new db();
        $con = $db->connect();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':pass', $pass);
        $stmt->bindValue(':avatar', $avatar);
        $stmt->bindValue(':createdAt', $createdAt);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;

        $result = array(
            "status" => "New user inserted successfully",
            "rowcount" => $count
        );
        $res->getBody()->write(json_encode($result));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
            "message" => $e->getMessage()
        );
        $res->getBody()->write(json_encode($error));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

$app->post('/sunglass', function (Request $req, Response $res, array $args) {
    $request = (array) $req->getParsedBody();
    $name = $request['name'];
    $brand = $request["brand"];
    $desc = $request["desc"];
    $rates = $request['rates'];
    $price = $request['price'];
    $img = $request['img'];

    try {
        $sql = 'INSERT INTO sunglasses(name, brand, description, rates, price, img) VALUES (:name, :brand, :desc, :rates, :price, :img)';

        $db = new db();
        $con = $db->connect();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':brand', $brand);
        $stmt->bindValue(':desc', $desc);
        $stmt->bindValue(':rates', $rates);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':img', $img);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;

        $result = array(
            "status" => "New sunglass inserted successfully",
            "rowcount" => $count
        );
        $res->getBody()->write(json_encode($result));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
            "message" => $e->getMessage()
        );
        $res->getBody()->write(json_encode($error));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

$app->post('/order', function (Request $req, Response $res, array $args) {
    $request = (array) $req->getParsedBody();
    $userId = $request['userId'];
    $sunglassId = $request["sunglassId"];
    $quan = $request["quan"];
    $totalPrice = $request['totalPrice'];
    $status = $request['status'];

    try {
        $sql = 'INSERT INTO orders(userId, sunglassId, quan, totalPrice, status) VALUES (:userId, :sunglassId, :quan, :totalPrice, :status)';

        $db = new db();
        $con = $db->connect();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':sunglassId', $sunglassId);
        $stmt->bindValue(':quan', $quan);
        $stmt->bindValue(':totalPrice', $totalPrice);
        $stmt->bindValue(':status', $status);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;

        $result = array(
            "status" => "New order inserted successfully",
            "rowcount" => $count
        );
        $res->getBody()->write(json_encode($result));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
            "message" => $e->getMessage()
        );
        $res->getBody()->write(json_encode($error));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

$app->delete('/bid/{bider_id}', function (Request $req, Response $res, array $args) {
    $id = $args['bider_id'];
    $sql = 'delete from bids where bidderid = "' . $id . '"';
    $results = false;

    try {
        $db = new db();
        $con = $db->connect();

        $stmt = $con->prepare($sql);
        if ($stmt->execute()) {
            $results = array(
                "status" => "a bid deleted successfully",
            );
        }

        $db = null;
        $res->getBody()->write(json_encode($results));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
            "message" => $e->getMessage()
        );
        $res->getBody()->write(json_encode($error));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

$app->post('/bid', function (Request $req, Response $res, array $args) {
    $request = (array) $req->getParsedBody();
    $bidderid = $request['bidderid'];
    $biddername = $request["biddername"];
    $contactnum = $request["contactnum"];
    $mybidprice = $request['mybidprice'];
    $itemid = $request['itemid'];
    $descrip = $request["descrip"];
    $category = $request["category"];
    $startprice = $request['startprice'];

    try {
        $sql = 'INSERT INTO bids(bidderid, biddername, contactnum, mybidprice, itemid, descrip, category, startprice) VALUES (:bidderid, :biddername, :contactnum, :mybidprice,:itemid, :descrip, :category, :startPrice)';

        $db = new db();
        $con = $db->connect();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':bidderid', $bidderid);
        $stmt->bindValue(':biddername', $biddername);
        $stmt->bindValue(':contactnum', $contactnum);
        $stmt->bindValue(':mybidprice', $mybidprice);
        $stmt->bindValue(':itemid', $itemid);
        $stmt->bindValue(':descrip', $descrip);
        $stmt->bindValue(':category', $category);
        $stmt->bindValue(':startPrice', $startprice);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;

        $result = array(
            "status" => "new bid inserted successfully",
            "rowcount" => $count
        );
        $res->getBody()->write(json_encode($result));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
            "message" => $e->getMessage()
        );
        $res->getBody()->write(json_encode($error));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

$app->put('/bid/{bider_id}', function (Request $req, Response $res, array $args) {
    $id = $args['bider_id'];

    try {
        $request =
            (array) $req->getParsedBody();
        $biddername = $request["biddername"];
        $contactnum = $request["contactnum"];
        $mybidprice = $request['mybidprice'];
        $itemid = $request['itemid'];
        $descrip = $request["descrip"];
        $category = $request["category"];
        $startprice = $request['startprice'];

        $sql = 'UPDATE bids SET biddername=:biddername,contactnum=:contactnum, mybidprice=:mybidprice,itemid=:itemid,descrip=:descrip,category=:category, startprice=:startprice WHERE bidderid = "' . $id . '"';

        $db = new db();
        $con = $db->connect();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':biddername', $biddername);
        $stmt->bindValue(':contactnum', $contactnum);
        $stmt->bindValue(':mybidprice', $mybidprice);
        $stmt->bindValue(':itemid', $itemid);
        $stmt->bindValue(':descrip', $descrip);
        $stmt->bindValue(':category', $category);
        $stmt->bindValue(':startprice', $startprice);
        $result = $stmt->execute();
        $count = $stmt->rowCount();

        $db = null;

        $result = array(
            "status" => "a bid updated successfully",
            "rowcount" => $count
        );
        $res->getBody()->write(json_encode($result));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
            "message" => $e->getMessage()
        );
        $res->getBody()->write(json_encode($error));

        return $res->withHeader('Content-Type', 'application/json')->withStatus(500);
    }
});

$app->run();
