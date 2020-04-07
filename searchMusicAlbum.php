<?php
include_once('functions.php');
include_once('header.php');
$conn = getDBConn();

/*
SOURCE
https://www.last.fm/api/show/artist.search

use api_key (Teppo)
2a89d981e0dd3b1017d2d321496a35d4

use API viewer:
http://jsonviewer.stack.hu/

--------------------------
search album
http://ws.audioscrobbler.com/2.0/?method=album.search&album=Lick%20it%20up&api_key=2a89d981e0dd3b1017d2d321496a35d4&format=json&limit=10

NOTE use: "powered by AudioScrobbler" - logo in button that links to:
http://www.last.fm/music/<artistname>/<albumname>
--------------------------


search artist by name
http://ws.audioscrobbler.com/2.0/?method=artist.search&artist=Laura%20Voutilainen&api_key=2a89d981e0dd3b1017d2d321496a35d4&format=json

get more artist info (using the correct name):
http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=Samuli%20Edelmann&api_key=2a89d981e0dd3b1017d2d321496a35d4&format=json

save:
name : "Samuli Edelmann" + mbid : "17656e9b-9bb0-4f12-9d7d-ebb44163dd5a"
similar: "Lauri Tähkä"...
tags: name : "pop", "finnish pop"...

chart.getTopTracks
http://ws.audioscrobbler.com/2.0/?method=chart.gettoptracks&api_key=2a89d981e0dd3b1017d2d321496a35d4&format=json

chart.getTopArtists
 http://ws.audioscrobbler.com/2.0/?method=chart.gettopartists&api_key=2a89d981e0dd3b1017d2d321496a35d4&format=json


geo.getTopArtists
 http://ws.audioscrobbler.com/2.0/?method=geo.gettopartists&country=finland&api_key=2a89d981e0dd3b1017d2d321496a35d4&format=json
 */

?>

</script>

<input id="album" type="text" placeholder="Search by album name">
<button id="searchAlbum">Search</button>





<?php include_once('footer.php'); ?>