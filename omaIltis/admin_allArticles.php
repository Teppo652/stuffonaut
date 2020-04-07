<?php
session_start();
include('admin_functions.php');
$conn = getDBConn('no');

$thisPage = "omaIltis_articles.php";
$nextPage = "omaIltis_article.php";
$table = "omaIltis_articles";

$statusOptions = 'idea,assigned,inWriting,waitingForMedia,inProofReading,published,onHold,cancelled,inArchive';

require_once('header.php'); 
?>


<!-- page content -->
        <div class="wrapper">
            <div class="container-fluid">

                

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">All articles</h4>
<?php
// --------------------- BEGIN CODE ------------------------

// activate or deactivate
$id = '';
$action = '';
$activeStatus = '';
$quickDelete = '';
if (isset($_GET['action']))
{
    if (isset($_GET['id']))
    {
        $action = filter_input( INPUT_GET, 'action', FILTER_SANITIZE_URL );
        $id = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_URL );
        if($action =='deactivate') { $activeStatus = '0'; echo '<br><div style="color:green">Item Deactivated.</div>'; }
        if($action =='activate') { $activeStatus = '1'; echo '<br><div style="color:green">Item Activated.</div>'; }
        if($action =='quickDelete') { $quickDelete = '1'; echo '<br><div style="color:green">Item Deleted.</div>'; }
        if($activeStatus != '')
        {
            $sql = 'UPDATE ' . $table . ' SET active=' . $activeStatus . ' WHERE id=' . $id;
            //echo '<br>SQL: ' . $sql . '<br>';
            if ($conn->query($sql) != TRUE) { echo 'Error changing active status' . $conn->error; }
        }
        if($quickDelete != '')
        {
            $sql = 'DELETE FROM ' . $table . ' WHERE id=' . $id;
            //echo '<br>SQL2: ' . $sql . '<br>';
            if ($conn->query($sql) != TRUE) { echo 'Error quickdeleting item' . $conn->error; }
        }
    }
}

$isDebug = ''; if(isset($_GET['poiu1234'])) { $isDebug = '1'; }
echo '<div class="container-fluid"><div class="row"><div class="col-md-12 col-lg-12">';

// pagination init
$firstText = "Alkuun";
$prevText = "Edellinen";
$nextText = "Seuraava";
$lastText = "Loppuun";
$limit = 20;
$page = 1;
if (isset($_GET['p'])) { $page = filter_input( INPUT_GET, 'p', FILTER_SANITIZE_URL ); }
$start=($page-1)*$limit;
$totalItems = mysqli_num_rows(mysqli_query($conn,  "SELECT * FROM " . $table));
$totalPages = $totalItems/$limit;
// SELECT
$sql = "SELECT * FROM " . $table . " ORDER BY id LIMIT " . $start . ", " . $limit;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
// pagination
echo showPagination($thisPage, $firstText, $prevText, $nextText, $lastText, $totalPages, $start, $page, $limit);
    echo '<table class="table table-hover"><thead><tr>';
        // echo "<th>" . "Country Id"         . "</th>";
        // echo "<th>" . "Lang Id"            . "</th>";
        // echo "<th>" . "Reporter User Id"    . "</th>";
        // echo "<th>" . "Proof Reader User Id" . "</th>";
        // echo "<th>" . "Cat1"              . "</th>";
        // echo "<th>" . "Cat2"              . "</th>";
        echo "<th>" . "Publish Date"       . "</th>";
        // echo "<th>" . "Source Medias"      . "</th>";
        // echo "<th>" . "Source Urls"        . "</th>";
        // echo "<th>" . "Klick Title"        . "</th>";
        echo "<th>" . "Title"             . "</th>";
        // echo "<th>" . "Images"            . "</th>";
        // echo "<th>" . "Video"             . "</th>";
        echo "<th>" . "Article"           . "</th>";
        echo "<th>" . "Status"            . "</th>";
        echo "<th>" . "Active"            . "</th>";
    echo "<th>&nbsp;</th>";
    echo "<th>&nbsp;</th>";
    echo "</tr></thead>";

    echo "<tbody>"; 
    while($row = mysqli_fetch_assoc($result))
    {
        // echo "<tr>";
        // echo "<td>" . $row["countryId"]         . "</td>";
        // echo "<td>" . $row["langId"]            . "</td>";
        // echo "<td>" . $row["reporterUserId"]    . "</td>";
        // echo "<td>" . $row["proofReaderUserId"] . "</td>";
        // echo "<td>" . $row["cat1"]              . "</td>";
        // echo "<td>" . $row["cat2"]              . "</td>";
        echo "<td>" . displayDate($row["publishDate"]) . "</td>";
        // echo "<td>" . $row["sourceMedias"]      . "</td>";
        // echo "<td>" . $row["sourceUrls"]        . "</td>";
        // echo "<td>" . $row["klickTitle"]        . "</td>";
        echo "<td>" . $row["title"]             . "</td>";
        // echo "<td>" . $row["images"]            . "</td>";
        // echo "<td>" . $row["video"]             . "</td>";
        echo "<td>" . $row["article"]           . "</td>";
        echo "<td>" . getSimpleDroplist('','', $statusOptions, $row["status"]) . "</td>";
        echo "<td>" . getActiveIcon($row["active"])            . "</td>";
        // echo "<td>" . '<a class="" href="' . $nextPage . '?id=' . $row["id"] . '&action=edit" title="Edit">' . '<i class="fa fa-edit" aria-hidden="true"></i>' . "" . '</a>'. "</td>";
        // echo "<td>" . '<a class="" href="' . $nextPage . '?id=' . $row["id"] . '&action=delete" title="Delete">' . '<i class="fa fa-remove" aria-hidden="true"></i>' . "" . '</a>'. "</td>";
        // TO ADD CONFIRM FUNCTION, ADD THIS TO DELETE LINK: onclick="return confirm('Confirm delete');"        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    // pagination
    echo showPagination($thisPage, $firstText, $prevText, $nextText, $lastText, $totalPages, $start, $page, $limit);
    echo "</div></div></div>";
} else { echo "0 results"; }
echo "<br>";
?>
                        </div>
                    </div>
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

<!-- END page content -->

<?php require_once('admin_footer.php'); ?>

<style>

      .activeSelector {
        float: left;    
        border-radius: 15px;
        height: 20px;
        width: 20px;
        margin: 0 12px;
        border: 1px solid rgba(87, 121, 63, 0.3);
        background-image: -moz-linear-gradient(center bottom , rgba(0, 0, 0, 0.15) -17%, rgba(255, 255, 255, 0.15) 117%);
      }
      .activeSelectorOn {
        background-color: #90b575;  
      /*
        OLD BUTTON STYLE
        float: left;    
        text-align: center;
        width: 100%;
        color: #fff;
        font-weight: bold;
        background-color: #90b575;
        border-radius: 5px;
        background-image: -moz-linear-gradient(center bottom , rgba(0, 0, 0, 0.15) -17%, rgba(255, 255, 255, 0.15) 117%);
        border: 1px solid rgba(87, 121, 63, 0.8);
        cursor: pointer;
        font-size: smaller;
       */
      }
      .activeSelectorOff {
      background-color: #f25c9a;
      /*
        float: left;    
        text-align: center;
        width: 100%;
        color: #555;
        font-weight: bold;
        background-color: #f25c9a;
        border-radius: 5px;
        background-image: -moz-linear-gradient(center bottom , rgba(0, 0, 0, 0.15) -17%, rgba(255, 255, 255, 0.15) 117%);
        border: 1px solid rgba(87, 121, 63, 0.8);
        cursor: pointer;
        font-size: smaller;
      }

</style>