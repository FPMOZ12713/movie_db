<?php  
session_start();
include "db_conn.php";

if (isset($_POST['kor_ime']) && isset($_POST['lozinka']) && isset($_POST['uloga'])) {

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$kor_ime = test_input($_POST['kor_ime']);
	$lozinka = test_input($_POST['lozinka']);
	$uloga = test_input($_POST['uloga']);

	if (empty($kor_ime)) {
		header("Location: index.php?error=Unesite korisničko ime");
	}else if (empty($lozinka)) {
		header("Location: index.php?error=Unesite lozinku");
	}else {

		// Hashing the password
		$lozinka = sha1($lozinka);
        
        $sql = "SELECT * FROM users WHERE korisnicko_ime='$kor_ime' AND lozinka='$lozinka'";
        $rezultat = mysqli_query($conn, $sql);

        if (mysqli_num_rows($rezultat) === 1) {
        	// the user name must be unique
        	$row = mysqli_fetch_assoc($rezultat);
        	if ($row['lozinka'] === $lozinka && $row['uloga'] == $uloga) {
				$_SESSION['uloga'] = $row['uloga'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['ime'] = $row['ime'];
        		$_SESSION['prezime'] = $row['prezime'];
        		$_SESSION['kor_ime'] = $row['korisnicko_ime'];
        		$_SESSION['email'] = $row['email'];

        		header("Location: home.php");

        	}else {
        		header("Location: index.php?error=Netočna lozinka ili korisničko ime");
        	}
        }else {
        	header("Location: index.php?error=Netočna lozinka ili korisničko ime");
        }

	}
	
}else {
	header("Location: index.php");
}