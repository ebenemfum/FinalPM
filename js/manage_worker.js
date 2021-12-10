function deleteWorker(id) {
  var confirmation = confirm("Are you sure?");
  if(confirmation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('workers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_worker.php?action=delete&id=" + id, true);
    xhttp.send();
  }
}

function editWorker(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('workers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_worker.php?action=edit&id=" + id, true);
  xhttp.send();
}

function updateWorker(id) {
  var worker_name = document.getElementById("worker_name");
  var worker_email = document.getElementById("worker_email");
  var contact_number = document.getElementById("worker_contact_number");
  var worker_address = document.getElementById("worker_address");
  if(!validateName(worker_name.value, "name_error"))
    worker_name.focus();
  else if(!validateContactNumber(contact_number.value, "contact_number_error"))
    contact_number.focus();
  else if(!validateAddress(worker_address.value, "address_error"))
    worker_address.focus();
  else {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('workers_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_worker.php?action=update&id=" + id + "&name=" + worker_name.value + "&email=" + worker_email.value +"&contact_number=" + contact_number.value + "&address=" + worker_address.value, true);
    xhttp.send();
  }
}

function cancel() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('workers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_worker.php?action=cancel", true);
  xhttp.send();
}

function searchWorker(text) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('workers_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_worker.php?action=search&text=" + text, true);
  xhttp.send();
}
