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

function price_calculator($price,$discount) {
      $newprice = $price-$discount;
      return $newprice;
}
?>