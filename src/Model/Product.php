<?php
namespace App\Model;

class Product
{
    private ?int $id = null;

    private ?string $name = null;

    private ?string $description = null;

    private ?string $image = null;

    private ?int $id_user = null;

    public function __construct
    (
        ?int $id = null,
        string $name = null,
        ?string $description = null,
        ?string $image = null,
        ?int $id_user = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->id_user = $id_user;
    }


    public function findOneById(int $id): false|Product{
        $pdo = new \PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';port=' . $_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        $stmt = $pdo->prepare('SELECT * from product where id = :id');
        $stmt->bindParam(':id', $id,\PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result == false) {
            return false;
        }

        return new Product(
            $result['id'],
            $result['name'],
            $result['description'],
            $result['image'],
            $result['id_user'],
        );
    }


    public function findAll(): array
    {
        $pdo = new \PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';port=' . $_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

        $statement = $pdo->prepare('SELECT * FROM product');
        $statement->execute();

        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $products = [];

        foreach ($results as $result) {
            $imageUrl = file_get_contents($result['image']);
            $result['image'] = $imageUrl;
            
            $products[] = new Product(
                $result['id'],
                $result['name'],
                $result['description'],
                $result['image'],
                $result['id_user'],
            );
        }

        return $products;
    }


    public function add(): Product
    {
        $pdo = new \PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';port=' . $_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

        $stmt = $pdo->prepare("INSERT INTO product (name, description, image, id_user) VALUES (:name, :description, :image, :id_user)");

        $stmt->bindValue(':name', $this->getName());
        $stmt->bindValue(':description', $this->getDescription());
        $stmt->bindValue(':image', $this->getImage());
        $stmt->bindValue(':id_user', 6 );

        $stmt->execute();

        $this->setId((int)$pdo->lastInsertId());

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setId(?int $id): Product
    {
        $this->id = $id;
        return $this;
    }

    public function setName(?string $name): Product
    {
        $this->name = $name;
        return $this;
    }
    public function setDescription(?string $description): Product
    {
        $this->description = $description;
        return $this;
    }

    public function setImage(?string $image): Product
    {
        $this->image = $image;
        return $this;
    }

    public function setIdUser(?int $id_user): Product
    {
        $this->id_user = $id_user;
        return $this;
    }

}