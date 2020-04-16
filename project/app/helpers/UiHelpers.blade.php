<?php

 /////////////////////////////////////////// form builder ///////////////////////////////
        // build input form
  function inputForm($lable,$inputAtrrs,$errors){
    echo "
    <div class='form-group'>
    <label class='col-sm-2 control-label'>".$lable."</label>

    <div class='col-sm-10'>
      <input ";
      foreach ($inputAtrrs as $key => $Atrrvalue) {
          echo " ".$key." = '".$Atrrvalue."'";
      }

      echo" >
    </div>";

    foreach($errors as $error){
      echo "
           <p class='invalid-feedback text-center' role='alert' style='color: red;'>
            <strong>".$error."</strong>
           </p>
      ";
    }

    echo "</div>
    ";
    }


/////////////////////////////////////////// form builder ///////////////////////////////
// build input With Button form
function inputFormWithBtn($lable,$inputAtrrs,$errors){
    echo "
    <div class='form-group'>
    <label class='col-sm-2 control-label'>".$lable."</label>

    <div class='col-sm-10' style='position: relative'>
      <input ";
    foreach ($inputAtrrs as $key => $Atrrvalue) {
        echo " ".$key." = '".$Atrrvalue."'";
    }

    echo" >
    <button class='btn btn-success input-btn'>".trans('main.save')."</button>
    </div>";

    foreach($errors as $error){
        echo "
           <p class='invalid-feedback text-center' role='alert' style='color: red;'>
            <strong>".$error."</strong>
           </p>
      ";
    }

    echo "</div>
    ";
}

               // build select form
    function selectform($lable,$inputAtrrs,$value,$databind,$errors){
      echo "
      <div class='form-group'>
      <label class='col-sm-2 control-label'>".$lable."</label>

      <div class='col-sm-10'>
       <select ";

       foreach ($inputAtrrs as $key => $Atrrvalue) {
        echo " ".$key." = '".$Atrrvalue."'";
       }

        echo" >";
        echo '<option>-- '.trans('main.select').' '.$lable.' --</option>';
        foreach($databind as $data ){
         $selected = "";
         if($value == $data['id']){
           $selected = "selected";
         };
         echo "<option value='".$data['id']."' ".$selected." > ".$data['name']." </option>";

        };
        echo"
       </select>
      </div>";
      foreach($errors as $error){
        echo "
             <p class='invalid-feedback text-center' role='alert' style='color: red;'>
              <strong>".$error."</strong>
             </p>
        ";
      };
      echo"
      </div>
      ";
      }


      // Input File Image
function inputFile($lable,$fileLabel,$inputAtrrs,$errors){
    echo "
    <div class='form-group'>
    <label class='col-sm-2 control-label'>".$lable."</label>

    <div class='col-sm-10'>
        $fileLabel
      <input ";
      foreach ($inputAtrrs as $key => $Atrrvalue) {
          echo "".$key." = '".$Atrrvalue."'";
      }

      echo" >
    </div>";

    foreach($errors as $error){
        echo "
           <p class='invalid-feedback text-center' role='alert' style='color: red;'>
            <strong>".$error."</strong>
           </p>
      ";
    }

    echo "</div>
    ";
    }

 ////////////////////////////////////// filter builder //////////////////////////////
      // filtration input form


  function filterInputForm($inputAtrrs,$colwidth){
    echo "
    <div class='form-group'>
    <div class='col-sm-".$colwidth."'>
      <input ";
      foreach ($inputAtrrs as $key => $Atrrvalue) {
          echo " ".$key." = '".$Atrrvalue."'";
      }

      echo" >
    </div>";

    echo "</div>
    ";
    }


    //  filter select form input

     function filterSelectForm($inputAtrrs,$colwidth,$databind,$inputValue){
      echo "
      <div class='form-group'>

      <div class='col-sm-".$colwidth."'>
       <select ";

       foreach ($inputAtrrs as $key => $Atrrvalue) {
        echo " ".$key." = '".$Atrrvalue."'";
       }

       echo" > <option value=''>-- ".trans('main.select')." --</option>";
       foreach($databind as $data ){

        $selected = "";
        if($inputValue == $data['id']){
          $selected = "selected";
        };

         echo "<option value='".$data['id']."' ".$selected." > ".$data['name']." </option>";
        };
        echo"
       </select>
      </div>";

      echo"
      </div>
      ";
      }
