<?php

Class Project {
    public $project_aid;
    public $project_title;
    public $project_category;
    public $project_thumbnail;
    public $project_is_active;
    public $project_publish_date;
    public $project_description;
    public $project_button;
    public $project_image_1;
    public $project_image_2;
    public $project_image_3;
    public $project_image_4;
    public $project_image_5;
    public $project_image_6;
    public $project_created;
    public $project_search;
    public $project_datetime;

    public $connection;
    public $lastInsertedId;
    public $tblProject;

    public function __construct($db) {
        $this->connection = $db;
        $this->tblProject = "project";
    }

    public function create() {
        try {
             $sql = "insert into {$this->tblProject} ";
             $sql .= "( project_title, ";
             $sql .= "project_category, ";
             $sql .= "project_thumbnail, ";
             $sql .= "project_is_active, ";
             $sql .= "project_publish_date, ";
             $sql .= "project_description, ";
             $sql .= "project_button, ";
             $sql .= "project_image_1, ";
             $sql .= "project_image_2, ";
             $sql .= "project_image_3, ";
             $sql .= "project_image_4, ";
             $sql .= "project_image_5, ";
             $sql .= "project_image_6, ";
             $sql .= "project_created, ";
             $sql .= "project_datetime ) values ( ";
             $sql .= ":project_title, ";
             $sql .= ":project_category, ";
             $sql .= ":project_thumbnail, ";
             $sql .= ":project_is_active, ";
             $sql .= ":project_publish_date, ";
             $sql .= ":project_description, ";
             $sql .= ":project_button, ";
             $sql .= ":project_image_1, ";
             $sql .= ":project_image_2, ";
             $sql .= ":project_image_3, ";
             $sql .= ":project_image_4, ";
             $sql .= ":project_image_5, ";
             $sql .= ":project_image_6, ";
             $sql .= ":project_created, ";
             $sql .= ":project_datetime ) ";
             $query = $this->connection->prepare($sql);
             $query->execute([
                "project_title" => $this->project_title,
                "project_category" => $this->project_category,
                "project_thumbnail" => $this->project_thumbnail,
                "project_is_active" => $this->project_is_active,
                "project_publish_date" => $this->project_publish_date,
                "project_description" => $this->project_description,
                "project_button" => $this->project_button,
                "project_image_1" => $this->project_image_1,
                "project_image_2" => $this->project_image_2,
                "project_image_3" => $this->project_image_3,
                "project_image_4" => $this->project_image_4,
                "project_image_5" => $this->project_image_5,
                "project_image_6" => $this->project_image_6,
                "project_created" => $this->project_created,
                "project_datetime" => $this->project_datetime,
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
            $sql .= "from {$this->tblProject} ";
            $sql .= "order by project_is_active desc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function delete()
    {
        try {
            $sql = "delete from {$this->tblProject} ";
            $sql .= "where project_aid = :project_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "project_aid" => $this->project_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function update()
    {
        try {
            $sql = "update {$this->tblProject} set ";
            $sql .= "project_title = :project_title, ";
            $sql .= "project_thumbnail = :project_thumbnail, ";
            $sql .= "project_category = :project_category, ";
            $sql .= "project_publish_date = :project_publish_date, ";
            $sql .= "project_description = :project_description, ";
            $sql .= "project_button = :project_button, ";
            $sql .= "project_image_1 = :project_image_1, ";
            $sql .= "project_image_2 = :project_image_2, ";
            $sql .= "project_image_3 = :project_image_3, ";
            $sql .= "project_image_4 = :project_image_4, ";
            $sql .= "project_image_5 = :project_image_5, ";
            $sql .= "project_image_6 = :project_image_6, ";
            $sql .= "project_datetime = :project_datetime ";
            $sql .= "where project_aid  = :project_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "project_title" => $this->project_title,
                "project_thumbnail" => $this->project_thumbnail,
                "project_category" => $this->project_category,
                "project_publish_date" => $this->project_publish_date,
                "project_description" => $this->project_description,
                "project_button" => $this->project_button,
                "project_image_1" => $this->project_image_1,
                "project_image_2" => $this->project_image_2,
                "project_image_3" => $this->project_image_3,
                "project_image_4" => $this->project_image_4,
                "project_image_5" => $this->project_image_5,
                "project_image_6" => $this->project_image_6,
                "project_datetime" => $this->project_datetime,
                "project_aid" => $this->project_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function active()
    {
        try {
            $sql = "update {$this->tblProject} set ";
            $sql .= "project_is_active = :project_is_active, ";
            $sql .= "project_datetime = :project_datetime ";
            $sql .= "where project_aid  = :project_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "project_is_active" => $this->project_is_active,
                "project_datetime" => $this->project_datetime,
                "project_aid" => $this->project_aid,
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
            $sql .= "from {$this->tblProject} ";
            $sql .= "where project_title like :project_title ";
            $sql .= "order by project_is_active desc, ";
            $sql .= "project_title asc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "project_title" => "%{$this->project_search}%",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }
}