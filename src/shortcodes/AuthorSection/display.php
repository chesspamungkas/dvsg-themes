<div class="authorSection <?= $additional_class ?>" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
  <div class="authorName poppins-regular">
    <!--a href="<?= get_the_author_link() ?>" class="url fn n" rel="author" itemprop="url"><span itemprop="name"><?php the_author(); ?></span></a-->
    <?php the_author_posts_link() ?>
  </div>
  <div class="postDate poppins-regular">
    <?= get_the_date(); ?>
  </div>
</div>