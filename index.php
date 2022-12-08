<?php 
require_once __DIR__ . '/functions.php';
$charsnum = intval($_GET['charsnumber'] ?? '');
$password='';
$output='';
$specials=['!','?','&','%','$','<','>','^','+','-','*','/','(',')','[',']','{','}','@','#','_','=',];
$letters=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
$numbers=[0,1,2,3,4,5,6,7,8,9];
$repetition=$_GET['repetition'] ?? true;
$getSpecials= $_GET['chars'] ?? array();

if(count($getSpecials)==0 || count($getSpecials)==3){
  $huge_array=array_merge($specials, $letters, $numbers);
}elseif(count($getSpecials)==1 && in_array("special", $getSpecials)){
  $huge_array=$specials;
}elseif(count($getSpecials)==1 && in_array("numbers", $getSpecials)){
  $huge_array=$numbers;
  if($charsnum>10 && ($repetition=='false')){
    $charsnum=10;
  }
}elseif(count($getSpecials)==1 && in_array("letters", $getSpecials)){
  $huge_array=$letters;
}elseif(count($getSpecials)==2 && !in_array("special", $getSpecials)){
  $huge_array=array_merge($letters, $numbers);
}elseif(count($getSpecials)==2 && !in_array("numbers", $getSpecials)){
  $huge_array=array_merge($specials, $letters);
}elseif(count($getSpecials)==2 && !in_array("letters", $getSpecials)){
  $huge_array=array_merge($specials, $numbers);
  ;}

if($charsnum<8 || $charsnum>32){
  $output='Attenzione! La password deve contenere un numero di caratteri compreso fra 8 e 32';
}else{
  $password=createPsw($charsnum, $huge_array);
  $output='';
  session_start();
  $_SESSION['password'] = $password;
  header('Location: success.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <title>Strong Password Generator</title>
</head>
<body>

<div class="dc-cont">
    <h1>Strong Password Generator</h1>
    <h6 class="mt-2">Seleziona il numero e il tipo di caratteri per generare la tua nuova password</h6>
    
    <?php if(!empty($output)): ?>
    <div class="alert alert-danger p-1 text-center m-0" role="alert">
    <?php echo $output ?>
    </div>
    <?php endif; ?>
   
    <form action="" method="GET">
      <input type="number" placeholder="Lunghezza password (numero)" name="charsnumber" min="8" max="32" required class="form-control dc-input mt-4">
     
      <div class="radios dc-input d-flex flex-wrap">
        <h6 class="me-4 w-100">Ripetizione Caratteri</h6>
        <div class="form-check me-3">
          <div class="div">
            <input class="form-check-input" type="radio" value="true" name="repetition" id="flexCheckDefault" checked>
            <label class="form-check-label" for="flexCheckDefault" checked>
              Sì
            </label>
          </div>
        </div>
        <div class="form-check d-flex">
          <div class="div">
            <input class="form-check-input" type="radio" value="false" name="repetition" id="norep" >
            <label class="form-check-label" for="norep">
              No
            </label>
          </div>
          
        </div>
      </div>
      <div class="input-group-text mt-2 d-flex flex-column justify-content-start align-items-start dc-input checkboxes text-left w-40">
        <h6>Includi:</h6>
        <div class="">
          <input class="form-check-input me-2" type="checkbox" value="special" aria-label="Checkbox for following text input" name="chars[]" id="chars1">
          <label class="form-check-label me-2" for="chars1"> Caratteri Speciali</label>
        </div>
        <div class="">
          <input class="form-check-input me-2" type="checkbox" value="numbers" aria-label="Checkbox for following text input" name="chars[]" id="chars2">
          <label class="form-check-label me-2" for="chars2"> Numeri</label>
        </div>
        <div class="">
          <input class="form-check-input me-2" type="checkbox" value="letters" aria-label="Checkbox for following text input" name="chars[]" id="chars3">
          <label class="form-check-label me-2" for="chars3"> Lettere</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary my-2">Submit</button>
      <button type="reset" class="btn btn-info my-2">Reset</button>
    </form>
</div>


  
</body>
</html>