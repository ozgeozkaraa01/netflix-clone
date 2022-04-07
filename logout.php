<?php
session_start(); //session(oturum)ilk başta start etmemiz lazım
session_destroy(); //destroy diyerek bütün session bilgilerini sildik ve daha sonra kullanıcıyı index yani kayıt sayfasına gönderdik

header("Location: index.php");
