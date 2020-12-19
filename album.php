<?php 
include("includes/header.php"); 

if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
} else {
    header("Location: index.php");
}

$album = new Album($con, $albumId);

$artist = $album->getArtist();
?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>" alt="">
    </div>
    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfSongs(); ?> songs</p>
    </div>
</div>

<div class="tracklistContainer">

    <ul class="tracklist">
       <?php 
        $songIdArray = $album->getSongIds();

        $i = 1;
        foreach($songIdArray as $songId) {
            
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

<?php include("includes/footer.php"); ?>