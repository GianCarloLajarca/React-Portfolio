<?php

Class Education {
    public $education_aid;
    public $education_title;
    public $education_photo;
    public $education_is_active;
    public $education_publish_date;
    public $education_description;
    public $education_school;
    public $education_date;
    public $education_created;
    public $education_search;
    public $education_datetime;

    public $connection;
    public $lastInsertedId;
    public $tblEducation;

    public function __construct($db) {
        $this->connection = $db;
        $this->tblEducation = "education";
    }

    public function create() {
        try {
             $sql = "insert into {$this->tblEducation} ";
             $sql .= "( education_title, ";
             $sql .= "education_photo, ";
             $sql .= "education_is_active, ";
             $sql .= "education_publish_date, ";
             $sql .= "education_description, ";
             $sql .= "education_school, ";
             $sql .= "education_date, ";
             $sql .= "education_created, ";
             $sql .= "education_datetime ) values ( ";
             $sql .= ":education_title, ";
             $sql .= ":education_photo, ";
             $sql .= ":education_is_active, ";
             $sql .= ":education_publish_date, ";
             $sql .= ":education_description, ";
             $sql .= ":education_school, ";
             $sql .= ":education_date, ";
             $sql .= ":education_created, ";
             $sql .= ":education_datetime ) ";
             $query = $this->connection->prepare($sql);
             $query->execute([
                "education_title" => $this->education_title,
                "education_photo" => $this->education_photo,
                "education_is_active" => $this->education_is_active,
                "education_publish_date" => $this->education_publish_date,
                "education_description" => $this->education_description,
                "education_school" => $this->education_school,
                "education_date" => $this->education_date,
                "education_created" => $this->education_created,
                "education_datetime" => $this->education_datetime,
             ]);
             $this->lastInsertedId = $this->connection->lastInsertId();
        } catch (PDOException $ex) {
            $query = false;
        }

        return $query;
    }

    public function readAll()
    {
        try {
            $sql = "select * ";
            $sql .= "from {$this->tblEducation} ";
            $sql .= "order by education_is_active desc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblEducation} ";
            $sql .= "where education_aid = :education_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "education_aid" => $this->education_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblEducation} set ";
            $sql .= "education_title = :education_title, ";
            $sql .= "education_photo = :education_photo, ";
            $sql .= "education_publish_date = :education_publish_date, ";
            $sql .= "education_description = :education_description, ";
            $sql .= "education_school = :education_school, ";
            $sql .= "education_date = :education_date, ";
            $sql .= "education_datetime = :education_datetime ";
            $sql .= "where education_aid  = :education_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "education_title" => $this->education_title,
                "education_photo" => $this->education_photo,
                "education_publish_date" => $this->education_publish_date,
                "education_description" => $this->education_description,
                "education_school" => $this->education_school,
                "education_date" => $this->education_date,
                "education_datetime" => $this->education_datetime,
                "education_aid" => $this->education_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblEducation} set ";
            $sql .= "education_is_active = :education_is_active, ";
            $sql .= "education_datetime = :education_datetime ";
            $sql .= "where education_aid  = :education_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "education_is_active" => $this->education_is_active,
                "education_datetime" => $this->education_datetime,
                "education_aid" => $this->education_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function search()
    {
        try {
            $sql = "select ";
            $sql .= "* ";
            $sql .= "from {$this->tblEducation} ";
            $sql .= "where education_title like :education_title ";
            $sql .= "order by education_is_active desc, ";
            $sql .= "education_title asc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "education_title" => "%{$this->education_search}%",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }
}