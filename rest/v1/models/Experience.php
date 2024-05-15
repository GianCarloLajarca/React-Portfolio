<?php

Class Experience {
    public $experience_aid;
    public $experience_title;
    public $experience_photo;
    public $experience_is_active;
    public $experience_publish_date;
    public $experience_description;
    public $experience_date;
    public $experience_job;
    public $experience_created;
    public $experience_search;
    public $experience_datetime;

    public $connection;
    public $lastInsertedId;
    public $tblExperience;

    public function __construct($db) {
        $this->connection = $db;
        $this->tblExperience = "experience";
    }

    public function create() {
        try {
             $sql = "insert into {$this->tblExperience} ";
             $sql .= "( experience_title, ";
             $sql .= "experience_photo, ";
             $sql .= "experience_is_active, ";
             $sql .= "experience_publish_date, ";
             $sql .= "experience_description, ";
             $sql .= "experience_date, ";
             $sql .= "experience_job, ";
             $sql .= "experience_created, ";
             $sql .= "experience_datetime ) values ( ";
             $sql .= ":experience_title, ";
             $sql .= ":experience_photo, ";
             $sql .= ":experience_is_active, ";
             $sql .= ":experience_publish_date, ";
             $sql .= ":experience_description, ";
             $sql .= ":experience_date, ";
             $sql .= ":experience_job, ";
             $sql .= ":experience_created, ";
             $sql .= ":experience_datetime ) ";
             $query = $this->connection->prepare($sql);
             $query->execute([
                "experience_title" => $this->experience_title,
                "experience_photo" => $this->experience_photo,
                "experience_is_active" => $this->experience_is_active,
                "experience_publish_date" => $this->experience_publish_date,
                "experience_description" => $this->experience_description,
                "experience_date" => $this->experience_date,
                "experience_job" => $this->experience_job,
                "experience_created" => $this->experience_created,
                "experience_datetime" => $this->experience_datetime,
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
            $sql .= "from {$this->tblExperience} ";
            $sql .= "order by experience_is_active desc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblExperience} ";
            $sql .= "where experience_aid = :experience_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "experience_aid" => $this->experience_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblExperience} set ";
            $sql .= "experience_title = :experience_title, ";
            $sql .= "experience_photo = :experience_photo, ";
            $sql .= "experience_publish_date = :experience_publish_date, ";
            $sql .= "experience_description = :experience_description, ";
            $sql .= "experience_date = :experience_date, ";
            $sql .= "experience_job = :experience_job, ";
            $sql .= "experience_datetime = :experience_datetime ";
            $sql .= "where experience_aid  = :experience_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "experience_title" => $this->experience_title,
                "experience_photo" => $this->experience_photo,
                "experience_publish_date" => $this->experience_publish_date,
                "experience_description" => $this->experience_description,
                "experience_date" => $this->experience_date,
                "experience_job" => $this->experience_job,
                "experience_datetime" => $this->experience_datetime,
                "experience_aid" => $this->experience_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblExperience} set ";
            $sql .= "experience_is_active = :experience_is_active, ";
            $sql .= "experience_datetime = :experience_datetime ";
            $sql .= "where experience_aid  = :experience_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "experience_is_active" => $this->experience_is_active,
                "experience_datetime" => $this->experience_datetime,
                "experience_aid" => $this->experience_aid,
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
            $sql .= "from {$this->tblExperience} ";
            $sql .= "where experience_title like :experience_title ";
            $sql .= "order by experience_is_active desc, ";
            $sql .= "experience_title asc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "experience_title" => "%{$this->experience_search}%",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }
}