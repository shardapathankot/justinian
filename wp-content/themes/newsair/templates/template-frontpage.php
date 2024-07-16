<?php /**
 // Template Name: Frontpage
 */
get_header(); ?>
<main id="content">
    <!--container-->
    <div class="container">
        <!--row-->
        <div class="row">
            <?php get_template_part('sidebar','frontpageleft');
            get_template_part('sidebar','frontcontent');
            get_template_part('sidebar','frontpageright'); ?>
        </div><!--row-->
    </div><!--container-->
</main>
<?php get_template_part('sections/home','bfooter'); 
get_template_part('sections/home','instagram'); 
get_footer(); ?>