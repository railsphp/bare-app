<?php
class PostsController extends Rails\ActionController\Base
{
    public function index()
    {
        if ($this->request()->format() == 'json') {
            $offsetId = $this->params->offset_id ?: 1;
            
            // $
            // if ($offsetId == 11) {
                // $limit = rand(0, 3);
                // $limit = 0;
            // } elseif ($offsetId > 11) {
                // $limit = 0;
            // } else {
                // $limit = 5;
            // }
            
            // $this->posts = $this->createCollection($offsetId, $limit, $this->params->dir);
            $this->posts = $this->createCollection(1, 50, $this->params->dir);
            
            $length = 5;
            
            if ($this->params->dir == 'prev') {
                // $offsetIndex = $offsetId;
                // $offsetIndex = $offsetId + $length;
                $offsetIndex = $offsetId - $length - 1;
                if ($offsetIndex < 0) {
                    $offsetIndex = 0;
                }
                // vpe($offsetIndex);
                // $offsetIndex = $offsetId - $length - 1;
                // $this->posts->replace(array_slice($this->posts->toArray(), $offsetIndex, $length));
            } else {
                $offsetIndex = $offsetId;
                
                // if ($offsetIndex < 0) {
                    // $offsetIndex = 0;
                // }
                // vpe($offsetIndex, $length, $this->posts->count());
            }
            
            $pasts = [];
            $posts = $this->posts->toArray();
            if ($this->params->dir == 'prev') {
                $posts = array_reverse($posts);
            } 
            foreach ($posts as $post) {
                if ($this->params->dir == 'prev') {
                    if ($post->id() < $offsetId) {
                        $pasts[] = $post;
                    }
                } else {
                    if ($post->id() > $offsetId) {
                        $pasts[] = $post;
                    }
                }
                if (count($pasts) > $length) {
                    break;
                }
            }
            if ($this->params->dir == 'prev') {
                $pasts = array_reverse($pasts);
            } 
            
            // vpe($this->posts);
            // vpe(array_slice($this->posts->toArray(), $offsetIndex, $length), $offsetIndex, $length);
            // $this->posts->replace(array_slice($this->posts->toArray(), $offsetIndex, $length));
            $this->posts->replace($pasts);
            $this->render(['json' => $this->posts]);
        } else {
            $this->posts = $this->createCollection();
        }
    }
    
    public function show()
    {
        $basePath = $this->pathFor('base');
        $this->post = new Post([
            'id' => $this->params->id,
            'title' => 'Long image',
            // 'imageUrl' => $basePath . '/imgs/long.jpg',
            'imageUrl' => $basePath . '/imgs/small.jpg'
        ]);
    }
    
    public function getImages()
    {
        $page = $this->params->page ?: 1;
        $resp = [];
        
        if ($page < 5) {
            foreach ($this->createCollection() as $post) {
                $resp[] = $post->toApi($this->routeSet());
            }
        }
        
        $this->render(['json' => $resp]);
    }
    
    protected function createCollection($offset = 1, $limit = 50, $dir = 'prev')
    {
        if (!$limit) {
            return [];
        }
        
        $basePath = $this->pathFor('base');
        
        $posts = [];
        $attrs = [
            [
                'title' => 'Long image',
                'imageUrl' => $basePath . '/imgs/long.jpg',
                // 'imageUrl' => $basePath . '/imgs/small.jpg'
            ],
            [
                'title' => 'Small image',
                'imageUrl' => $basePath . '/imgs/small.jpg',
            ],
            [
                'title' => 'Wide image',
                'imageUrl' => $basePath . '/imgs/wide.jpg',
                // 'imageUrl' => $basePath . '/imgs/small.jpg'
            ],
        ];
        
        // if ($dir == 'prev') {
            // for ($i = $offset; $i <= $offset + $limit; $i++) {
                // $postAttrs = $attrs[array_rand($attrs)];
                // $postAttrs['id'] = $i;
                
                // $posts[] = new Post($postAttrs);
            // }
            for ($i = $limit; $i >= 0; $i--) {
                $postAttrs = $attrs[array_rand($attrs)];
                $postAttrs['id'] = $i + 1;
                
                $posts[] = new Post($postAttrs);
            }
        // } else {
            // for ($i = $offset; $i >= $offset - $limit; $i--) {
                // if ($i < 0) {
                    // break;
                // }
                // $postAttrs = $attrs[array_rand($attrs)];
                // $postAttrs['id'] = $i;
                
                // $posts[] = new Post($postAttrs);
            // }
        // }
        
        // $posts = [
            // new Post([
                // 'id' => 1,
                // 'title' => 'Long image',
                // 'imageUrl' => $basePath . '/imgs/long.jpg',
            // ]),
            // new Post([
                // 'id' => 2,
                // 'title' => 'Small image',
                // 'imageUrl' => $basePath . '/imgs/small.jpg',
            // ]),
            // new Post([
                // 'id' => 3,
                // 'title' => 'Wide image',
                // 'imageUrl' => $basePath . '/imgs/wide.jpg',
            // ]),
            // new Post([
                // 'id' => 4,
                // 'title' => 'Small image',
                // 'imageUrl' => $basePath . '/imgs/small.jpg',
            // ]),
        // ];
        // shuffle($posts);
        // if ($dir == 'next') {
            $posts = array_reverse($posts);
        // }
        return new Rails\ActiveModel\Collection($posts);
    }
}
