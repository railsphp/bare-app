<?php
if ($this->posts->any()) :
    $count = $this->posts->count();
?>
<div class="posts-list">
    <?php foreach ($this->posts as $k => $post) : ?>
        <?= $this->partial('posts/preview', ['post' => $post]) ?>
        <?php
        if ($k == 2 && $count > 2) {
            echo $this->partial('ads/square', ['margin' => true]);
        }
        ?>
    <?php endforeach ?>
</div>
<?php else: ?>
<div>No se encontraron imágenes</div>
<?php endif ?>
