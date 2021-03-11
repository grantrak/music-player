<?php 
include("includes/includedFiles.php");
?>


<div class="playlistContainer">
    <div class="gridViewContainer">
        <h1>PLAYLISTS</h1>
        <div class="buttonItems">
            <button class="button button-green" onclick="createPlaylist()">NEW PLAYLIST</button>
        </div>


        <?php 
        $username = $userLoggedIn->getUsername();
        $playlistQuery = mysqli_query($con, "SELECT * FROM playlists WHERE owner='$username'");

        if(mysqli_num_rows($playlistQuery) == 0) {
            echo "<span class='noResults'>No playlists found<span>";
        }


        while($row = mysqli_fetch_array($playlistQuery)) {
            $playlist = new Playlist($con, $row);
    ?>

           <div class="gridViewItem" role='link' tabindex="0" onclick="openPage('playlist.php?id=<?php echo $playlist->getId(); ?>')">
               <div class="playlistImage">
                   <img src="assets/images/icons/playlist2.svg" alt="">
               </div>
                <div class="gridViewInfo">
                   <?php echo $playlist->getName(); ?>
                </div>
           </div> 

    <?php      
        }
    ?> 

    </div>
</div>