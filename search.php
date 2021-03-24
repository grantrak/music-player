<?php 
include("includes/includedFiles.php");

if(isset($_GET['term'])) {
    $term = urldecode($_GET['term']);
} else {
    $term = "";
}
?>


<div class="searchContainer">
    <input type="text" class="searchInput" value="<?php echo $term; ?>"  placeholder="Start typing..." onfocus="var val=this.value; this.value=''; this.value= val;">
</div>

<script>
    $(function() {
        $(".searchInput").focus();
        
        $(".searchInput").keyup(function() {
            clearTimeout(timer);
            timer = setTimeout(function() {
                var val = $(".searchInput").val();
                openPage("search.php?term=" + val);
            }, 2000);
        });
    });
</script>
<?php if($term == "") exit(); ?>
<div class="tracklistContainer">

<h2>SONGS</h2>

    <ul class="tracklist">
       <?php 

        $songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '%$term%' LIMIT 10");

        if(mysqli_num_rows($songsQuery) == 0) {
            echo "<span class='noResults'>No songs found matching " . $term . "<span>";
        }

        $songIdArray = array();

        $i = 1;
        while($row = mysqli_fetch_array($songsQuery)) {

            if($i > 15) {
                break;
            }

            array_push($songIdArray, $row['id']);
            
            $albumSong = new Song($con, $row['id']);
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
                    <input type="hidden" class="songId" value="<?php echo $albumSong->getId(); ?>">
                    <img src="assets/images/icons/more.png" alt="" class="optionsButton" onclick="showOptionsMenu(this)">
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

<div class="artistsContainer">
     <h2 class="searchHeading">ARTISTS</h2>   
     <?php 
     
     $artistsQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '%$term%' LIMIT 10");

     if(mysqli_num_rows($artistsQuery) == 0) {
        echo "<span class='noResults'>No artists found matching " . $term . "<span>";
    }

    while($row = mysqli_fetch_array($artistsQuery)) {
        $artistFound = new Artist($con, $row['id']);
    ?>

       <div class="searchResultRow">
           <div class="artistName">
               <span role="link" tabindex="0" onclick="openPage('artist.php?id=<?php echo $artistFound->getId(); ?>')"><?php echo $artistFound->getName(); ?></span>
           </div>
       </div> 

    <?php

    }
     
     ?>
</div>




<div class="gridViewContainer">

<h2 class="searchHeading">ALBUMS</h2>

    <?php 
        $albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE title like '%$term%' LIMIT 10");

        if(mysqli_num_rows($albumQuery) == 0) {
            echo "<span class='noResults'>No albums found matching " . $term . "<span>";
        }


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


<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>