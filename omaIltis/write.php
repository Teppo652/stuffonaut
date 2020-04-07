<?php
session_start();
include('functions.php');
$conn = getDBConn('no');

// $selectedId = "";
$thisPage = "write.php";
// $returnPage = "omaIltis_articles.php";
$table = "omaIltis_articles";
$selectedId = "";

require_once('admin_header.php'); 
?>

<!-- page content -->
        <div class="wrapper">
            <div class="container-fluid">                

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Write article</h4>
<?php
// --------------------- BEGIN CODE ------------------------

$isDebug = ''; if(isset($_GET['poiu1234'])) { $isDebug = '1'; }
if(!empty($_SESSION["info"])) { echo '<div class="panel panel-success"><div class="panel-heading">' . $_SESSION["info"] . '</div></div>'; $_SESSION["info"] = ''; }
if(!empty($_SESSION["error"])) { echo '<div class="panel panel-error"><div class="panel-heading">Error</div><div class="panel-body">' . $_SESSION["error"] . '</div></div>'; $_SESSION["error"] = ''; }


// read id from url
$siteId = "";
if (isset($_GET['id']))
{
  $selectedId = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_URL );
  $thisPage .= "?id=" . $selectedId;
  $returnPage .= "?siteId=" . $_GET["id"];
      echo 'The id is: ' . $selectedId;
}

$countryId = $langId = $reporterUserId = $proofReaderUserId = $cat1 = $cat2 = $publishDate = $sourceMedias = $sourceUrls = $klickTitle = $title = $images = $video = $article = $status = $active = "";
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
{
    // $countryId =         $_POST["countryId"];
    // $langId =            $_POST["langId"];
    // $reporterUserId =    $_POST["reporterUserId"];
    // $proofReaderUserId = $_POST["proofReaderUserId"];
    $cat1 =              $_POST["cat1"];
    $cat2 =              $_POST["cat2"];
    //$publishDate =       $_POST["publishDate"];
    $sourceMedias =      $_POST["sourceMedias"];
    //$sourceUrls =        $_POST["sourceUrls"];
    //$klickTitle =        $_POST["klickTitle"];
    $title =             $_POST["title"];
    //$images =            $_POST["images"];
    //$video =             $_POST["video"];
    $article =           $_POST["article"];
    $status =            $_POST["status"];
    //$active =            $_POST["active"];


        echo "<br>cat1: " .               $cat1             . "<br>";
        echo "<br>cat2: " .               $cat2             . "<br>";
        echo "<br>title: " .              $title            . "<br>";
        echo "<br>article: " .            $article          . "<br>";
        echo "<br>status: " .             $status           . "<br>";
}

if(isset($_GET['action']))
{
  $selectedAction = filter_input( INPUT_GET, 'action', FILTER_SANITIZE_URL );
  if($selectedAction == "save")
  {
    $fields = "countryId,langId,reporterUserId,proofReaderUserId,cat1,cat2,publishDate,sourceMedias,sourceUrls,klickTitle,title,images,video,article,status,active";
    $values = $countryId . "," . $langId . "," . $reporterUserId . "," . $proofReaderUserId . "," . $cat1 . "," . $cat2 . "," . $publishDate . "," . $sourceMedias . "," . $sourceUrls . "," . $klickTitle . "," . $title . "," . $images . "," . $video . "," . $article . "," . $status . "," . $active;
    
    // UPDATING VALUES
    if($selectedId != "")
    {
      $updateFieldsWithValues = "";
      $fieldsArr = explode(',', $fields);
      $valuesArr = explode(',', $values);
      for($x = 0; $x < count($fieldsArr); $x++) {
          $updateFieldsWithValues .= $fieldsArr[$x] . "='" . $valuesArr[$x] . "', ";
      }
      $updateFieldsWithValues = substr($updateFieldsWithValues, 0, -2);
      
      $sql = "UPDATE " . $table . " SET " . $updateFieldsWithValues . " WHERE id=" . $selectedId;
      echo '<br>UPDATING updateFieldsWithValues: ' . $updateFieldsWithValues . '<br>';
      if ($conn->query($sql) === TRUE) {
          $_SESSION["info"] = "Record updated successfully.";
      } else {
          $_SESSION["error"] = "Error updating record (Errcode: 100)";
          if($isDebug) { echo "Error updating record: " . $conn->error; }
      }
      $conn->close();
    
    }
    else
    {
      
      
      $sql = "INSERT INTO " . $table . " (" . $fields . ") VALUES ('" . str_replace(",","','",$values) . "')";
      echo '<br>INSERTING: ' . $sql;
      if ($conn->query($sql) === TRUE) {
          $_SESSION["info"] = "Record inserted successfully.";
      } else {
          $_SESSION["error"] = "Error inserting record (Errcode: 101)";
          if($isDebug) { echo "Error inserting record: " . $conn->error; }
      }
      $conn->close();
    }
  }
  elseif ($selectedAction == "delete")
  {
    $sql = "DELETE FROM " . $table . " WHERE id=" . $selectedId;
    if (mysqli_query($conn, $sql))
    {
          $_SESSION["info"] = "Record deleting successfully.";
    }
    else
    {
          $_SESSION["error"] = "Error deleting item (Errcode: 102)";
          if($isDebug) { echo "Error deleting item: " . mysqli_error($conn); }
    }
    mysqli_close($conn);
  }
  elseif ($selectedAction == "edit")
  {
    if($selectedId != "")
    {
      echo '<br>Editing<br>';
      
      // get single omaIltis_article
        $sql = "SELECT * FROM " . $table . " WHERE id=" . $selectedId;
        echo '<br>SQL2: ' . $sql . '<br>';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
               $langId =            $row["langId"];
               $reporterUserId =    $row["reporterUserId"];
               $proofReaderUserId = $row["proofReaderUserId"];
               $cat1 =              $row["cat1"];
               $cat2 =              $row["cat2"];
               $publishDate =       $row["publishDate"];
               $sourceMedias =      $row["sourceMedias"];
               $sourceUrls =        $row["sourceUrls"];
               $klickTitle =        $row["klickTitle"];
               $title =             $row["title"];
               $images =            $row["images"];
               $video =             $row["video"];
               $article =           $row["article"];
               $status =            $row["status"];
               $active =            $row["active"];
                
                echo "<h3>Edit omaIltis_article</h3>";
                
                echo '<form action="' . htmlspecialchars($thisPage . '&action=save') . '" method="post">';
                echo "<table>";
                
                echo "<tr><td>" . "Lang Id:" .            "</td><td>" . getLangDroplist('langId', '-- Select --', $langId) .            "</td></tr>";
                echo "<tr><td>" . "Reporter User Id:" .    "</td><td>" . $reporterUserId .  '<input type="hidden" value="' . $reporterUserId . '"    name="reporterUserId">' .    "</td></tr>";
                echo "<tr><td>" . "Proof Reader User Id:" . "</td><td>" . $proofReaderUserId .  '<input type="hidden" value="' . $proofReaderUserId . '" name="proofReaderUserId">' . "</td></tr>";
                echo "<tr><td>" . "Cat1:" .              "</td><td>" . '<input type="text" value="' . $cat1 . '"              name="cat1">' .              "</td></tr>";
                echo "<tr><td>" . "Cat2:" .              "</td><td>" . '<input type="text" value="' . $cat2 . '"              name="cat2">' .              "</td></tr>";
                echo "<tr><td>" . "Publish Date:" .       "</td><td>" . displayDate($publishDate) .  '<input type="hidden" value="' . $publishDate . '"       name="publishDate">' .       "</td></tr>";
                echo "<tr><td>" . "Source Medias:" .      "</td><td>" . '<input type="text" value="' . $sourceMedias . '"      name="sourceMedias">' .      "</td></tr>";
                echo "<tr><td>" . "Source Urls:" .        "</td><td>" . '<input type="text" value="' . $sourceUrls . '"        name="sourceUrls">' .        "</td></tr>";
                echo "<tr><td>" . "Klick Title:" .        "</td><td>" . '<input type="text" value="' . $klickTitle . '"        name="klickTitle">' .        "</td></tr>";
                echo "<tr><td>" . "Title:" .             "</td><td>" . '<input type="text" value="' . $title . '"             name="title">' .             "</td></tr>";
                echo "<tr><td>" . "Images:" .            "</td><td>" . '<input type="text" value="' . $images . '"            name="images">' .            "</td></tr>";
                echo "<tr><td>" . "Video:" .             "</td><td>" . $video .  '<input type="hidden" value="' . $video . '"             name="video">' .             "</td></tr>";
                echo "<tr><td>" . "Article:" .           "</td><td>" . '<input type="text" value="' . $article . '"           name="article">' .           "</td></tr>";
                echo "<tr><td>" . "Status:" .            "</td><td>" . '<input type="text" value="' . $status . '"            name="status">' .            "</td></tr>";
                echo "<tr><td>" . "Active:" .            "</td><td>" . getOnOffDroplist('active', '', $active) .            "</td></tr>";
                
                echo "<tr><td>" . "&nbsp;" . "</td><td>" . '<input type="submit" value="Save">' . "</td></tr>";
                
            echo "</table>";
                echo "</form>";
            }
        }
        else
        {
            echo '<br>ERROR: no such omaIltis_article found.<br>';
        }
      $conn->close();
    }
    else
    {
      // Write article      
        echo '<form action="' . htmlspecialchars($thisPage . '?action=save') . '" method="post">';
        echo "<table>";
              $siteId = "URL DATA siteId ERROR"; if (isset($_GET['siteId'])){ $siteId = filter_input( INPUT_GET, 'siteId', FILTER_SANITIZE_URL ); }
               //echo "<tr><td>" . "Lang Id:" .            "</td><td>" . $langId .            "</td></tr>";
               //echo "<tr><td>" . '<label for="reporterUserId">Reporter User Id:* </label>   ' . "</td><td>" . '<input type="text" id="reporterUserId" name="reporterUserId">' .    "</td><td>" . '<span class="errorFeedback errorSpan" id="reporterUserIdError">Reporter User Id is required field</span>' . "</td></tr>";
               // echo "<tr><td>" . '<label for="proofReaderUserId">Proof Reader User Id:* </label>' . "</td><td>" . '<input type="text" id="proofReaderUserId" name="proofReaderUserId">' . "</td><td>" . '<span class="errorFeedback errorSpan" id="proofReaderUserIdError">Proof Reader User Id is required field</span>' . "</td></tr>";

                $options = '--- Valitse ---,Main category,Ulkomaat,Kotimaa,Paikallinen,Valitse pääkategoria';
               echo "<tr><td>" . '<label for="cat1">Category 1:* </label>' . "</td><td>"   . getDroplist("cat1", $options, $cat2) . "</td></tr>";

               $options = '--- Valitse ---,Sub category,Ihmiset,Politiikka,Urheilu,Yritykset,Valitse alikategoria';
               echo "<tr><td>" . '<label for="cat2">Category 2:* </label>' . "</td><td>"   . getDroplist("cat2", $options, $cat2) . "</td></tr>";

               // echo "<tr><td>" . "Publish Date:" .       "</td><td>" . displayDate(getCurrentDateAsYYMMDDHHMM()) . '<input type="hidden" value="' . getCurrentDateAsYYMMDDHHMM() . '"       name="publishDate">' .       "</td></tr>";

               //echo "<tr><td>" . '<label for="sourceMedias">Source Medias:* </label>     ' . "</td><td>" . '<input type="text" id="sourceMedias" name="sourceMedias">' .      "</td><td>" . '<span class="errorFeedback errorSpan" id="sourceMediasError">Source Medias is required field</span>' . "</td></tr>";

               // source media droplist
               $options = '--- Valitse ---,Original source,NY times,Washington post,The economist,The independent,Valitse tila';
               echo "<tr><td>" . '<label for="sourceMedias">Original source:* </label>' . "</td><td>"   . getDroplist("sourceMedias", $options, $sourceMedias) . "</td></tr>";


               //echo "<tr><td>" . '<label for="sourceUrls">Source Urls:* </label>       ' . "</td><td>" . '<input type="text" id="sourceUrls" name="sourceUrls">' .        "</td><td>" . '<span class="errorFeedback errorSpan" id="sourceUrlsError">Source Urls is required field</span>' . "</td></tr>";
               //echo "<tr><td>" . '<label for="klickTitle">Klick Title:* </label>       ' . "</td><td>" . '<input type="text" id="klickTitle" name="klickTitle">' .        "</td><td>" . '<span class="errorFeedback errorSpan" id="klickTitleError">Klick Title is required field</span>' . "</td></tr>";
               echo "<tr><td>" . '<label for="title">Title:* </label>            ' . "</td><td>" . '<input type="text" class="form-control mt-3" id="title" name="title">' .             "</td><td>" . '<span class="errorFeedback errorSpan" id="titleError">Title is required field</span>' . "</td></tr>";
               //echo "<tr><td>" . '<label for="images">Images:* </label>           ' . "</td><td>" . '<input type="text" id="images" name="images">' .            "</td><td>" . '<span class="errorFeedback errorSpan" id="imagesError">Images is required field</span>' . "</td></tr>";
               //echo "<tr><td>" . '<label for="video">Video:* </label>            ' . "</td><td>" . '<input type="text" id="video" name="video">' .             "</td><td>" . '<span class="errorFeedback errorSpan" id="videoError">Video is required field</span>' . "</td></tr>";


        echo "<tr><td>" . "&nbsp; " . "</td><td>" . "&nbsp; " . "</td></tr>";

               echo '<tr><td colspan="3">' . '<label for="article">Article text:* </label>' . "</td></tr>";
               echo '<tr><td colspan="3">' . '<textarea id="article" class="custom-input form-control mt-3" style="width:800px" name="article" type="userDesc">' . $article . '</textarea><br><span class="char-count">2000</span> chars remaining' . "</td></tr>";


               /*
               <div class="form-group row">
                <label for="userDesc" class="col-12 col-form-label"><?php echo getTranslations('userDesc', $langCode, $siteCountryCode); ?></label>
                <div class="col-12">
                    <textarea id="userDesc" class="custom-input custom-textarea" name="userDesc" type="userDesc"><?php echo $userDesc; ?></textarea><span class="char-count">2000</span> chars remaining
                </div>
            </div>
            */
               
               //echo "<tr><td>" . '<label for="status">Status:* </label>           ' . "</td><td>" . '<input type="text" id="status" name="status">' .            "</td><td>" . '<span class="errorFeedback errorSpan" id="statusError">Status is required field</span>' . "</td></tr>";

                $options = '--- Valitse ---,Tila,idea,assigned,inWriting,waitingForMedia,inProofReading,published,onHold,cancelled,inArchive,Valitse tila';                               // 0=idea,1=assigned,2=inWriting,3=waitingForMedia,4=inProofReading,5=published,6=onHold,7=cancelled,8=inArchive
               echo "<tr><td>" . '<label for="status">Article status:* </label>' . "</td><td>"   . getDroplist("status", $options, $status) . "</td></tr>";

               // echo "<tr><td>" . "Active:" .            "</td><td>" . $active .            "</td></tr>";
        
        echo "<tr><td>" . "&nbsp; " . "</td><td>" . "&nbsp; " . "</td></tr>";
        
      echo "<tr><td>" . "" . "</td><td>"; // if (isset($_GET['siteId'])) { $siteId = filter_input( INPUT_GET, 'siteId', FILTER_SANITIZE_URL ); }
        //echo '<a href="' . $returnPage . '">Cancel</a> &nbsp; <a href="' . $thisPage . '?action=create">Save</a>';
        echo '<input type="submit" value="Save">';
      echo "</td></tr>";
      
      echo "</table>";
      echo "</form>";
      
    }
  } elseif ($selectedAction == null) {
  
  // show single omaIltis_article
      $sql = "SELECT * FROM " . $table . " WHERE id=" . $selectedId . "";
      echo '<br>' . $sql . '<br>';
    
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
          {
            echo "<h3>Oma Iltis_article information</h3>";
        
        echo "<table>";
        
            echo "<tr><td>" . "Lang Id: " .             "</td><td>" . $row["langId"] .            "</td></tr>";
            echo "<tr><td>" . "Reporter User Id: " .     "</td><td>" . $row["reporterUserId"] .    "</td></tr>";
            echo "<tr><td>" . "Proof Reader User Id: " .  "</td><td>" . $row["proofReaderUserId"] . "</td></tr>";
            echo "<tr><td>" . "Cat1: " .               "</td><td>" . $row["cat1"] .              "</td></tr>";
            echo "<tr><td>" . "Cat2: " .               "</td><td>" . $row["cat2"] .              "</td></tr>";
            echo "<tr><td>" . "Publish Date: " .        "</td><td>" . $row["publishDate"] .       "</td></tr>";
            echo "<tr><td>" . "Source Medias: " .       "</td><td>" . $row["sourceMedias"] .      "</td></tr>";
            echo "<tr><td>" . "Source Urls: " .         "</td><td>" . $row["sourceUrls"] .        "</td></tr>";
            echo "<tr><td>" . "Klick Title: " .         "</td><td>" . $row["klickTitle"] .        "</td></tr>";
            echo "<tr><td>" . "Title: " .              "</td><td>" . $row["title"] .             "</td></tr>";
            echo "<tr><td>" . "Images: " .             "</td><td>" . $row["images"] .            "</td></tr>";
            echo "<tr><td>" . "Video: " .              "</td><td>" . $row["video"] .             "</td></tr>";
            echo "<tr><td>" . "Article: " .            "</td><td>" . $row["article"] .           "</td></tr>";
            echo "<tr><td>" . "Status: " .             "</td><td>" . $row["status"] .            "</td></tr>";
            echo "<tr><td>" . "Active: " .             "</td><td>" . getActiveIcon($row["active"]) .            "</td></tr>";
           
            echo "<tr><td>" . "&nbsp;" . "</td><td>" . "&nbsp;" . "</td></tr>";
            echo "<tr><td>" . "" . "</td><td>" . '<a href="' . $returnPage . '">Return</a>' . "</td></tr>";
            echo "</table>";
          }
    } else {
      echo "No records found.";
    }
    $conn->close();
  }
}

?>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </div> <!-- end wrapper -->
<!-- END page content -->
<style>
.error, .errorFeedback {
    display: none;
}
.custom-select {
    width: 230px;
}
textarea {
    height: 300px;
}
</style>
<?php require_once('admin_footer.php'); ?>