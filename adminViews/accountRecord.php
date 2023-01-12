<div class="record-account">
    <div class="record-title">
        <h1>ACCOUNT RECORDS</h1>
    </div>
    <section class="record-content accountContent"><!--SECTION NG BUONG CONTENT-->
        <div class=" input-group input-group-sm mb-3 search-add-area">
            <input type="text" class="form-control" id="search-account-admin" placeholder="Search Here....">
            <button id="add-account"><a name="AddAdminAccount" data-bs-toggle="modal" data-bs-target="#addAdminAccount"><i class="fa-solid fa-user-plus"></i> Add New Account</a></button> <br><br>
        </div>

        <div id="display-admin"></div>
    </section>
</div>


<!-- Add Admin Modal -->
<div class="modal fade" id="addAdminAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="addUserModalLabel">Add Admin User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" placeholder="Enter first name" required>
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" placeholder="Enter last name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email address">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username">
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pass" placeholder="Enter password" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="submit-btn" onclick="addAdmin()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- update Modal-->
<div class="modal fade" id="updateAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="updateusername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="updateusername" disabled>
                </div>
                <div class="mb-3">
                    <label for="updatefirstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="updatefirstname">
                </div>
                <div class="mb-3">
                    <label for="updatelastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="updatelastname">
                </div>
                <div class="mb-3">
                    <label for="updateemail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="updateemail">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="submit-btn" onclick="updateInfo()">Update</button>
                <input type="hidden" id="hiddendata">
            </div>
        </div>
    </div>
</div>
</div>
<!-- update Modal-->
<div class="modal" id="deleteAdminModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-triangle-exclamation"></i> Warning!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you user you want to delete this account?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="deleteUser()">Delete</button>
            </div>
        </div>
    </div>
</div>



<!--SCRIPT FOR add Admin-->
<script>
    $(document).ready(function() {
        displayData();
    });

    function displayData() {
        var displayData = "true";
        $.ajax({
            url: 'adminViews/includes/displayData.php',
            type: 'post',
            data: {
                displaySend: displayData
            },
            success: function(data, status) {
                $('#display-admin').html(data);
            }
        });
    }

    function addAdmin() {
        var fname = $('#firstname').val();
        var lname = $('#lastname').val();
        var email = $('#email').val();
        var user = $('#username').val();
        var pass = $('#pass').val();

        $.ajax({
            url: "adminViews/includes/Act-AddAdmin.php",
            type: 'post',
            data: {
                fnameSend: fname,
                lnameSend: lname,
                emailSend: email,
                userSend: user,
                passSend: pass
            },
            success: function(data, status) {
                $('#addAdminAccount').modal("hide");
                displayData();
            }

        });
    }

    function deleteModal(){
        
        $('#deleteAdminModal').modal("show");
    }
    function deleteUser(deleteid) {
        $.ajax({
            url: 'adminViews/includes/Act-DeleteAdmin.php',
            type: 'post',
            data: {
                deleteSend: deleteid
            },
            success: function(data, status) {
                displayData();
            }
        })
    }

    function getDetails(updateid) { // to show the current data
        $('#hiddendata').val(updateid);

        $.post('adminViews/includes/Act-UpdateAdmin.php', {
            updateid: updateid
        }, function(data, status) {
            var admin = JSON.parse(data);
            $('#updatefirstname').val(admin.admin_fname);
            $('#updatelastname').val(admin.admin_lname);
            $('#updateemail').val(admin.admin_email);
            $('#updateusername').val(admin.admin_username);
        });

        $('#updateAdminModal').modal("show");
    }

    function updateInfo() { // updating the data
        var updateusername = $('#updateusername').val();
        var updatefirstname = $('#updatefirstname').val();
        var updatelastname = $('#updatelastname').val();
        var updateemail = $('#updateemail').val();
        var hiddendata = $('#hiddendata').val();

        $.post('adminViews/includes/Act-UpdateAdmin.php', {
                updatefirstname: updatefirstname,
                updatelastname: updatelastname,
                updateemail: updateemail,
                updateusername: updateusername,
                hiddendata: hiddendata
            },
            function(data, status) {

                $('#updateAdminModal').modal('hide');
                displayData();
            });
    }
</script>