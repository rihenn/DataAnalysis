<?php 
// Hedef URL
$url = 'http://10.200.120.10:9091/Integratorservice/connect';

// URL'den içeriği al
$response = file_get_contents($url);

// Eğer yanıt alınamazsa hata mesajı göster
if($response === false){
    die('Cannot access ' . $url);
}

// İçeriğin içinden özel URL'yi tanımlamak için bir yöntem geliştirin
// Bu örnekte, özel URL'nin "http" ile başlayan bir dizi karakter olduğunu varsayalım
if (preg_match('/http[^\'"\s]+/', $response, $matches)) {
    // Eşleşen URL'yi yazdır
    echo "Özel URL: " . $matches[0];
} else {
  
    // JSON'u diziye dönüştür
$response_array = json_decode($response, true);

// Eğer dönüştürme başarısız olursa hata mesajı göster
if ($response_array === null) {
    die('JSON decode error');
}

// SessionID'yi al
$session_id = $response_array['SessionID'];


}
