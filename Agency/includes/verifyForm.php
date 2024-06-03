
<!DOCTYPE html>
<html>
<head>
    <title>Verify Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<script>
    function goBack() {
        // Use JavaScript to go back to the previous page
        window.history.back();
    }
    </script>

<?php
    session_start();
    ?>
    <div class='error'>
        <?php
        if (isset($_POST['ERRORS'])){
         echo $_SESSION['ERRORS']['name'];
         echo $_SESSION['ERRORS']['mail'];
         echo $_SESSION['ERRORS']['scripterror'];
        }
         ?>
    </div>
    <form  action="insert.php" method="POST" enctype="multipart/form-data">
    <div class="container mt-5">
        <h1 class="mb-4">Agency Information</h1>
        <table class="table table-bordered">
        <hr>
                <span class="h5 mb-3 font-weight-normal text-muted text-center">Basic details</span>
            <tr>
                <th >Agency Name</th>
                <td><?php echo $_SESSION['AgencyName']; ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo $_SESSION['Address']; ?></td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td><?php echo $_SESSION['ContactNumber']; ?></td>
            </tr>
            <tr>
                <th>Email ID</th>
                <td><?php echo $_SESSION['EmailID']; ?></td>
            </tr>
            <tr>
                <th>State</th>
                <td><?php echo $_SESSION['State']; ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?php echo $_SESSION['City']; ?></td>
            </tr>
        </table>
        <table class="table table-bordered">
        <hr>
                <span class="h5 mb-3 font-weight-normal text-muted text-center">Contact details</span>
            <tr>
                <th>Person 1</th>
                <td><?php echo $_SESSION['Name1']; ?></td>
            </tr>
            <tr>
                <th>Designation 1</th>
                <td><?php echo $_SESSION['Designation1']; ?></td>
            </tr>
            <tr>
                <th>Contact Number 1</th>
                <td><?php echo $_SESSION['CtctNumber1']; ?></td>
            </tr>
            <?php 
                if (isset($_SESSION['Name2'])){
                    ?>
                        <tr>
                            <th>Person 2</th>
                            <td><?php echo $_SESSION['Name2']; ?></td>
                        </tr>
                        <tr>
                            <th>Designation 2</th>
                            <td><?php echo $_SESSION['Designation2']; ?></td>
                        </tr>
                        <tr>
                            <th>Contact Number 2</th>
                            <td><?php echo $_SESSION['CtctNumber2']; ?></td>
                        </tr>
                    <?php
                }

                if (isset($_SESSION['Name3'])){
                    ?>
                        <tr>
                            <th>Person 3</th>
                            <td><?php echo $_SESSION['Name3']; ?></td>
                        </tr>
                        <tr>
                            <th>Designation 3</th>
                            <td><?php echo $_SESSION['Designation3']; ?></td>
                        </tr>
                        <tr>
                            <th>Contact Number 3</th>
                            <td><?php echo $_SESSION['CtctNumber3']; ?></td>
                        </tr>
                    <?php
                }
            ?>

        </table>
                    <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="form-outline">
                            <input type="file" id="document" name="document" class="form-control form-control-lg" accept=".pdf" required/>
                            <label class="form-label " style="font-weight: bold; for="document">Upload Rate document (PDF only)</label>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-4  ">
                        <div class="form-outline">
                        <button type="button" class="btn btn-primary" onclick="goBack()">Edit</button>
                        </div>
                      </div>
                      <div class="col-md-6 mb-4  ">
                        <div class="form-outline">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </div>
    </div>
</form>
</body>
</html>

