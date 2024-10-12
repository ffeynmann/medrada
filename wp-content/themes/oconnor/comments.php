<?php
if (post_password_required()) {
    ?>
    <p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'oconnor'); ?></p>
    <?php return;
}
?>

<div id="comments"><?php
    #Required for nested reply function that moves reply inline with JS
    if (is_singular()) wp_enqueue_script('comment-reply');

    if (have_comments()) : ?>
        <?php $comments_number = get_comments_number(); ?>
        <h3><?php printf( _nx( '%1$s comment', '%1$s comments', $comments_number, 'comments title', 'oconnor' ), number_format_i18n($comments_number) ); ?></h3>
        <ol class="commentlist">
            <?php
            if (gt3_option("post_pingbacks") == "1") {
                wp_list_comments('type=all&callback=gt3_theme_comment');
            } else {
                wp_list_comments('type=comment&callback=gt3_theme_comment');
            }
            ?>
        </ol>

        <div class="gt3_pagination_comments"><?php paginate_comments_links(array('prev_text' => esc_html__('Prev', 'oconnor'), 'next_text' => esc_html__('Next', 'oconnor'))); ?></div>
    <?php endif; ?>
    <?php if ('open' == $post->comment_status) :
        $comment_form = array(
            'fields'              => apply_filters('comment_form_default_fields', array(
                'author' => '<div class="gt3_span6 name"><label class="label-name"></label><input type="text" placeholder="' . esc_attr__('Your Name', 'oconnor') . '" title="' . esc_attr__('Your Name', 'oconnor') . '" id="author" name="author" class="form_field"></div>',
                'email'  => '<div class="gt3_span6 email"><label class="label-email"></label><input type="text" placeholder="' . esc_attr__('Your Email', 'oconnor') . '" title="' . esc_attr__('Your Email', 'oconnor') . '" id="email" name="email" class="form_field"></div>',
                'url'    => '<div class="gt3_span12 url"><label class="label-url"></label><input type="text" placeholder="' . esc_attr__('Your Url', 'oconnor') . '" value="' . esc_attr($commenter['comment_author_url']) . '" title="' . esc_attr__('Your Url', 'oconnor') . '" id="url" name="url" class="form_field" size="30" maxlength="200" ></div>'
            )),
            'comment_field'       => '<div class="gt3_span12 message"><label class="label-message"></label><textarea name="comment" cols="45" rows="5" placeholder="' . esc_attr__('Your Message', 'oconnor') . '" id="comment-message" class="form_field"></textarea></div>',
            'comment_form_before' => '',
            'comment_form_after'  => '',
            'must_log_in'         => esc_html__('You must be logged in to post a comment.', 'oconnor'),
            'title_reply_before'  => '<h3 id="reply-title" class="comment-reply-title">',
            'title_reply_after'   => '</h3>',
            'title_reply'         => esc_html__('Leave a Reply', 'oconnor'),
            'label_submit'        => esc_html__('REPLY', 'oconnor'),
            'logged_in_as'        => '<p class="logged-in-as">' . esc_html__('Logged in as', 'oconnor') . ' <a href="' . esc_url(admin_url('profile.php')) . '">' . $user_identity . '</a>. <a href="' . esc_url(wp_logout_url(apply_filters('the_permalink', get_permalink()))) . '">' . esc_html__('Log out?', 'oconnor') . '</a></p>',
        );

        add_filter('comment_form_fields', 'gt3_reorder_comment_fields');

        if (!function_exists('gt3_reorder_comment_fields')) {
            function gt3_reorder_comment_fields($fields) {
                $new_fields = array();

                $myorder = array('author', 'email', 'url', 'comment');

                foreach ($myorder as $key) {
                    $new_fields[$key] = $fields[$key];
                    unset($fields[$key]);
                }

                if ($fields) {
                    foreach ($fields as $key => $val) {
                        $new_fields[$key] = $val;
                    }
                }

                return $new_fields;
            }
        }


        comment_form($comment_form, $post->ID);

    else : // Comments are closed

    endif; ?>
</div>