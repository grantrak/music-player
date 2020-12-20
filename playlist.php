<?php 
include("includes/includedFiles.php");


if(isset($_GET['id'])) {
    $playlistId = $_GET['id'];
} else {
    header("Location: index.php");
}

$playlist = new Playlist($con, $playlistId);
$owner = new User($con, $playlist->getOwner());
?>

<div class="entityInfo">
    <div class="leftSection">
        <div class="playlistImage">
            <img src="assets/images/icons/playlist.png" alt="">
        </div>
    </div>
    <div class="rightSection">
        <h2><?php echo $playlist->getName(); ?></h2>
        <p>By <?php echo $playlist->getOwner(); ?></p>
        <p><?php echo $playlist->getNumberOfSongs(); ?> songs</p>
        <button class="button" onclick="deletePlaylist('<?php echo $playlistId; ?>')">DELETE PLAYLIST</button>
    </div>
</div>

<div class="tracklistContainer">

    <ul class="tracklist">
       <?php 
        $songIdArray = $playlist->getSongIds();

        $i = 1;
        foreach($songIdArray as $songId) {
            
            $playlistSong = new Song($con, $songId);
            $songArtist = $playlistSong->getArtist();
       ?>

            <li class="tracklistRow">
                <div class="trackCount">
                    <img src="assets/images/icons/play-white.png" alt="" class="play" onclick="setTrack('<?php echo $playlistSong->getId(); ?>', tempPlaylist, true) ">
                    <span class="trackNumber"><?php echo $i; ?></span>
                </div>

                <div class="trackInfo">
                    <span class="trackName"><?php echo $playlistSong->getTitle(); ?></span>
                    <span class="artistName"><?php echo $songArtist->getName(); ?></span>
                </div>

                <div class="trackOptions">
                    <input type="hidden" class="songId" value="<?php echo $playlistSong->getId(); ?>">
                    <img src="assets/images/icons/more.png" alt="" class="optionsButton" onclick="showOptionsMenu(this)">
                </div>

                <div class="trackDuration">
                    <span class="duration"><?php echo $playlistSong->getDuration(); ?></span>
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



<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
    <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlistId; ?>')">Remove from Playlist</div>
</nav>