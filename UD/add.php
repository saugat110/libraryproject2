<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    session_start();
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

            public function doesnt_exists(){
                if(file_exists($this -> target_file)){
                    $this -> error['file_exists'] = 1;
                    return 0;
                }else{
                    return 1;
                }
            }
    
            public function pre_query(){ //inserts all form data except image
                if( ($this -> check_if_image()) && ($this -> check_size()) && ($this -> check_extension()) && ($this -> doesnt_exists()) ){
                    try{
                        $query = "insert into books (name, isbn, author ,category, rack, copies) values (?, ?, ?, ?, ?, ?)";
                        $stmt = $this -> conn -> prepare($query);
                        $stmt -> execute([ $_POST['book_name'], $_POST['isbn'], $_POST['author_name'], $_POST['category_name'], $_POST['rack_name'], $_POST['copies']]);
                        $this -> insert_id = $this -> conn -> lastInsertId();
                        $_SESSION['run_prequery'] = 1;
                        return 1;
                    }catch(Exception $e){
                        // echo $e ->getMessage();
                        $this -> error['pre_query'] = 1;
                        return 0; //if query cant execute return 0
                    }
                } else{
                    return 0;
                }
            }
    
            public function set_target(){
               if( $this -> pre_query() ){  //sets $ext, $target_file and runs query
                    $this -> img_name = $this -> insert_id . '.' . $this -> ext;
                    $this -> target_file = $this -> target_dir . $this -> img_name;
                    return 1;
               }else{
                $this -> error['set_target'] = 1;
                return 0;
               }
            }
    
            public function upload_file(){
                if($this -> set_target()){
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
        if($ok == 1){ //image uploaded vayo vne $ok = 1 hunxa
            $i1 -> post_query();
            header("Location:../dboard/manage_books.php");
        }else{
            $_SESSION['add_book_error'] = 1;

            $_SESSION['book_name'] = $_POST['book_name'];
            $_SESSION['isbn'] = $_POST['isbn'];
            $_SESSION['author_name'] = $_POST['author_name'];
            $_SESSION['book_name'] = $_POST['book_name'];
            $_SESSION['category_name'] = $_POST['category_name'];
            $_SESSION['rack_name'] = $_POST['rack_name'];
            $_SESSION['copies'] = $_POST['copies'];



            header("Location:../dboard/manage_books.php");
        }
        // print_r($i1 -> error);
    }else if(isset($_POST['add_admin_form'])){ //add admin form

        $query = "Select email from admin where email = ?";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$_POST['email']]);

        if($stmt -> rowCount() == 0){  //duplicate email xaina vne
            $query2= "insert into admin(fname, lname, email, phone, address, password, role) values(?, ?, ?, ?, ?, ?, ?)";
            $stmt2 = $db -> prepare($query2);
            $stmt2 -> execute([$_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['password'] ,$_POST['role']]);
            header("Location:../dboard/manage_admin.php");
        }else{
            $_SESSION['add_admin_error'] = 1;

            $_SESSION['fname'] = $_POST['fname'];
            $_SESSION['lname'] = $_POST['lname'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['phone'] = $_POST['phone'];
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['role'] = $_POST['role'];

            header('Location:../dboard/manage_admin.php');
        }
    }else if(isset($_POST['add_student_form'])){

        $query = "Select email from student where email = ?";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$_POST['email']]);

        if($stmt -> rowCount() == 0){
            $query2= "insert into student(fname, lname, email, phone, address, faculty, roll) values(?, ?, ?, ?, ?, ?, ?)";
            $stmt2 = $db -> prepare($query2);
            $stmt2 -> execute([$_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['facult'] ,$_POST['roll']]);
            header("Location:../dboard/manage_user.php");

        }else{
            $_SESSION['add_student_error'] = 1;

            $_SESSION['fname'] = $_POST['fname'];
            $_SESSION['lname'] = $_POST['lname'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['phone'] = $_POST['phone'];
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['faculty'] = $_POST['facult'];
            $_SESSION['roll'] = $_POST['roll'];

            header('Location:../dboard/manage_user.php');

        }
    }else if(isset($_POST['issue_book_form'])){

        $query = "select name from books where isbn = ?";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$_POST['isbn']]);
        $result = $stmt -> fetch(PDO::FETCH_ASSOC);

        $query2 = "select fname, faculty from student where roll =?";
        $stmt2 = $db -> prepare($query2);
        $stmt2 -> execute([$_POST['sroll']]);
        $result2 = $stmt2 -> fetch(PDO::FETCH_ASSOC);

        $query3 = "update books set copies = copies - 1 where isbn = ?";
        $stmt3 = $db -> prepare($query3);
        $stmt3 -> execute([$_POST['isbn']]);

        $today = date("Y-m-d");

        $main_query = "insert into issue_book (Book, ISBN, Student, roll, Faculty, Issue_date, Expected_return, Status )
        values (?,?,?,?,?,?,?,?)";
        $stmt_main = $db -> prepare($main_query);
        $stmt_main -> execute([ $result['name'], $_POST['isbn'], $result2['fname'], $_POST['sroll'], $result2['faculty'], $today, $_POST['erdate'], $_POST['status']]);
        

        header('Location:../dboard/issue.php');


        // echo 'hi';

    }




?>