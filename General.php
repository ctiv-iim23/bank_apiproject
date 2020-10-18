<?php

require "Database.php";

class General {

    public $db;
    protected $table;

    public function __construct()
    {
        $this->db = new Database();
        $this->app = new App();
        // $this->table = strtolower($this->table);
    }
    /**
     * Get all informations
     *
     */
    public function getAll()
    {
        $this->db->query("SELECT * FROM $this->table");
    }

    /**
     * Get one line of information
     *
     * @param int $id
     */
    public function getOne($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id=$id", true);
    }

    /**
     * Save informations in Db
     *
     * @param array $param
     */
    public function save($param)
    {
        $statement = "INSERT INTO $this->table (";
        $values = " VALUES (";
        foreach ($param as $key => $value) {
            $statement .= $key. ", ";
            $values .= ":".$key. ", ";
        }
        $statement = substr($statement, 0, -2) . ") ";
        $values = substr($values, 0, -2) . ")";

        $statement .= $values;

        $data = array();
        foreach ($param as $key => $value) {
            $data[$key] = htmlspecialchars($value);
        }

        $this->db->prepare($statement, "save", $data);
    }
}