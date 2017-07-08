<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "instituto";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
                leerUsuarios($conn);
            break;
    }

    function leerUsuarios($conn)
    {
        $users = array();
        $sql = "SELECT * FROM alumnos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                
                $array = array(
                    "id"=>$row["id"], 
                    "nombre"=>$row["nombre"], 
                    "Dni"=>$row["dni"]
                );
                array_push($users, $array);
            }
            echo json_encode($users);
        } else {
            echo "0 results";
        }
        $conn->close();
    }

    function guardarUsuario($conn, $name, $dni)
    {
        $sql = "INSERT INTO alumnos (nombre, dni) VALUES ('".$name."', '".$dni."')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    function actualizarUsuario($conn, $name, $id){
        $sql = "UPDATE alumnos SET nombre='".$name."' WHERE id=".$id;

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
    }

?>