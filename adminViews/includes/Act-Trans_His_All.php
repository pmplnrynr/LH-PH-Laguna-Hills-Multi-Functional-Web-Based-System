<?php
require_once("connection.php");
/////////////////////////////////////////////////////////////

if(isset($_POST['AllTransaction_Rec'])){
    $records_per_page = 10; // number of records per page
    $page = isset($_POST["page"]) ? (int)$_POST["page"] : 1; // current page number
    $start_from = ($page - 1) * $records_per_page; // start from record
    $AllTransaction_table ='<table class="table">
    <thead>
      <tr>
            <th scope="col">Transaction No.</th>
            <th scope="col">Full Name</th>
            <th scope="col">Category</th>
            <th scope="col">Date</th>
      </tr>
    </thead>
    <tbody>';
    $alltransac_sql = "SELECT * FROM all_transaction ORDER BY transaction_num LIMIT $start_from, $records_per_page";
    $alltransac_result = mysqli_query($con,$alltransac_sql);

    while($row=mysqli_fetch_assoc($alltransac_result)){
        $Transaction_ID = $row['transaction_num'];
        $transaction_name =	$row['transaction_name'];
        $Category = $row['Category'];
        $transaction_date = $row['transaction_date'];
        $AllTransaction_table .= '  <tr>
                                        <td>'.$Transaction_ID.'</td>
                                        <td>'.$transaction_name.'</td>
                                        <td>'.$Category.'</td>
                                        <td>'.$transaction_date.'</td>
                                    <tr>';
                                    
}
$AllTransaction_table .= '</tbody></table>';
  // Add the pagination links
  $alltransquery = "SELECT COUNT(*) as total_records FROM `all_transaction`";
  $total_pages_result = mysqli_query($con, $alltransquery);
  $total_rows = mysqli_fetch_array($total_pages_result);
  $total_pages = ceil($total_rows["total_records"] / $records_per_page);
  $pagination = '<nav aria-label="Page navigation">
        <ul class="pagination">';
  if ($page > 1) {
    $previous = $page - 1;
    $pagination .= '<li class="page-item"><a class="page-link" onclick="Get_All_Transaction_Table(' . $previous . ')">Previous</a></li>';
  }
  for ($i = 1; $i <= $total_pages; $i++) {
    $pagination .= '<li class="page-item"><a class="page-link" onclick="Get_All_Transaction_Table(' . $i . ')">' . $i . '</a></li>';
  }
  if ($page < $total_pages) {
    $next = $page + 1;
    $pagination .= '<li class="page-item"><a class="page-link" onclick="Get_All_Transaction_Table(' . $next . ')">Next</a></li>';
  }
  $pagination .= '</ul></nav>';

  // Concatenate the pagination links and the table
  $AllTransaction_table=  $AllTransaction_table . $pagination;

  echo $AllTransaction_table;
  
}

else {
    echo 'Data Not Found ';
  }

?>