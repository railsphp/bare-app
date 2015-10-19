<div class="ad-320">
    <div style="width: 320px; height:60px;background-color:gray;text-align:center; margin-left: auto; margin-right: auto;">
        MI PROPAGANDA
    </div>
</div>

<div class="post-show-container">
    <input type="hidden" id="post-id" value="<?= $this->post->id() ?>" />

    <div class="post-nav-arrows">
        <div class="arrow-box arrow-box-next">
            <div class="arrow-container">
                <a href="#" title="Siguiente imagen"><span class="glyphicon glyphicon-chevron-left"></span></a>
            </div>
        </div>
        <div class="arrow-box arrow-box-prev">
            <div class="arrow-container">
                <a href="#" title="Imagen anterior"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
    </div>
    
    <div class="post-show">
        
        <h1 class="post-title"><?= $this->post->title() ?></h1>
        <div class="post-image-container"><img class="post-image" src="<?= $this->post->imageUrl() ?>" /></div>
        
        <?php
        /*
        <div class="post-meta">
          <small>
            <span>Publicado hace <?= $this->timeAgoInWords($this->post->publishedAt()) ?> por <?= $this->linkTo($this->h($this->post->user()->username()), ['users#show', 'id' => $this->post->user()->id()]) ?></span>
            <?php
            // if ($this->post->tags()->any()) {
                // echo $this->partial('tags', ['post' => $this->post]);
            // }
            ?>
          </small>
        </div>
        */
        ?>
    </div>
    
    <?= ''//$this->partial('ads/square') ?>
</div>

<div class="share-post">
    <div class="share-srv">
        <?= $this->imageTag('ico-fb.png') ?>
    </div>
    <div class="share-srv">
        <?= $this->imageTag('ico-gp.png') ?>
    </div>
    <div class="share-srv">
        <?= $this->imageTag('ico-tt.png') ?>
    </div>
    <div class="share-srv">
        <?= $this->imageTag('ico-wa.png') ?>
    </div>
    <div class="share-srv">
        <?= $this->imageTag('ico-pin.png') ?>
    </div>
</div>

<script>new PostNav(<?= $this->post->toJson() ?>);</script>
