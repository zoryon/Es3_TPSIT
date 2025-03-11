<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController
{
  
  public function index(Request $request, Response $response, $args) {
    $mysqli_connection = new MySQLi("my_mariadb", "root", "ciccio", "scuola");
    $result = $mysqli_connection->query("SELECT * FROM alunni");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function view(Request $request, Response $response, $args) {
    $mysqli_connection = new MySQLi("my_mariadb", "root", "ciccio", "scuola");
    $result = $mysqli_connection->query("SELECT * FROM alunni WHERE alunni.id =" . $args["id"]);
    $result = $result->fetch_assoc();

    $response->getBody()->write(json_encode($result));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function create(Request $request, Response $response, $args) {
    $data = $request->getParsedBody();

    $id = $data["id"];
    $nome = $data["nome"];
    $cognome = $data["cognome"];

    $mysqli_connection = new MySQLi("my_mariadb", "root", "ciccio", "scuola");
    $mysqli_connection->query("INSERT INTO alunni(id, nome, cognome) VALUES(" . $id . ", '" .$nome . "', '" . $cognome . "')");

    $response->getBody()->write(json_encode("success"));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function update(Request $request, Response $response, $args) {
    $data = $request->getParsedBody();

    $id = $data["id"];
    $nome = $data["nome"];
    $cognome = $data["cognome"];

    $mysqli_connection = new MySQLi("my_mariadb", "root", "ciccio", "scuola");
    $mysqli_connection->query("UPDATE alunni SET nome = '" . $nome . "', cognome = '" . $cognome . "' WHERE id = " . $id);

    $response->getBody()->write(json_encode("success"));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function destroy(Request $request, Response $response, $args) {
    $mysqli_connection = new MySQLi("my_mariadb", "root", "ciccio", "scuola");
    $mysqli_connection->query("DELETE FROM alunni WHERE id = " . $args["id"]);

    $response->getBody()->write(json_encode("success"));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
}
