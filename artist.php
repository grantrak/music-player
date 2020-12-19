<?php 

include("includes/includedFiles.php");

if(isset($_GET['id'])) {
    $artistId = $_GET['id'];
} else {
    header("Location: index.php");
}

$artist = new Artist($con, $artistId);
?>

<div class="entityInfo borderBottom">

    <div class="centerSection">

        <div class="artistInfo">

            <h1 class="artistName"><?php echo $artist->getName(); ?></h1>

            <div class="headerButtons">
                <button class="button button-green" onclick="playFirstSong()">PLAY</button>
            </div>

        </div>

    </div>

</div>




<div class="tracklistContainer borderBottom">

<h2>SONGS</h2>

    <ul class="tracklist">
       <?php 
        $songIdArray = $artist->getSongIds();

        $i = 1;
        foreach($songIdArray as $songId) {

            if($i >5) {
                break;
            }
            
            $albumSong = new Song($con, $songId);
            $albumArtist = $albumSong->getArtist();
       ?>

            <li class="tracklistRow">
                <div class="trackCount">
                    <img src="assets/images/icons/play-white.png" alt="" class="play" onclick="setTrack('<?php echo $albumSong->getId(); ?>', tempPlaylist, true) ">
                    <span class="trackNumber"><?php echo $i; ?></span>
                </div>

                <div class="trackInfo">
                    <span class="trackName"><?php echo $albumSong->getTitle(); ?></span>
                    <span class="artistName"><?php echo $albumArtist->getName(); ?></span>
                </div>

                <div class="trackOptions">
                    <img src="assets/images/icons/more.png" alt="" class="optionsButton">
                </div>

                <div class="trackDuration">
                    <span class="duration"><?php echo $albumSong->getDuration(); ?></span>
                </div>
            </li>

       <?php
            $i++;
        }
       ?> 
       <script>
           var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
           tempPlaylist = JSON.parse(tempSongIds);
       </script>
    </ul>

</div>



<div class="gridViewContainer">

<h2>ALBUMS</h2>

    <?php 
        $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist='$artistId'");
        while($row = mysqli_fetch_array($albumQuery)) {
    ?>

           <div class="gridViewItem">
               <span onclick="openPage('album.php?id=<?php echo $row['id']; ?>')" role="link" tabindex="0">
               <img src="<?php echo $row['artworkPath']; ?>" alt="">
               <div class="gridViewInfo">
                   <?php echo $row['title']; ?>
               </div>
               </span>
           </div> 

    <?php      
        }
    ?> 
    

</div>