<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="assets/img/Hola_logo-blue.png" class="img-responsive" width="70"></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <!-- <form class="navbar-form navbar-left">
                    <div class="form-group">
                    <input type="text" class="form-control" name="tag" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form> -->
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="client.php">Client</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle admin" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;Hi' <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="logout.php?logout=true"><span class="fa fa-sign-out"></span>&nbsp;Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
