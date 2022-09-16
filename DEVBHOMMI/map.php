<?php
$address='Shivpuri Madhya Pradesh';
function get_geocode($address){
 
    // url encode the address
    $address = urlencode($address);
    
    // google map geocode api url
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
 
    // get the json response from url
    $resp_json = file_get_contents($url);
    
    // decode the json response
    $resp = json_decode($resp_json, true);
    // response status will be 'OK', if able to geocode given address
    if($resp['status']=='OK'){
      //define empty array
     $data_arr = array(); 
        // get the important data
        $data_arr['latitude'] = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : '';
        $data_arr['longitude'] = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : '';
        $data_arr['formatted_address'] = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : '';
        
        // verify if data is exist
        if(!empty($data_arr) && !empty($data_arr['latitude']) && !empty($data_arr['longitude'])){

            return $data_arr;
            
        }else{
            return false;
        }
        
    }else{
        return false;
    }
}
echo json_encode(get_geocode('denver'));
?>