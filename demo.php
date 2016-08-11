<?php
/* ====================== INFO ========================
Frame:                          340 x 510
Instagram size:             306 x 306
Footer Picture size:        340x140
====================================================*/

// ================== CONFIGURATION ===================
$loop=FALSE;                                                                    // ==== The script will run forever
if ($loop) set_time_limit(0);                                               // ~ No time execution limit
    else error_reporting(0);                                                // ~ No error displaying on web browser

$tag="";                                                                                // ==== Tag to search with
$searchByLocation=FALSE;                                            // Locations ---> Get LAT, LNG ---> query Instagram API
$searchByLocation_ID=TRUE;                                      // NOTE: If $searchByLocation == TRUE then this value is ignored
$footer_picture_name="creature_seattle";        // File type must be JPG
$font = 'Fonts/GeosansLight.ttf';

$footerDir="Footer_Pictures/";
$srcDir="Original_Instagram_Pictures/";                         // ==== Path to Folder which stores original pictures from Instagram
$dstDir="Completed_Pictures/seattle";                                       // ==== Path to Folder which stores the final pictures after combining
$interval=30;                                                                       // ==== Interval time (in seconds) - should be >= 20

$clientId="c91b5f8b136c4342805fd2a94a464fbe";       // ==== Instagram Client ID (need to register with Instagram to get it)
if ($tag==""){
    $tag=$_GET['tag'];                                                          // ~ If there is no tag value here then get it from Web browser
    $searchByLocation=$_GET['searchByLocation'];
    $searchByLocation_ID=$_GET['searchByLocation_ID'];
}
$ignoredImageArray=array(0,0,0,0);                                     // don't create new files if they have already been processed

//====================================================
?>
<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">

    <title>HOLA!</title>
</head>

<!-- Required scripts -->
<script type="text/javascript" src="assets/js/vendor/rsvp-3.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/vendor/sha-256.min.js"></script>
<script type="text/javascript" src="assets/js/vendor/qz-tray.js"></script>

<!-- Page styling -->
<script src="assets/js/vendor/jquery-1.11.3.min.js"></script>
<script src="assets/js/vendor/bootstrap.min.js"></script>
<script src="assets/js/vendor/icheck.min.js"></script>
<!-- <link rel="stylesheet" href="https://demo.qz.io/css/font-awesome.min.css" /> -->
<!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css" /> -->
<link rel="stylesheet" href="assets/css/icheck-square/green.css" />
<link rel="stylesheet" href="assets/css/style.css" />


<body id="qz-page" role="document">
<?php include "incl/header.php"; ?>
<div id="qz-alert" style="position: fixed; width: 60%; margin: 0 4% 0 36%; z-index: 900;"></div>
<div id="qz-pin" style="position: fixed; width: 30%; margin: 0 66% 0 4%; z-index: 900;"></div>

<main>
<div class="container-fluid" role="main">

    <div class="row spread">
        <div class="col-md-3">
            <div id="qz-connection" class="panel panel-default">
                <div class="panel-heading">
                    <button class="close tip" data-toggle="tooltip" title="Launch QZ" id="launch" href="#" onclick="launchQZ();" style="display: none;">
                        <i class="fa fa-external-link"></i>
                    </button>
                    <h3 class="panel-title">
                        Connection: <span id="qz-status" class="text-muted" style="font-weight: bold;">Unknown</span>
                    </h3>
                </div>

                <div class="panel-body">
                    <div class="btn-toolbar">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" onclick="startConnection();">Connect</button>
                            <button type="button" class="btn btn-default" onclick="endConnection();">Disconnect</button>
                            <button type="button" class="btn btn-default" onclick="listNetworkInfo();">List Network Info</button>
                        </div>
                    </div>
                </div>
            </div>

            <hr />

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Printer</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="printerSearch">Search:</label>
                        <input type="text" id="printerSearch" value="zebra" class="form-control" />
                    </div>

                    <button type="button" class="btn btn-default btn-sm" onclick="findPrinter($('#printerSearch').val(), true);">Find Printer</button>
                    <button type="button" class="btn btn-default btn-sm" onclick="findDefaultPrinter(true);">Find Default Printer</button>
                    <button type="button" class="btn btn-default btn-sm" onclick="findPrinters();">Find All Printers</button>

                    <hr />
                    <div class="form-group">
                        <label>Current printer:</label>
                        <div id="configPrinter">NONE</div>
                    </div>
                    <div class="form-group">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default btn-sm" onclick="setPrinter($('#printerSearch').val());">Set To Search</button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#askFileModal">Set To File</button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#askHostModal">Set To Host</button>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="col-md-9">
            <div class="row">

                <?php if (!$tag){ ?>

                <form class="col-md-12">
                    <div class="row">
                        <h3>Search and Generate images with Tag: </h3>
                        <div class="input-field col s12">
                            <input name="tag" placeholder="Your Hastag" type="text" id="hashtag" />
                            <label for="hashtag">Hastag</label>

                            <p>
                                <input type="checkbox" name="searchByLocation" id="searchByLocation" />
                                <label for="searchByLocation">Search By Location</label>
                            </p>
                            <p>
                                <input type="checkbox" name="searchByLocation_ID" id="searchByLocation_ID" />
                                <label for="searchByLocation_ID">Search By Location ID (If Search By Location is checked. This will be ignored)</label>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                             <button class="btn btn-default" type="submit" name="action">Submit
                                <i class="material-icons right">send</i>
                             </button>
                        </div>
                    </div>
                </form>

<?php } else {
    while (TRUE){
        // GET THE URL
        // $url="https://api.instagram.com/v1/tags/".$tag."/media/recent?client_id=".$clientId; // SEARCH BY TAGS - Instagram API tags endpoint
        $url = "https://api.instagram.com/v1/tags/".$tag."/media/recent?access_token=2988019436.c91b5f8.93fd1389ab174df8a8e6a50711912aed"; // SEARCH BY TAGS - Instagram API tags endpoint
        if ($searchByLocation){
            $geoCodingUrl="http://maps.google.com/maps/api/geocode/json?address=".$tag."&sensor=false";
            $json=file_get_contents($geoCodingUrl);
            $geoCodingContent=json_decode($json);
            $lat=$geoCodingContent->results[0]->geometry->location->lat;
            $lng=$geoCodingContent->results[0]->geometry->location->lng;
            if ((!$lat)||(!$lng)) die ("<br>WRONG LOCATION ! WE CANNOT GET LATITUDE AND LONGITUDE FOR THIS !");
            $url="https://api.instagram.com/v1/media/search?lat=".$lat."&lng=".$lng."&client_id=".$clientId;
        } else if ($searchByLocation_ID){
            $url="https://api.instagram.com/v1/locations/".$tag."/media/recent?client_id=".$clientId;
        }

        // GET 4 IMAGES FROM ABOVE URL:
        $jsonContent=file_get_contents($url);
        $content = json_decode($jsonContent);

        $imgArr=array();
            $realImageArray=array();
        $userArr=array();
        $avatarArr=array();
            $realAvatarArray=array();
        $timeArr=array();
        for ($i=0;$i<4;$i++){
            $imgArr[]=$content->data[$i]->images->low_resolution->url;
            $userArr[]=$content->data[$i]->user->username;
            $avatarArr[]=$content->data[$i]->user->profile_picture;
                 $tmpAvatarWithoutResize=imagecreatefromstring(file_get_contents($avatarArr[$i]));
                 $resize_image = imagecreatetruecolor(30, 30);
                 imagecopyresampled($resize_image, $tmpAvatarWithoutResize, 0, 0, 0, 0, 30, 30, 150, 150);
                $realAvatarArray[] =$resize_image;
            $UnixTime=$content->data[$i]->caption->created_time;
            $timeArr[]=date('Y-m-d', $UnixTime);
        }

        // CHECK IF IMAGE EXISTENT -- AND CREATE IMAGE OBJECT OF INSTAGRAM PICTURES
        $oldImageNameArray = glob($srcDir . "*.jpg");
        for ($i=0;$i<count($imgArr);$i++){
            $existent=FALSE;
            $newMd5=md5($imgArr[$i]);
            foreach($oldImageNameArray as $oldMd5){
                $oldMd5=substr($oldMd5,strpos($oldMd5,"/")+1);
                $oldMd5=substr($oldMd5,0,strpos($oldMd5,"."));
                if ($oldMd5==$newMd5){
                    $existent=TRUE;
                    break;
                }
            }
            if ($existent){
                $ignoredImageArray[$i]=TRUE;                        //create if not originally downloaded in source folder
                // $realImageArray[$i] = imagecreatefromjpeg($srcDir."/".$newMd5.".jpg");  //create if not in processed folder
            } else {
                $realImageArray[$i] = imagecreatefromstring(file_get_contents($imgArr[$i]));
                imagejpeg($realImageArray[$i], $srcDir."/".$newMd5.'.jpg');
            }
        }


        // ==================== CREATE IMAGE FILES ==================
        $originFrame = imagecreatefromstring(file_get_contents("frame.jpg"));

        for ($i=0;$i<4;$i++){
            if ($ignoredImageArray[$i]) continue;  //ignore image if in source
            $frame=$originFrame;            // Clone new frame

            // INSERT INSTAGRAM
            imagecopymerge($frame, $realImageArray[$i], 17, 60, 0, 0, 306, 306, 100); //Params =(background img, img upper, BG x, BG y, Upper X-Y-W-H, alpha)

            // INSER USERNAME
            $username_img = imagecreatetruecolor(200, 30);
            $white = imagecolorallocate($username_img, 255, 255, 255);
            $grey = imagecolorallocate($username_img, 128, 128, 128);
            $black = imagecolorallocate($username_img, 0, 0, 0);
            $blue = imagecolorallocate($username_img, 54, 35, 147);
            imagefilledrectangle($username_img, 0, 0, 200, 30, $white);
            $text = $userArr[$i];
            // imagettftext($username_img, 14, 0, 11, 21, $white, $font, $text); // Add some shadow to the text. IMG - SIZE -ANGLE - X - Y - COLOR- FONT - CONTENT
            imagettftext($username_img, 17, 0, 10, 20, $black, $font, $text); // Add the text
            imagecopymerge($frame, $username_img, 40, 22, 0, 0, 200, 25, 100);

            // INSERT TIME STAMP
            $time_img=imagecreatetruecolor(90, 30);
            imagefilledrectangle($time_img, 0, 0, 90, 30, $white);
            $time=$timeArr[$i];
            imagettftext($time_img, 11, 0, 11, 21, $black, $font, $time); // Add the text
            imagecopymerge($frame, $time_img, 245, 22, 0, 0, 90, 25, 100);

            // INSERT AVATAR
            imagecopymerge($frame, $realAvatarArray[$i], 17, 20, 0, 0, 30, 30, 100);

            // INSERT FOOTER PICTURE
            $footer_pictures=imagecreatefromjpeg($footerDir.$footer_picture_name.".jpg");
            imagecopymerge($frame, $footer_pictures, 0, 370, 0, 0, 340, 140, 100);

             # Save the image to a file
            imagejpeg($frame, $dstDir."/".md5($imgArr[$i]).".jpg");
        }
        if (!$loop) break;
            else sleep($interval);
    }

    // =========== OUTPUT TO WEB BROWSER ============
    ?>
                <div class="right-side">
                    <button type="button" class="btn btn-default" onclick="getAllImage();">Get All IMage</button>
                    <button type="button" class="btn btn-default" onclick="printImage();">Print Image</button>
                    <button type="button" class="btn btn-default" onclick="printCheckedImage();">Print Checked</button>
                </div>
                <div class="polaroid-wrapper" id="polaroid-wrapper">
                    <form>
                    <ul>
                        <?php
                        echo "";
                        for ($i=0;$i<4;$i++)
                            echo "
                            <li>
                                <input type='checkbox' class='checkboxes' name='pol-".$i."' id='pol-".$i."' value='".md5($imgArr[$i])."' >
                                <img class='printed-image' data-name='".md5($imgArr[$i])."' src='".$dstDir."/".md5($imgArr[$i]).".jpg"."'/>
                            </li>";
                        echo "";
                        ?>
                    </ul>
                    </form>
                </div>
    <?php
     # Output straight to the browser.
     //imagepng($image);
}
?>
            </div>
        </div>
    </div> <!-- row spread -->
</div> <!-- container -->
</main>
    <script type="text/javascript" src="assets/js/app.js"></script>
</body>



</html>
