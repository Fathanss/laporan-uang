<?php

class PPDBController{


    function connection() { 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ppdb";
        
        $conn = mysqli_connect($servername, 
                    $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: "
            . mysqli_connect_error());
        }

        return $conn;
    }


    function list($param) 
    {
        $conn = $this->connection();
        $arrDatas = [];
        $sql = "SELECT id, code, nama, alamat, nilai, asal_sekolah FROM `calon_siswa` order by nilai desc;";

        if (mysqli_query($conn, $sql)) {
            $result = mysqli_query($conn, $sql);

            while($row = $result->fetch_assoc()) {                
                $arrDatas[] = [
                    'id' => $row['id'],
                    'nama' => $row['nama'],
                    'alamat' => $row['alamat'],
                    'nilai' => $row['nilai'],
                    'asal' => $row['asal_sekolah'],
                    'code' => $row['code'],


                ];
            }
        } 
        
        mysqli_close($conn);

        return $arrDatas;
    }


    function create($request)
    {
        $nilai = $request['nilai'];
        $alamat = $request['alamat'];
        $asal = $request['asal'];
        $nama = $request['nama'];
        $code = date("YmdHis").rand(0,9);
        


        $conn = $this->connection();

        $sql = "INSERT INTO calon_siswa (code, alamat, nilai, asal_sekolah, nama, created_at, updated_at)
        VALUES ('". $code."','". $alamat."', '".$nilai."', '".$asal."','".$nama."', now(), now())";

        if (mysqli_query($conn, $sql)) {
            $arrDatas = 
                [
                    'alamat' => $alamat,
                    'nilai' => $nilai,
                    'asal-sekolah' => $asal,
                    'nama' => $nama,
                    'code' => $code,
                ];
        } else {
            $arrDatas = [];
        }
        
        mysqli_close($conn);

        return $arrDatas;
    }


    function delete($request)
    {
        $id = $request['id'];

         $arrDatas = [];

        $conn = $this->connection();

        $sql = "DELETE FROM calon_siswa WHERE `calon_siswa`.`id` = ".$id;

        mysqli_query($conn, $sql);
        
        mysqli_close($conn);

        return $arrDatas;
    }


    function show($request)
    {
        $code = $request['code'];

        $conn = $this->connection();
        $arrDatas = [
            'status' => false,
            'data' => []
        ];
        $sql = "SELECT id, code, nama, alamat, nilai, asal_sekolah, created_at FROM `calon_siswa` WHERE `calon_siswa`.`code` = ".$code;

        if (mysqli_query($conn, $sql)) {
            $result = mysqli_query($conn, $sql);

            while($row = $result->fetch_assoc()) {                
                $arrDatas = [
                    'status' => true,
                    'data' => [
                        'id' => $row['id'],
                        'nama' => $row['nama'],
                        'alamat' => $row['alamat'],
                        'nilai' => $row['nilai'],
                        'asal' => $row['asal_sekolah'],
                        'code' => $row['code'],
                        'created_at' => $row['created_at'],
                    ]
                ];
            }
        } 
        
        mysqli_close($conn);

        return $arrDatas;
    }

//laporan lpran
}