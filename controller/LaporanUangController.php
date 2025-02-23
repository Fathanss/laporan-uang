<?php

class laporanUangController{


    function connection() { 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "laporan_uang";
        
        $conn = mysqli_connect($servername, 
                    $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: "
            . mysqli_connect_error());
        }

        return $conn;
    }


    function list() 
    {
        $conn = $this->connection();

        $sql = "select...";

        if (mysqli_query($conn, $sql)) {
            $arrDatas = [];

            $sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = mysqli_query($conn, $sql);

        } 
        
        mysqli_close($conn);

        return $arrDatas;
    }


    function create($request)
    {
        $tanggal = $request['tanggal'];
        $nominal = $request['nominal'];
        $tipe = $request['tipe'];
        $notes = $request['notes'];
        $nama = $request['nama'];


        $conn = $this->connection();

        $sql = "INSERT INTO tbl_saving (tanggal, nominal, tipe, notes, nama, created_at, updated_at)
        VALUES ('". $tanggal."', '".$nominal."', '".$tipe."','".$notes."','".$nama."', now(), now())";

        if (mysqli_query($conn, $sql)) {
            $arrDatas = 
                [
                    'tanggal' => $tanggal,
                    'nominal' => $nominal,
                    'tipe' => $tipe,
                    'notes' => $notes,
                    'nama' => $nama,
                ];
        } else {
            $arrDatas = [];
        }
        
        mysqli_close($conn);

        return $arrDatas;
    }

}