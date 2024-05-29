<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <style>
        .error {
            color: red;
            font-size: 0.875em;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Add Employee</h2>
    <form id="employeeForm" action="save.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Employee Name <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Email Address <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-6">
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="gender">Gender <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-6">
                <div>
                    <label><input type="radio" name="gender" value="Male" required> Male</label>
                    <label><input type="radio" name="gender" value="Female" required> Female</label>
                   
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="contact">Contact Number <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" id="contact" name="contact" required pattern="\d{10}" title="Please enter exactly 10 digits">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="address">Address <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-6">
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="experience">Experience <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-6">
                <input type="number" class="form-control" id="experience" name="experience" value="0" min="0" required style="width: 50%;">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="department">Department <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-6">
                <select class="form-control" id="department" name="department" required style="width: 50%;">
                    <option value="" disabled selected>Department</option>
                    <option value="HR">HR</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Sales">Sales</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="education">Education <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-6">
                <select class="form-control" id="education" name="education" required style="width: 50%;">
                    <option value="" disabled selected>Education</option>
                    <option value="Bachelor">Bachelor</option>
                    <option value="Master">Master</option>
                    <option value="PhD">PhD</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="hobby">Hobbies <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-6">
                <div>
                    <label><input type="checkbox" name="hobby[]" value="Reading"> Reading</label>
                </div>
                <div>
                    <label><input type="checkbox" name="hobby[]" value="Traveling"> Traveling</label>
                </div>
                <div>
                    <label><input type="checkbox" name="hobby[]" value="Sports"> Sports</label>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="photo">Photo <span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-md-6">
                <input type="file" class="form-control-file" id="photo" name="photo" required>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cancel</button>
        </div>
    </form>
</div>

<script>
$(document).ready(function () {
    $("#employeeForm").validate({
        rules: {
            contact: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            email: {
                required: true,
                email: true
            },
            gender: {
                required: true
            },
            "hobby[]": {
                required: true,
                minlength: 1
            }
        },
        messages: {
            contact: {
                required: "Please enter your contact number",
                digits: "Please enter only digits",
                minlength: "Contact number should be exactly 10 digits",
                maxlength: "Contact number should be exactly 10 digits"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            gender: {
                required: "Please select your gender"
            },
            "hobby[]": {
                required: "Please select at least one hobby"
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") === "gender") {
                error.appendTo(element.parents('.form-group').find('.col-md-6'));
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#email").on("change", function() {
        var email = $(this).val();
        $.ajax({
            url: "check_email.php",
            type: "POST",
            data: { email: email },
            success: function(response) {
                if (response === "exists") {
                    $("#emailExists").val("1");
                    $("#email-error").html("Email already exists. Please enter a different email.");
                } else {
                    $("#emailExists").val("0");
                    $("#email-error").empty();
                }
            }
        });
    });
});
</script>
</body>
</html>
