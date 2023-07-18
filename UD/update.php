<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
    require_once '../config/connection.php';

    if(isset($_POST['update_category_form'])){  
        $id = $_POST['cat_id'];
        $name = $_POST['name'];

        // echo $id;
        // echo $name;

        $query = "update category set Name = :name where category_id = :id";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':name' => $name, ':id' => $id]);
        header('Location:../dboard/category.php');
    
    }else if(isset($_POST['update_author_form'])){  
        $id = $_POST['auth_id'];
        $name = $_POST['auth_name'];

        // echo $id;
        // echo $name;

        $query = "update author set Name = :name where auth_id = :id";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':name' => $name, ':id' => $id]);
        header('Location:../dboard/author.php');


    }else if(isset($_POST['update_rack_form'])){  
        $id = $_POST['rack_id'];
        $name = $_POST['rack_name'];

        // echo $id;
        // echo $name;

        $query = "update rack set Name = :name where rack_id = :id";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':name' => $name, ':id' => $id]);
        header('Location:../dboard/rack.php');

    } else if(isset($_POST['update_book_form'])){

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

            public function doesnt_exists(){
                if(file_exists($this -> target_file)){
                    $this -> error['file_exists'] = 1;
                    return 0;
                }else{
                    return 1;
                }
            }
    
            public function pre_query(){ //inserts all form data except image
                if(!empty($_FILES['imgfile']['tmp_name'])){
                    if( ($this -> check_if_image()) && ($this -> check_size()) && ($this -> check_extension()) ){
                        try{
                            $query = "update books set name = ?, isbn = ?, author =?, category = ?, rack = ?, copies = ? where b_id = ?";
                            $stmt = $this -> conn -> prepare($query);
                            $stmt -> execute([ $_POST['book_name'], $_POST['isbn'], $_POST['author_name'], $_POST['category_name'], $_POST['rack_name'], $_POST['copies'], $_POST['b_idd']]);
                            // $this -> insert_id = $this -> conn -> lastInsertId();
                            $_SESSION['run_prequery'] = 1;
                            // echo "<pre>";
                            // print_r($_POST);
                            // echo "</pre>";
                            return 1;
                        }catch(Exception $e){
                            // echo $e ->getMessage();
                            $this -> error['pre_query'] = 1;
                            return 0; //if query cant execute return 0
                        }
                    } else{
                        return 0;
                    }
                }else{
                    try{
                        $query = "update books set name = ?, isbn = ?, author =?, category = ?, rack = ?, copies = ? where b_id = ?";
                        $stmt = $this -> conn -> prepare($query);
                        $stmt -> execute([ $_POST['book_name'], $_POST['isbn'], $_POST['author_name'], $_POST['category_name'], $_POST['rack_name'], $_POST['copies'], $_POST['b_idd']]);
                        // $this -> insert_id = $this -> conn -> lastInsertId();
                        $_SESSION['run_prequery'] = 1;
                        // echo "<pre>";
                        // print_r($_POST);
                        // echo "</pre>";
                        return 1;
                    }catch(Exception $e){
                        // echo $e ->getMessage();
                        $this -> error['pre_query'] = 1;
                        return 0; //if query cant execute return 0
                    }
                } 
            }
        
            
    
            public function set_target(){
               if( $this -> pre_query() ){  //sets $ext, $target_file and runs query
                    $this -> img_name = $_POST['iname'];
                    $this -> target_file = $this -> target_dir . $this -> img_name;
                    return 1;
               }else{
                $this -> error['set_target'] = 1;
                return 0;
               }
            }
    
            public function upload_file(){
                if( $this -> set_target() ){
                    unlink("../images/books/{$_POST['iname']}");
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
                    $stmt -> execute([$this -> img_name, $_POST['b_idd'] ]);
                    return 1;
                }catch(Exception $e){
                    $this -> error['post_query'] = 1;
                    return 0;
                }
            }
    
        }

        if(!empty($_FILES['imgfile']['tmp_name'])){
            $i1 = new image($db);
            $ok = $i1 ->  upload_file();
            if($ok == 1){ //image uploaded vayo vne $ok = 1 hunxa
                $i1 -> post_query();
                header("Location:../dboard/manage_books.php");
                exit;
            }else{
                $_SESSION['update_book_error'] = 1;

                $_SESSION['book_name2'] = $_POST['book_name'];
                $_SESSION['isbn2'] = $_POST['isbn'];
                $_SESSION['author_name2'] = $_POST['author_name'];
                $_SESSION['book_name2'] = $_POST['book_name'];
                $_SESSION['category_name2'] = $_POST['category_name'];
                $_SESSION['rack_name2'] = $_POST['rack_name'];
                $_SESSION['copies2'] = $_POST['copies'];
                $_SESSION['b_idd'] = $_POST['b_idd'];
                $_SESSION['iname'] = $_POST['iname'];


                // echo "hi";
                header("Location:../dboard/manage_books.php");
            }
        }else{
            $i2 = new image($db);
                $i2 -> pre_query();
                // echo 'k cha';
                // echo $_POST['iname'];
                header("Location:../dboard/manage_books.php");

        }
    }else if(isset($_POST['update_admin_form'])){
            $query = "update admin set fname=?, lname=?, password=?, address=?, role =? , phone =?
            where a_id = ?";
            $stmt = $db -> prepare($query);
            $stmt -> execute([
                $_POST['fname'],
                $_POST['lname'],
                $_POST['password'],
                $_POST['address'],
                $_POST['update_role'],
                $_POST['phone'],
                $_POST['update_admin_id']
            ]);
            header("Location:../dboard/manage_admin.php");
        
    }else if(isset($_POST['update_issue_book'])){
        $query  = "update issue_book set Status = ? where issue_id = ?";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$_POST['status'], $_POST['bissue_id']]);

        header("Location:../dboard/issue.php");
    }


















?>