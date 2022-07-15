<?php
get_header();
?>
    <main class="container">
        <?php
        $args = [
            'post_type' => 'cities',
            'post_status' => 'publish',
            'posts_per_page' => 12,
            'orderby' => 'created',
            'order' => 'DESC',
        ];

        $cities = new WP_Query($args);
        ?>
        <h1 class="title">Города</h1>
        <div class="cities-wrapper">
            <?php
            while ($cities->have_posts()) : $cities->the_post();
                $text = get_the_content();
            ?>
                <div class="cities-item">
                    <?php the_post_thumbnail('medium', ['class' => 'cities-item__image']);?>
                    <div class="cities-item__body"><h4 class="cities-item__title"><?php the_title(); ?></h4>
                        <p>
                            <?php echo wp_trim_words($text, 30, ' ...'); ?>
                        </p></div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
            ?>
        </div>

        <?php include('create-cities-form.php')?>
    </main>
<?php
get_footer();



