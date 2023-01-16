<?php

include ('connection.php');


    if(isset($_POST['mapDataSend'])){
    $sql= "SELECT * FROM `lot_information`";
    $result=mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $Lot_ID=$row['Lot_ID'];
        $Block=$row['Block'];
        $Lot=$row['Lot'];
        $Street=$row['Street'];
        $Status=$row['Status'];
        $Area=$row['Area'];
        $Price=$row['Price'];
        $Remarks=$row['Remarks'];
        $table='
        <div class="panel-content" id="panel">
        <h3>LOT INFORMATION</h3>
        <div class="input-group">
                <span class="input-group-text">Block</span>
                <input type="text" id="block" class="form-control" value ="'.$Block.'" disabled>
                <span class="input-group-text">Lot</span>
                <input type="text" id="lot" class="form-control" value ="'.$Lot.'"disabled>
        </div>
        <div class="input-group">
                <span class="input-group-text">Street</span>
                <input type="text" id="street" class="form-control" value ="'.$Street.'" disabled>
        </div>
        <div class="input-group">
                <span class="input-group-text">Status</span>
                <input type="text" id="status" class="form-control" value ="'.$Status.'" disabled>
        </div>
        <div class="input-group">
                <span class="input-group-text">Area per Sqm</span>
                <input type="text" id="area-per-sqm" class="form-control" value ="'.$Area.'" disabled>
        </div>
        <div class="input-group">
                <span class="input-group-text">price</span>
                <input type="text" id="price" class="form-control" value ="'.$Price.'" disabled>
        </div>

        <div class="input-group">
                <span class="input-group-text">Remarks</span>
                <textarea class="form-control" id="remarks" disabled>'.$Remarks.'</textarea>
        </div>
        <button class="edit-info" type="button"><i class="fa-solid fa-pen"></i> Edit Information</button>
</div>';
    }
    echo $table;
}
?>    