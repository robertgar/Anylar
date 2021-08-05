<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
$direc='';
$nombre='';
$res='';
$json = file_get_contents('php://input');
 
  $params = json_decode($json);

$buffer='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
xmlns:ser="http://services.ws.ingface.com/">
<soapenv:Header/>
<soapenv:Body>
<ser:nitContribuyentes>
<!--Optional:-->
<usuario>DEMO</usuario>
<!--Optional:-->
<clave>C2FDC80789AFAF22C372965901B16DF533A4FCB19FD9F2FD5CBDA554032983B0</clave>
<nit>'.$params->nit.'</nit>
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
echo 'Curl error: ' . curl_error($soap_do);
  $res='error';
} else {
  $res='OK';
$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $result);
$xml = new SimpleXMLElement($response);
$body = $xml->xpath('//SBody')[0];
$array = json_decode(json_encode((array)$body), TRUE); 
 $direc= utf8_decode($array['ns2nitContribuyentesResponse']['return']['direccion_completa']);
 $aaaa= utf8_decode($array['ns2nitContribuyentesResponse']['return']['nombre']);
$div=explode( ',,', $aaaa  );
$tl= $div[1].' '.$div[0]; 
$nombre = utf8_decode(str_replace(',', '  ', $tl));
}
curl_close ($soap_do);
  class Result {}
  $response = new Result();
$response->resultado = $res;
  $response->mensaje = $direc;
  $response->mensaje1 = $nombre;
  


  header('Content-Type: application/json');
  echo json_encode($response);  


?>
