<?php
/**
 * Created by PhpStorm.
 * User: jrt
 * Date: 04-Feb-17
 * Time: 4:41 PM
 */

//include('config.php');

session_start();

$con = mysqli_connect('localhost', 'root', '', 'test');

if(isset($_SESSION['emp_id'])){

        unset($_SESSION['lab']);

        $query = mysqli_query($con,"select * from personnel where pid='".$_SESSION['emp_id']."'");
        $num = mysqli_num_rows($query);
        if($num==1){
            $myfile = fopen("testfile.txt", "w");
            fwrite($myfile, 'name found');

            $result = mysqli_fetch_array($query,MYSQLI_ASSOC);

            $query = mysqli_query($con,"select Lab_nos from systemadmin where id='".$_SESSION['emp_id']."'");
            $lab_names = mysqli_fetch_assoc($query)['Lab_nos'];

            $name = $result['pname'];

            if(isset($_POST['action'])) {

                echo json_encode(array('name'=>$name,'lab_names'=>$lab_names));

                $myfile = fopen("testfile.txt", "w");
                fwrite($myfile, 'response sent');
            }

    }else{
        $myfile = fopen("testfile.txt", "w");
        fwrite($myfile, 'name fetch error');

    }

}

else {
    $myfile = fopen("testfile.txt", "w");
    fwrite($myfile, 'session error');
}