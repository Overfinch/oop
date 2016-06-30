<?php



class Tree{

    private $db;
    public $data;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=ox2.ru-test-base', 'root', '');
        $this->db->query("SET NAMES utf8");
    }

    public function ShowTree($id)
    {

        $sql = "SELECT * FROM category WHERE parent_id=" . $id . "";
        $res = $this->db->query($sql);
        $this->data .= "<ul>";
        while ($result = $res->fetch(PDO::FETCH_ASSOC)) {
            $this->data .= "<li>";
            $this->data .= $result["name"];
            $this->data .= "</li>";
            $this->showTree($result["id"], $this->db);
        }
        $this->data .= "</ul>";

        return $this->data;
    }
}


$tree = new Tree();
echo $tree->ShowTree(0);
