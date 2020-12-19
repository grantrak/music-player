<?php 
include("includes/includedFiles.php");
?>


<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">

    <?php 
        $albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");
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


