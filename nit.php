<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<form method="POST">
	<label for="direccion"></label>
    <input type="text" name="direccion" value="">
<button type="submit" name="buton">Enviar</button>
</form>
<h1></h1>
<p></p>


</body>
</html>
<?php
if(isset($_POST['direccion']))
{
$a=$_POST['direccion'];

$buffer='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
xmlns:ser="http://services.ws.ingface.com/">
<soapenv:Header/>
<soapenv:Body>
<ser:nitContribuyentes>
<!--Optional:-->
<usuario>DEMO</usuario>
<!--Optional:-->
<clave>C2FDC80789AFAF22C372965901B16DF533A4FCB19FD9F2FD5CBDA554032983B0</clave>
<nit>'.$a.'</nit>
</ser:nitContribuyentes>
</soapenv:Body';

$url ="https://www.ingface.net/ServiciosIngface/ingfaceWsServices";  //URL de DHL


$prexml = $buffer;



$soap_do = curl_init(); 
curl_setopt($soap_do, CURLOPT_URL,            $url );   
curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10); 
curl_setopt($soap_do, CURLOPT_TIMEOUT,        10); 
curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($soap_do, CURLOPT_POST,           true ); 
curl_setopt($soap_do, CURLOPT_POSTFIELDS,    $prexml); 
curl_setopt($soap_do, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));


$result = curl_exec($soap_do);
$err = curl_error($soap_do);
       

            // Verificar si ocurrió algún error
if (curl_exec($soap_do) === false) {

echo ' ' . $a.' ';

echo 'Curl error: ' . curl_error($soap_do);


} else {
 
echo ' ' . $a.' ';
echo '<br>';

echo '<br>';
$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $result);
$xml = new SimpleXMLElement($response);
$body = $xml->xpath('//SBody')[0];
$array = json_decode(json_encode((array)$body), TRUE); 
//print_r($array);

  
 echo utf8_decode($array['ns2nitContribuyentesResponse']['return']['direccion_completa']);
 echo '<br>';
 echo '<br>';
 $aaaa= utf8_decode($array['ns2nitContribuyentesResponse']['return']['nombre']);

  echo '<br>';
 echo '<br>';
$div=explode( ',,', $aaaa  );

$tl= $div[1].' '.$div[0]; 
$salida = str_replace(',', '  ', $tl);
echo $salida;



echo '<br>';






}


curl_close ($soap_do);


}
?>
