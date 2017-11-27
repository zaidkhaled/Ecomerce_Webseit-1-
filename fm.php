<?php
 
ob_start();

session_start();

include "init.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    
//   $do = $_POST['ajxdo']; 
//    json_encode($_POST);
//    var_dump($_POST);
//    echo "<br><br><br><br>";
//    var_dump($_FILES);
//     echo "<br><br><br><br>";
//       var_dump($_POST);
//    foreach($_FILES as $file){
//        var_dump($file);
//        echo "<br><br><br>";
//    }
   
//        var_dump($_POST);
//        echo "<br>";
    
    $data = [
        "out" => $_POST,
        "out1" => "dfdf"
    ];
      
      echo  json_encode($data);

//    echo "HIHIHI";
//    $data_required = !empty($_POST['ajxdata_required']) ?  $_POST['ajxdata_required'] : 'no_required';  
//    
//    echo $data_required;
//           $count = count($_FILES);
//    
//          echo $count . "<br>";
//              
//              var_dump($_FILES);
//    
//          echo "<br><br><br><br><br>";
//    
//          foreach ($_FILES as $value => $name){
//               
//               $foto = str_replace(".", "_", reset($name));
//              
//              echo $foto;
//         }
//            echo $count ."<br>";
        
//           $fotoAllowedExtensions = ["png", "jpg", "jpeg", "gif"];
//
//           $asutiv_arr[] = "";
//         
//           for ($i=0; $i < $count ; $i++ ){
//               
//               $fotoName = $_FILES['foto' . $i]['name'];
//               $fotoSize = $_FILES['foto' . $i]['size'];
//               $fotoTmp  = $_FILES['foto' . $i]['tmp_name'];
//               $fotoType = $_FILES['foto' . $i]['type'];    
//               
//               $value = explode(".", $fotoName);
//
//               $fotoextension = strtolower(end($value));
//                      
//               
////                $fotosTmp[] = $fotoTmp;
//               
//                $randName = rand(0, 100000). "_" . $fotoName;
//               
//                $asutiv_arr[$fotoTmp]  = $randName ;

//                echo $fotoTmp."<br>";
        
//    $fotos =[];
//       foreach ($asutiv_arr as $tmp => $imgName){
//          $fotos[] = $imgName;
//       }
//    
//      $explodefotos= explode("," ,$fotos);
    
//    $serialized_array = serialize($fotosName); 
//    $unserialized_array = unserialize($serialized_array); 
//    
//             foreach($fotosTmp as $fotoTmp){
//                   $i = 0;
//                   move_uploaded_file($fotoTmp, "uplaodedFiles/userFotos/" . $fotosName[0]);
//                   $i++;
//               }
    
//    foreach($fotosTmp as $tmp){
//        echo $tmp."<br>";
//    };
    
    
    
//    
//    $count = count($_FILES);
//    
//        echo $count . "<br>";
//    
//        for ($i=0; $i < $count ; $i++ ){
//        
//    
//           $fotoName = $_FILES['foto' . $i]['name'];
//           $fotoSize = $_FILES['foto' . $i]['size'];
//           $fotoTmp  = $_FILES['foto' . $i]['tmp_name'];
//           $fotoType = $_FILES['foto' . $i]['type'];    
//            
////                echo  "foto" .$i ." = ".$fotoName. $i ."<br>" ;
//            
//                $foto = rand(0, 100000). "_" . $fotoName;
//            
//                move_uploaded_file($fotoTmp, "../uplaodedFiles/itemsFotos/" . $foto);
//            echo "alles gut " . $i . "<br>";
//        }

}

