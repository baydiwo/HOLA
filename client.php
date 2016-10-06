<?php
require_once("login/session.php");

include "incl/head.php";
include "incl/header.php";

$status = $_GET['r'];
if ($status) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            displayMessage("<strong>Save</strong>");
        });
    </script>
<?php }
?>
<main>
<div class="container-fluid" role="main">

    <div class="row spread">
        <?php include 'incl/sidebar.php'; ?>

        <div class="col-md-9">
            <div id="qz-alert"></div>
            <div id="qz-pin" style="position: fixed; width: 30%; margin: 0 66% 0 4%; z-index: 900;"></div>
            <form method="post" action="saveclient.php">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Client info</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input name="clientName" class="form-control" placeholder="Client Full Name" type="text" id="clientName" />
                        </div>
                        <div class="form-group">
                            <input name="orderDate" class="form-control" placeholder="Date" type="date" id="date" />
                        </div>
                        <div class="form-group">
                            <input name="hashtag" class="form-control" placeholder="Hashtag" type="text" id="hashtag" />
                        </div>
                        <button class="btn btn-default" type="submit" name="save">Save
                            <i class="fa fa-disk"></i>
                        </button>
                        <button class="btn btn-default" type="submit" name="savecontinue">Save &amp; Continue
                            <i class="fa fa-disk"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
<?php include "incl/footer.php" ?>
