<?php

namespace Christiancannata\PhpApi\Models;

use Christiancannata\PhpApi\System\DatabaseConnector;

class UserModel
{

    private $db;

    public function __construct()
    {
        $this->db = new DatabaseConnector();
    }


    public function findAll()
    {

        $statement = "
            SELECT 
                id, name, email
            FROM
                users;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

    }

    public function findById($id)
    {

        $statement = "
            SELECT 
                id, name, email
            FROM
                users
            WHERE id = :id ;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute([
                'id' => $id
            ]);
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

    }

    public function insert(array $params)
    {

        $statement = "
            INSERT INTO users 
                (name, email, password,last_name)
            VALUES
                (:name, :email, :password, :last_name);
        ";

        try {
            $statement = $this->db->prepare($statement);
            $response = $statement->execute($params);
            return $response;
        } catch (\PDOException $e) {
            return false;
        }

    }


    public function update(int $id, array $params)
    {


        $updateQuery = [];

        foreach ($params as $field => $value) {
            $updateQuery[] = $field . ' = :' . $field;
        }

        $updateQuery = implode(", ", $updateQuery);

        $statement = "
            UPDATE users
            SET 
                {$updateQuery}
            WHERE id = :id
        ";


        $statement = $this->db->prepare($statement);

        $params['id'] = $id;

        $statement->execute($params);
        return $statement->rowCount();

    }


    public function delete(int $id)
    {
        $statement = "
            DELETE FROM
                users
            WHERE id = :id ;
        ";

        $statement = $this->db->prepare($statement);
        $statement->execute([
            'id' => $id
        ]);
        return true;

    }
}