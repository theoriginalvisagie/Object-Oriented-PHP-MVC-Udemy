<?php
    class Post{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function getPosts(){
            $sql = "SELECT *, p.id as postID, u.id as userID, p.created_at as postCreated, u.created_at as userCreated FROM posts p
                    LEFT JOIN users u ON u.id=p.userID
                    ORDER BY p.created_at DESC";
            $this->db->query($sql);

            $results = $this->db->resultSet();

            return $results;
        }

        public function addPost($data){
            $this->db->query("INSERT INTO posts (title, userID, body) VALUES(:title, :userID, :body)");
            // Bind values
            $this->db->bind(":title", $data["title"]);
            $this->db->bind(":userID", $data["userID"]);
            $this->db->bind(":body", $data["body"]);
      
            // Execute
            if($this->db->execute()){
              return true;
            } else {
              return false;
            }
        }

        public function updatePost($data){
            $this->db->query("UPDATE posts SET title=:title, body=:body WHERE id=:id");
            // Bind values
            // echo "POST<pre>".print_r($data,true)."</pre>";
            $this->db->bind(":id", $data["id"]);
            $this->db->bind(":title", $data["title"]);
            $this->db->bind(":body", $data["body"]);
      
            // Execute
            if($this->db->execute()){
              return true;
            } else {
              return false;
            }
        }

        public function deletePost($id){
            $this->db->query("DELETE FROM posts WHERE id = :id");
            // Bind values
            // echo "POST<pre>".print_r($data,true)."</pre>";
            $this->db->bind(":id", $id);
      
            // Execute
            if($this->db->execute()){
              return true;
            } else {
              return false;
            }
        }

        public function getPostById($id){
            $this->db->query("SELECT * FROM posts WHERE id = :id");

            $this->db->bind(":id", $id);

            $row = $this->db->single();

            return $row;
        }
    }
?>