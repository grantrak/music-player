<?php include("includes/header.php"); ?>


<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">

    <?php 
        $albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");
        while($row = mysqli_fetch_array($albumQuery)) {
    ?>

           <div class="gridViewItem">
               <a href="album.php?id=<?php echo $row['id']; ?>">
               <img src="<?php echo $row['artworkPath']; ?>" alt="">
               <div class="gridViewInfo">
                   <?php echo $row['title']; ?>
               </div>
               </a>
           </div> 

    <?php      
        }
    ?> 
    

</div>


<?php include("includes/footer.php"); ?>