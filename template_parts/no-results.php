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
</style>

<div class="entry" style="min-height:400px; background-image: url( 'https://uploads.dailyvanity.sg/wp-content/uploads/2021/06/404.jpg' ); background-size: contain; background-repeat: no-repeat; background-position: bottom left; text-align:center;">
<!--If no results are found-->
	<h1>Oh no! This page seems to be broken just like the eyeshadows! :(</h1>
	<p style="font-size: 26px;">You can browse our website via the links below, search for the content you want in the search bar above or report this issue to us at <a href="mailto:only@dailyvanity.sg">only@dailyvanity.sg</a>.</p>
	<div class="container" id="no-result">
		<div class="row p-0 m-0">
			<!--div class="col m-0 p-5"-->
				<?php echo do_shortcode( '[igstory photo="no" noresult="yes"]' ); ?>
			<!--/div-->
		</div>
	</div>
</div>
<!--End if no results are found-->
