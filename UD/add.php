<?php
    require_once '../config/connection.php';

    if(isset($_POST['add_category_form'])){ //category
        
        $filters = array(
            'name' => FILTER_SANITIZE_SPECIAL_CHARS
        );

        $insert = filter_input_array(INPUT_POST, $filters);

        $query = "insert into category (Name) values (?)";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$insert['name']]);
        header("Location:../dboard/category.php");
    
    }else if(isset($_POST['add_author_form'])){ //category
        
        $filters = array(
            'name' => FILTER_SANITIZE_SPECIAL_CHARS
        );

        $insert = filter_input_array(INPUT_POST, $filters);

        $query = "insert into author (Name) values (?)";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$insert['name']]);
        header("Location:../dboard/author.php");
    
    }else if(isset($_POST['add_rack_form'])){ //category
        
        $filters = array(
            'name' => FILTER_SANITIZE_SPECIAL_CHARS
        );

        $insert = filter_input_array(INPUT_POST, $filters);

        $query = "insert into rack (Name) values (?)";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$insert['name']]);
        header("Location:../dboard/rack.php");

    }else if(isset($_POST['add_book_form'])){ // add book

        // echo "hello";

        class image{
            public $target_dir;
            public $target_file;
            public $img_name;
            public $ext;
            // public $ok;
            public $error;
            public $conn;
            public $insert_id;
    
            public function __construct($db){
                $this -> target_dir = '../images/books/';
                $this -> conn = $db;
                $this -> error = array('not_image' => 0, 'ext' => 0, 'size' => 0, 'exists' => 0,'pre_query' => 0,'set_target' => 0, 'file_exists' => 0, 'post_query' => 0);
            }
    
            public function check_if_image(){
                $img_type = $_FILES['imgfile']['type'];
                if(strpos($img_type, 'image/', 0)!== false)
                    return 1;
                else{
                    $this -> error['not_image'] = 1;
                    return 0;
                }
            }
    
            public function check_extension(){
                $this -> ext = pathinfo($_FILES['imgfile']['name'], PATHINFO_EXTENSION);
                if( ($this->ext!= 'jpg') && ($this->ext!='jpeg') && ($this->ext!='png') ) { //check valid extensions
                    $this -> error['ext'] = 1;
                    return 0;
                }
                else
                    return 1;
            }
    
            public function check_size(){
                if($_FILES['imgfile']['size'] > 5e+6){
                   $this -> error['size'] = 1;
                    return 0;
                 } else    
                    return 1;
            }
    
            public function pre_query(){ //inserts all form data except image
                    try{
                        $query = "insert into books (name, isbn, author ,category, rack, copies) values (?, ?, ?, ?, ?, ?)";
                        $stmt = $this -> conn -> prepare($query);
                        $stmt -> execute([ $_POST['book_name'], $_POST['isbn'], $_POST['author_name'], $_POST['category_name'], $_POST['rack_name'], $_POST['copies']]);
                        $this -> insert_id = $this -> conn -> lastInsertId();
                        return 1;
                    }catch(Exception $e){
                        // echo $e ->getMessage();
                        $this -> error['pre_query'] = 1;
                        return 0; //if query cant execute return 0
                    }
                
            }
    
            public function set_target(){
               if( ($this -> check_extension()) && ($this -> pre_query()) ){  //sets $ext, $target_file and runs query
                    $this -> img_name = $this -> insert_id . '.' . $this -> ext;
                    $this -> target_file = $this -> target_dir . $this -> img_name;
                    return 1;
               }else{
                $this -> error['set_target'] = 1;
                return 0;
               }
            }

            public function doesnt_exists(){
                if(file_exists($this -> target_file)){
                    $this -> error['file_exists'] = 1;
                    return 0;
                }else{
                    return 1;
                }
            }
    
            public function check_all(){
                if( ($this -> check_if_image()) && ($this -> check_size()) && ($this -> set_target()) && ($this -> doesnt_exists()) ){
                    return 1;
                }else{
                    return 0;
                }
            }
    
            public function upload_file(){
                if($this -> check_all()){
                    if(move_uploaded_file($_FILES['imgfile']['tmp_name'], $this -> target_file)){
                        return 1;
                    }else{
                        return 0;
                    }
                }else{
                    return 0;
                }
            }
    
            public function post_query(){ //set image name
                try{
                    $query = 'update books set imgname = ? where b_id = ?';
                    $stmt = $this -> conn -> prepare($query);
                    $stmt -> execute([$this -> img_name, $this ->  conn -> lastInsertId()]);
                    return 1;
                }catch(Exception $e){
                    $this -> error['post_query'] = 1;
                    return 0;
                }
            }
    
        }
        $i1 = new image($db);
        $ok = $i1 ->  upload_file();
        $i1 -> post_query();
        // print_r($i1 -> error);
        header("Location:../dboard/manage_books.php");
    }