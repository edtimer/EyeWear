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

// Get
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

// Post user
$app->post('/user', function (Request $req, Response $res, array $args) {
    $request = (array) $req->getParsedBody();
    $name = $request['name'];
    $email = $request["email"];
    $pass = $request["pass"];
    $avatar = $request['avatar'];
    $createdAt = date("Y-m-d H:i:s");

    try {
        $sql = 'INSERT INTO users(name, email, pass, avatar, createdAt, isAdmin) VALUES (:name, :email, :pass, :avatar, :createdAt, 0)';

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

//Post sunglass
$app->post('/sunglass', function (Request $req, Response $res, array $args) {
    $request = (array) $req->getParsedBody();
    $name = $request['name'];
    $brand = $request["brand"];
    $description = $request["description"];
    $rates = $request['rates'];
    $price = $request['price'];
    $img = $request['img'];

    try {
        $sql = 'INSERT INTO sunglasses(name, brand, description, rates, price, img) VALUES (:name, :brand, :description, :rates, :price, :img)';

        $db = new db();
        $con = $db->connect();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':brand', $brand);
        $stmt->bindValue(':description', $description);
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
//post order done
$app->post('/order', function (Request $req, Response $res, array $args) {
    $request = (array) $req->getParsedBody();
    $userId = $request['userId'];
    $sunglassId = $request["sunId"];
    $quan = $request["quan"];
    $totalPrice = $quan * $request['price'];
    $address = $request['address'];
    $notes = $request['notes'];
    $status = 'new';

    try {
        $sql = 'INSERT INTO orders(userId, sunglassId, quan, totalPrice, address, notes, status) VALUES (:userId, :sunglassId, :quan, :totalPrice, :address, :notes, :status)';

        $db = new db();
        $con = $db->connect();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':sunglassId', $sunglassId);
        $stmt->bindValue(':quan', $quan);
        $stmt->bindValue(':totalPrice', $totalPrice);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':notes', $notes);
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
//delete order
$app->delete('/order/{id}', function (Request $req, Response $res, array $args) {
    $id = $args['id'];
    $sql = 'delete from orders where id = "' . $id . '"';
    $results = false;

    try {
        $db = new db();
        $con = $db->connect();

        $stmt = $con->prepare($sql);
        if ($stmt->execute()) {
            $count = $stmt->rowCount();
            $results = array(
                "status" => "Order deleted successfully",
                "rowcount" => $count
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
//delete Sunglass
$app->delete('/sunglass/{id}', function (Request $req, Response $res, array $args) {
    $id = $args['id'];
    $sql = 'delete from sunglasses where id = "' . $id . '"';
    $results = false;

    try {
        $db = new db();
        $con = $db->connect();

        $stmt = $con->prepare($sql);
        if ($stmt->execute()) {
            $count = $stmt->rowCount();
            $results = array(
                "status" => "Sunglass deleted successfully",
                "rowcount" => $count
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


//put order - Update
$app->put('/order/{id}', function (Request $req, Response $res, array $args) {
    $id = $args['id'];

    try {
        $request =
            (array) $req->getParsedBody();
        $quan = $request["quan"];
        $totalPrice = $quan * $request['price'];
        $address = $request['address'];
        $notes = $request['notes'];


        $sql = 'UPDATE orders SET quan=:quan,totalPrice=:totalPrice,address=:address, notes=:notes WHERE id = "' . $id . '"';

        $db = new db();
        $con = $db->connect();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':quan', $quan);
        $stmt->bindValue(':totalPrice', $totalPrice);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':notes', $notes);

        $result = $stmt->execute();
        $count = $stmt->rowCount();

        $db = null;

        $result = array(
            "status" => "Order updated successfully",
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

//put sunglass - Update
$app->put('/sunglass/{id}', function (Request $req, Response $res, array $args) {
    $id = $args['id'];

    try {
        $request =
            (array) $req->getParsedBody();
        $id = $request["id"];
        $name = $request["name"];
        $brand = $request['brand'];
        $description = $request['description'];
        $rates = $request["rates"];
        $price = $request['price'];
        $img = $request["img"];


        $sql = 'UPDATE sunglasses SET id=:id,name=:name, brand=:brand,description=:description,rates=:rates,price=:price,img=:img WHERE id = "' . $id . '"';

        $db = new db();
        $con = $db->connect();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':brand', $brand);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':rates', $rates);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':img', $img);

        $result = $stmt->execute();
        $count = $stmt->rowCount();

        $db = null;

        $result = array(
            "status" => "Order updated successfully",
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
