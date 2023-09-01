<div class="authorSection <?= $additional_class ?>" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
  <div class="authorName poppins-regular">
    <?php the_author_posts_link() ?>
  </div>
  <div class="postDate poppins-regular">
    <?= get_the_date(); ?>
  </div>
</div>