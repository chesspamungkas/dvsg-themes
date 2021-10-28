<style>
#no-result .stories.carousel .story {
    width: 50vw;
    max-width: 150px;
}

#no-result #browse-categories-title {
    display: none;
}

#no-result .category_tags a {
    text-align: center;
    margin-right: auto;
    margin-left: auto;
    float: unset;
}

#no-result > .row > div {
    margin-left: auto;
    margin-right: auto;
}

#no-result, .no-result-entry > p, .no-result-entry > h1 {
    position:relative;
    z-index: 10;
}

.no-result-background {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50vh;
    background-image: url( 'https://uploads.dailyvanity.sg/wp-content/uploads/2021/06/404.jpg' ); 
    background-size: contain; 
    background-repeat: no-repeat; 
    background-position: bottom left;
    z-index: 0;
    opacity: 0.4;
}
</style>

<div class="entry no-result-entry" style="min-height:400px; text-align:center; position: relative;">
<!--If no results are found-->
	<?php echo do_action( '404-content' ); ?>
	<div class="container" id="no-result">
		<div class="row p-0 m-0">
			<!--div class="col m-0 p-5"-->
				<?php echo do_action( '404-content-after' ); ?>
			<!--/div-->
		</div>
	</div>
    <div class="no-result-background"></div>
</div>
<!--End if no results are found-->