<?php
return function() {
    $this->root('posts#index');
    $this->get('posts/index');
    $this->get('posts/get_images');
    $this->get('posts/:id', 'posts#show');
};
