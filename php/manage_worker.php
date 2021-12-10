<?php
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "DELETE FROM Workers WHERE ID = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
    		showWorkers(0);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showWorkers($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $name = ucwords($_GET["name"]);
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];
      $address = ucwords($_GET["address"]);
      updateWorker($id, $name, $email, $contact_number, $address);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showWorkers(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchWorker(strtoupper($_GET["text"]));
  }

  function showWorkers($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM Workers";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['ID'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showWorkerRow($seq_no, $row);
      }
    }
  }

  function showWorkerRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['ID'] ?></td>
      <td><?php echo $row['NAME']; ?></td>
      <td><?php echo $row['EMAIL']; ?></td>
      <td><?php echo $row['CONTACT_NUMBER']; ?></td>
      <td><?php echo $row['ADDRESS']; ?></td>
      <td>
        <button href="" class="btn btn-info btn-sm" onclick="editWorker(<?php echo $row['ID']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteWorker(<?php echo $row['ID']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    </tr>
    <?php
  }

function showEditOptionsRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['ID'] ?></td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['NAME']; ?>" placeholder="Name" id="Worker_name" onkeyup="validateName(this.value, 'name_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="email" class="form-control" value="<?php echo $row['EMAIL']; ?>" placeholder="Email" id="Worker_email" onblur="validateContactNumber(this.value, 'email_error');">
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['CONTACT_NUMBER']; ?>" placeholder="Contact Number" id="Worker_contact_number" onblur="validateContactNumber(this.value, 'contact_number_error');">
      <code class="text-danger small font-weight-bold float-right" id="contact_number_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="Address" id="Worker_address" onblur="validateAddress(this.value, 'address_error');"><?php echo $row['ADDRESS']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="address_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateWorker(<?php echo $row['ID']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updateWorker($id, $name, $email, $contact_number, $address) {
  require "db_connection.php";
  $query = "UPDATE Workers SET NAME = '$name', EMAIL = '$email', CONTACT_NUMBER = '$contact_number', ADDRESS = '$address' WHERE ID = $id";
  $result = mysqli_query($con, $query);
  if(!empty($result))
    showWorkers(0);
}

function searchWorker($text) {
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM Workers WHERE UPPER(NAME) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showWorkerRow($seq_no, $row);
    }
  }
}

?>
