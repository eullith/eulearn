<?php
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$pwd = $_POST['pwd'];
$email = $_POST['email'];

if (!empty($name) || !empty($pwd) || !empty($lastname) || 
!empty($phone) || !empty($email)) {
    $host = "b13hbkm6nf259zgsy7l4-mysql.services.clever-cloud.com";
    $dbUsername = "ubtwlmh4vfzsiycu";
    $dbPassword = "rJajKZtq6oCYPpzh9nfu";
    $dbName = "b13hbkm6nf259zgsy7l4";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if (mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }else 
    {
        $SELECT = "SELECT email from user where email = ? Limit 1";
        $INSERT = "INSERT into user (name, lastname, phone, pwd, email)
        values (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssii", $name, $lastname, $pwd, $phone, $email);
            $stmt->execute();
            echo "Has sido registrado exitosamente";
        }else 
        {
            echo "Alguien ya se registró con este correo electrónico";
        }
        $stmt->close();
        $conn->close();
    }

}else 
{
    echo "All field are required";
    die();
}
?>