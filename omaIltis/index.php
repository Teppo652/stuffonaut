<?php
session_start();
include('functions.php');
$conn = getDBConn('no');

$thisPage = "omaIltis_articles.php";
$nextPage = "omaIltis_article.php";
$table = "omaIltis_articles";
include('header.php');

/* ------------------ single article ---------------------- */
$sql = "SELECT * FROM " . $table;
$result = mysqli_query($conn, $sql);
if ($result)
{
    while($row = mysqli_fetch_assoc($result))
    {
        /* 
<?php echo $row["publishDate"]; ?>
<?php echo $row["title"]; ?>
<?php echo $row["article"]; ?>
        */
?>
<h1 class="article__title"><?php echo $row["title"]; ?></h1>
<div class="article__time-container">
    <img alt="" src="https://www.iltalehti.fi/article_clock.svg" class="time-clock"><time>Tänään klo 10:18</time><span> (muokattu <time>klo 10:44</time>)</span>
    <meta itemprop="datePublished" content="2018-07-05T10:18:43+03:00">
    <meta itemprop="dateModified" content="2018-07-05T10:44:50+03:00">
</div>
<div class="article__description" itemprop="description">
    The Guardianin kolumnisti Natalie Nougayréde arvioi, että Yhdysvaltain ja Venäjän presidenttien tapaamisen ainoa voittaja on Putin.
</div>
<div class="article-body">
    <!-- image -->
    <p><?php echo $row["article"]; ?></p>
</div> <!-- article-body -->

<div class="article__authors">
    <div>
        <p>HANNA GRÅSTEN <a href="mailto:hanna.grasten@iltalehti.fi" target="_blank" rel="nofollow noopener noreferrer">hanna.grasten@iltalehti.fi</a></p>
    </div>
</div>
<?php
    }
} else { echo '<div class="article-body">Found 0 articles.</div>'; }
/* ------------------ END single article ---------------------- */
?>

<?php include('readAlso.php'); ?>

<?php include('otherArticles.php'); ?>

<?php include('topList.php'); ?>                                   

                                </div> <!-- middle-column-article -->
                            </div> <!-- main-column-content -->
                        </div> <!-- main-container -->
                    </div> <!-- main-column --> 



                    <!-- right side -->
                    <aside class="side-column">
                        <div class="side-column-container">
                            <div class="column"><div>
                                <div class="card ">
                                    <div class="block">
                                        <div class="article-list">
                                            <h5 class="card-heading undefined">Tuoreimmat</h5>

                                            <a href="/kotimaa/201807042201054115_u0.shtml">
                                                <div class="article-container">
                                                    <div class="list-image-padding">
                                                        <div class="LazyLoad is-visible list-image-container" style="padding-bottom:61%"><img alt="" src="https://img.ilcdn.fi/Zlk9397WbQ46qDKOJGwVJSgf8wc=/138x/img-s3.ilcdn.fi/bc623003edd9bdc0eba625465d17de54595b1476428942012b143a7c2ca41757.jpg"></div>
                                                    </div>
                                                    <div class="title-container">
                                                        <div class="title a-title-font">Näkökulma: Suomessa suhtaudutaan työturvallisuuteen oikein - yksikin kuolemantapaus on liikaa</div>
                                                        <div class="category-time"><span>Kotimaan uutiset</span><span> - </span><time>19:36</time></div>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="/kotimaa/201807042201054115_u0.shtml">
                                                <div class="article-container">
                                                    <div class="list-image-padding">
                                                        <div class="LazyLoad is-visible list-image-container" style="padding-bottom:61%"><img alt="" src="https://img.ilcdn.fi/Zlk9397WbQ46qDKOJGwVJSgf8wc=/138x/img-s3.ilcdn.fi/bc623003edd9bdc0eba625465d17de54595b1476428942012b143a7c2ca41757.jpg"></div>
                                                    </div>
                                                    <div class="title-container">
                                                        <div class="title a-title-font">Näkökulma: Suomessa suhtaudutaan työturvallisuuteen oikein - yksikin kuolemantapaus on liikaa</div>
                                                        <div class="category-time"><span>Kotimaan uutiset</span><span> - </span><time>19:36</time></div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="/kotimaa/201807042201054115_u0.shtml">
                                                <div class="article-container">
                                                    <div class="list-image-padding">
                                                        <div class="LazyLoad is-visible list-image-container" style="padding-bottom:61%"><img alt="" src="https://img.ilcdn.fi/Zlk9397WbQ46qDKOJGwVJSgf8wc=/138x/img-s3.ilcdn.fi/bc623003edd9bdc0eba625465d17de54595b1476428942012b143a7c2ca41757.jpg"></div>
                                                    </div>
                                                    <div class="title-container">
                                                        <div class="title a-title-font">Näkökulma: Suomessa suhtaudutaan työturvallisuuteen oikein - yksikin kuolemantapaus on liikaa</div>
                                                        <div class="category-time"><span>Kotimaan uutiset</span><span> - </span><time>19:36</time></div>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </aside><!-- right side -->

                </div> <!-- layout__columns -->
            </div> <!-- news-container -->

            <div class="scroll-to-top">
                <span class="scroll-to-top-button">
                    Takaisin alkuun
                    <span class="arrow">
                        <i class="fas fa-angle-up"></i>
                    </span>
                </span>
            </div>











<?php include('footer.php'); ?>

        </div> <!-- container -->


</div> <!-- END news-container -->
