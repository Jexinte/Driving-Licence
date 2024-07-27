<?php
function driver($data) {
  
    $menMonth = choosingMonthOfBirthForMens($data);
    $womenMonth = choosingMonthOfBirthForWomens($data);
    $isMaleOrFemale = $data[4];

    return $isMaleOrFemale == "M" ? transformSurnameDependingOnTheLengthOfIt($data).decadeDigit($data).current($menMonth).dateOfBirth($data).lastDigitOfYearDigit($data).getInitialsFromFirstAndMiddleName($data).'9AA' : transformSurnameDependingOnTheLengthOfIt($data).decadeDigit($data).current($womenMonth).dateOfBirth($data).lastDigitOfYearDigit($data).getInitialsFromFirstAndMiddleName($data).'9AA';  
  }
  
  function transformSurnameDependingOnTheLengthOfIt($data){
    $nameWithLessThanFiveCharactersPaddedWithNine = strtoupper($data[2].str_repeat('9',5 - strlen($data[2])));
    $name = strtoupper($data[2]);
    return strlen($name) < 5 ?  $nameWithLessThanFiveCharactersPaddedWithNine : $name;
  }
  
  function decadeDigit($data){
    $yearOfBirth = $data[3];
    $splitBirthDate = explode('-',$yearOfBirth);
    
  
    return $splitBirthDate[2][2];
  }
  
  function choosingMonthOfBirthForWomens($data){
    $yearOfBirth = $data[3];
   
  $monthAndTheirNumbersForWomens = [
      "51" => "Jan",
      "52" => "Feb",
      "53" => "Mar",
      "54" => "Apr",
      "55" => "May",
      "56" => "Jun",
      "57" => "Jul",
      "58" => "Aug",
      "59" => "September",
      "60" => "October",
      "61" => "November",
      "62" => "Dec"
  ];
  
    
    $splitBirthDate = explode('-',$yearOfBirth);
    
    if(in_array($splitBirthDate[1],$monthAndTheirNumbersForWomens)){    
    //var_dump(array_flip($monthAndTheirNumbersForWomens)[$splitBirthDate[1]]);
      return [array_flip($monthAndTheirNumbersForWomens)[$splitBirthDate[1]]];
    }
    return null;
  }
  
  
  function choosingMonthOfBirthForMens($data){
     $yearOfBirth = $data[3];
    
    $splitBirthDate = explode('-',$yearOfBirth);
    $monthAndTheirsNumbersForMens = [
      "01" => "Jan",
      "02" => "Feb",
      "03" => "Mar",
      "04" => "Apr",
      "05" => "May",
      "06" => "Jun",
      "07" => "Jul",
      "08" => "Aug",
      "09" => "September",
      "10" => "October",
      "11" => "November",
      "12" => "Dec"
  ];
  
    if(in_array($splitBirthDate[1],$monthAndTheirsNumbersForMens)){
        
      return [array_flip($monthAndTheirsNumbersForMens)[$splitBirthDate[1]]];
    }
    
    
    return null;
  }
  
  
  function dateOfBirth($data){
      $yearOfBirth = $data[3];
    $splitBirthDate = explode('-',$yearOfBirth);
    return current($splitBirthDate);
  }
  
  function lastDigitOfYearDigit($data){
    
    $yearOfBirth = $data[3];
    $splitBirthDate = explode('-',$yearOfBirth);
    return $splitBirthDate[2][3];
  }
  
  function getInitialsFromFirstAndMiddleName($data){
    
    $firstName = current($data);
    
    $middleName = next($data);
    return empty($middleName) ? $firstName[0].'9' : $firstName[0].$middleName[0];
  }
   

  echo driver(["John","James","Smith","01-Jan-2000","M"]);
  echo driver(["Johanna","","Gibbs","13-Dec-1981","F"]); 
  echo driver(["Andrew","Robert","Lee","02-September-1981","M"]); 
