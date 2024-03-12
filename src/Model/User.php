<?php
namespace App\Model;

class User
{
    private ?int $id = null;

    private ?string $email = null;

    private ?string $password = null;

    private bool $state = false;

    public function __construct
    (
        ?int $id = null,
        string $email = null,
        ?string $password = null,
        bool $state = false
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->state = $state;
    }


    public function findOneById(int $id): false|User{
        $pdo = new \PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';port=' . $_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        $stmt = $pdo->prepare('SELECT * from user where id = :id');
        $stmt->bindParam(':id', $id,\PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result == false) {
            return false;
        }

        return new User(
            $result['id'],
            $result['email'],
            $result['password'],
        );
    }


    function findOneByEmail(string $email) : false|User {
        $pdo = new \PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';port=' . $_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            return false;
        }

        return new User(
            $result['id'],
            $result['email'],
            $result['password'],
        );
    }


    public function findAll(): array
    {
        $pdo = new \PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';port=' . $_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

        $statement = $pdo->prepare('SELECT * FROM user');
        $statement->execute();

        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $users = [];

        foreach ($results as $result) {
            $users[] = new User(
                $result['id'],
                $result['email'],
                $result['password'],
            );
        }

        return $users;
    }


    public function create(): User
    {
        $pdo = new \PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';port=' . $_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

        $stmt = $pdo->prepare("INSERT INTO user (email, password) VALUES (:email, :password)");

        $stmt->bindValue(':email', $this->getEmail());
        $stmt->bindValue(':password', $this->getPassword());

        $stmt->execute();

        $this->setId((int)$pdo->lastInsertId());

        return $this;
    }


    public function update(): User
    {
        $pdo = new \PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';port=' . $_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

        $stmt = $pdo->prepare("UPDATE user SET email = :email, password = :password WHERE email = :email");

        $stmt->bindValue(':email', $this->getEmail());
        $stmt->bindValue(':password', $this->getPassword());

        $stmt->execute();

        $this->connect();
        $this->setId($this->getIdByEmail($_SESSION['user']->getEmail()));

        return $this;
    }


    public function delete(int $id): string
    {
        $pdo = new \PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';port=' . $_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

        $stmt = $pdo->prepare("DELETE FROM user WHERE id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $result = $stmt->execute();

        if ($result === false) {
            return "Echec lors de la suppression de l'utilisateur";
        }else {
            return "L'utilisateur à bien été supprimé";
        }
    }


    public function getIdByEmail(string $email): int|bool
    {
        $pdo = new \PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';port=' . $_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

        $stmt = $pdo->prepare("SELECT id FROM user WHERE email = :email");
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result === false) {
            return false;
        } else {
            return $result['id'];
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getState(): bool
    {
        return $this->state;
    }

    public function setId(?int $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function setEmail(?string $email): User
    {
        $this->email = $email;
        return $this;
    }
    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function connect(): User
    {
        $this->state = true;
        return $this;
    }
    public function disconnect(): User
    {
        $this->state = false;
        return $this;
    }
}