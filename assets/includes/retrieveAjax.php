 <?php
    header("content-type:application/json");
    include 'dbConnect.php';
    $db=new myDB("root", "root", "127.0.0.1", "personalWeb", 8889);
    
    //$id = $_POST['id'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $sql="SELECT Value, Id FROM (SELECT Value, id, Session FROM  trackInput WHERE ip='" . $ip . "' and IsSaved=1) as t1 INNER JOIN (SELECT MAX(Session) as sess FROM trackInput WHERE ip='" . $ip . "' and IsSaved=1) as t2 ON t1.Session=t2.sess";
    $db->execute($sql); //returns values, if any
    
    
 ?>