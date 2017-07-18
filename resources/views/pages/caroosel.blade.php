        <!-- <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php foreach($reviews as $rev) { ?>
            <div class="item">
              <div class="container comment" style="width: 1000px">
                <div>
                    <h1>Отзывы<sup><a href="#">(Все отзывы)</a></sup></h1>
                    <img src="img/quote.png" width="20px" class="img-quote">
                    <p class="text">
                        <?php echo $rev->message; ?>
                    </p>
                    <p class="name"><?php echo $rev->name . " $rev->surname" ?></p>
                    <p class="date"><?php echo substr($rev->updated_at, 0, 10)?></p>
                </div>
                 <img src="<?php echo $rev->avatar ?>" alt="profile Pic" class="img-circle">
                <img src="img/comment_bg.png" width="100%" class="img-comment-bg">
            </div>
        </div>
        <?php } ?>
  </div>

  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" style="font-size: 40px; color: grey;"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" style="font-size: 40px; color: grey;"></span>
    <span class="sr-only">Next</span>
  </a>
</div> -->