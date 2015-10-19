<?php $postUrl = $this->urlFor(['posts#show', 'id' => $this->post->id()]) ?>
<div class="post-preview">
    <h3 class="post-title">
      <a href="<?= $postUrl ?>"><?= $this->post->title() ?></a>
    </h3>
    <div class="post-image-container"><a href="<?= $postUrl ?>"><img src="<?= $this->post->imageUrl() ?>" /></a></div>
</div>
