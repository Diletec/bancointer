<?php
/**
*www.diletec.com.br
*contato@diletec.com.br
*/

$dirSSL = __DIR__;
$codificado = 'certificado.crt'; //Peque-o no Banco inter
$decodificado = 'certificado.key'; //A Key qye você gerou

$url = "https://apis.bancointer.com.br/openbanking/v1/certificado/boletos";
$data = "?filtrarPor=TODOS&dataInicial=2020-08-07&dataFinal=2020-09-08&ordenarPor=NOSSONUMERO&page=0&size=10";
$tuCurl = curl_init();
curl_setopt($tuCurl, CURLOPT_URL, $url.$data);
curl_setopt($tuCurl, CURLOPT_PORT , 8443);
curl_setopt($tuCurl, CURLOPT_SSLCERT, $codificado);
curl_setopt($tuCurl, CURLOPT_SSLKEY, getcwd() .'/'.$decodificado);
//curl_setopt($tuCurl, CURLOPT_KEYPASSWD, "Se tiver senha coloqueia aqui");
curl_setopt($tuCurl, CURLOPT_CAINFO, getcwd() . "/".$codificado);
curl_setopt($tuCurl, CURLOPT_POST, 0);
curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($tuCurl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($tuCurl, CURLOPT_FAILONERROR, 1);
curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($tuCurl, CURLOPT_POSTFIELDS, $data);
curl_setopt($tuCurl, CURLOPT_HTTPHEADER, array(
    "x-inter-conta-corrente: 00000000", //Todos os 8 digitos da conta contando com o digito, sem traço
    
    )
);


$tuData = curl_exec($tuCurl);
if(!curl_errno($tuCurl)){
//   $info = curl_getinfo($tuCurl);
//   echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
  print_r($tuData);
} else {
  echo 'Curl error: ' . curl_error($tuCurl);
}



// echo '<br/>---------Info Inicio---------<br/>';
// var_dump(curl_getinfo($tuCurl));
// echo '<br/>---------Info Fim------------<br/>';

// echo '<br/>---------Errno Inicio---------<br/>';
// var_dump(curl_errno($tuCurl));
// echo '<br/>---------Errno Fim------------<br/>';

// echo '<br/>---------Error Inicio---------<br/>';
// var_dump(curl_error($tuCurl));
// echo '<br/>---------Error Fim------------<br/>';

curl_close($tuCurl);
