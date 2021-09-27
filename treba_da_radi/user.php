<?php
session_start();


class user {
    public static $prijavljeniKorisnik;

    public static function jePrijavljen(){
        global $conn;
        $id = $_SESSION["token"];
        $upit = "SELECT * FROM users WHERE ID=".$id;
        $rezultat = mysqli_query($conn, $upit);
        self::$prijavljeniKorisnik = mysqli_fetch_assoc($rezultat);
        if (self::$prijavljeniKorisnik) {
            return true;
        }
        return false;
    }
    public static function brisi($id){
        global $conn;
        $id = intval($id);
        $upit = "DELETE FROM users WHERE ID=" . $id;
        return mysqli_query($conn, $upit);
    }

    public static function edit($id){
        global $conn;
        $id = intval($id);
        $upit = "UPDATE role SET status = 'admin' WHERE id = '$id'";
        return mysqli_query($conn, $upit);
    }
}
    
    
    ?>