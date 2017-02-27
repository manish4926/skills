<?php
function state() {
$liststate = [
            'Andaman and Nicobar Islands' => 'ANI',
            'Andra Pradesh' => 'AP',
            'Arunachal Pradesh' => 'AR',
            'Assam' => 'AS',
            'Bihar' => 'BR',
            'Chandigarh' => 'CH',
            'Chhattisgarh' => 'CT',
            'Dadar and Nagar Haveli' => 'DN',
            'Daman and Diu' => 'DD',
            'Delhi' => 'DE',
            'Goa' => 'GA',
            'Gujarat' => 'GJ',
            'Haryana' => 'HR',
            'Himachal Pradesh' => 'HP',
            'Jammu and Kashmir' => 'JK',
            'Jharkhand' => 'JH',
            'Karnataka' => 'KA',
            'Kerala' => 'KL',
            'Lakshadeep' => 'LA',
            'Madya Pradesh' => 'MP',
            'Maharashtra' => 'MH',
            'Manipur' => 'MN',
            'Meghalaya' => 'ML',
            'Mizoram' => 'MZ',
            'Nagaland' => 'NL',
            'Orissa' => 'OR',
            'Pondicherry' => 'PR',
            'Punjab' => 'PB',
            'Rajasthan' => 'RJ',
            'Sikkim' => 'SK',
            'Tamil Nadu' => 'TN',
            'Tripura' => 'TR',
            'Uttar Pradesh' => 'UP',
            'Uttaranchal' => 'UT',
            'West Bengal' => 'WB'
        ];

    return $liststate;
}

function basic_education() {
    $list = [
        '8th class',
        '9th class',
        '10th class',
        '11th class',
        '12th class',
        'Under Graduate',
        'Graduate',
        'Post graduate',
        'Phd'
    ];
    return $list;
}

function teaching_exp() {
    $list = [
        'PhD',
        'Post Graduate',
        'Graduate',
        'Under Graduate'
    ];
    return $list;
}

function profile_section_array($id) {
    if($id == 2)
    {
        $array = [0,11,12,13,14,15,16,17,18];  //Teachers
    } 
    elseif($id == 3) {
        $array = [0,1,2,3,4,5,6,7,8,9,10];  //Student
    }
    elseif($id == 4) {
        $array = [24,0,19,20,21,22,23,7,8,9,10];  //Institutes
    }
    elseif($id == 5) {
        $array = [24,0,13,21,22];  //Business Associate
    }
    return $array;
}

function price_calculator($price,$discount) {
      $newprice = $price-$discount;
      return $newprice;
}

function send_message($number,$message){
    $user = config('services.sms')['client_id'];
    $password = config('services.sms')['client_secret'];
    $sender_id = config('services.sms')['client_senderid'];
    $priority = 'ndnd';
    $sms_type = 'normal';
    $data = array('user'=>$user, 'pass'=>$password, 'sender'=>$sender_id, 'phone'=>$number, 'text'=>$message, 'priority'=>$priority, 'stype'=>$sms_type);//
    $ch = curl_init('http://bhashsms.com/api/sendmsg.php?');
    //echo var_dump($data);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //echo var_dump($ch);
    try {
        $response = curl_exec($ch);
        //echo var_dump($ch);
        curl_close($ch);
        //echo var_dump($response);
        //echo 'Message has been sent.';
    }catch(Exception $e){
        //echo 'Message: ' .$e->getMessage();
    }
}

function timestampToTime($date,$addDays = 0){
    if($addDays != 0)
    {
        $date = strtotime("+".$addDays." days",$date);
    }
    else{
        $date = strtotime($date);
    }
}
function timestampToDate($date,$addDays = 0){
    if($addDays != 0)
    {
        $date = date('d/m/Y',strtotime("+".$addDays." days",$date));
    }
    else{
        $date = date('d M Y',strtotime($date));
    }
    return $date;
}

function seoUrl($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}


function deleteFile($path,$filename)
{
    unlink($path."/".$filename);
}

function fileDownload($file)
{
    //$files = json_decode(json_decode($file));
    $file = json_decode(json_decode($file,true),true)['files'][0];

    $filename = $file['name'];
    $fileext = $file['extension'];
    $filemime = $file['mime'];
    
    $filepath = public_path('img/files/' . $file['path']);


    $headers = array(
              'Content-Type: '.$filemime,
            );

    return response()->download($filepath, $filename.'.'.$fileext, $headers);
}
?>