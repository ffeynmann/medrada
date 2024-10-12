<?php
if('open' != $post->comment_status) {
    return '';
}

$author = get_the_author();

is_singular(['team']) && $author = $post->post_title;
?>

<div class="gt3_span12">
    <div class="contact-us-wrapper">
        <h3>Поставте питання автору:</h3>
        <div class="mt-4"></div>

        <input type="text" style="display: none;" name="section" value="<?= $author ?>">

        <div class="row">
            <div class="gt3_span6">
                <input type="text" name="name" placeholder="Ваше ім’я">
            </div>
            <div class="gt3_span6 mt-2 mt-md-0">
                <input type="text" name="phone" placeholder="Телефон">
            </div>
        </div>
        <div class="row mt-2">
            <div class="gt3_span12">
                <textarea name="comment" placeholder="Повідомлення"></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="gt3_span12">
                <input type="submit"
                       data-send-form
                       data-text-error="Заповніть поля!"
                       data-text-original="Відправити"
                       value="Відправити"
                />
            </div>
        </div>
    </div>
</div>