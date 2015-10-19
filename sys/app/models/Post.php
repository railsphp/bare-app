<?php
class Post
{
    protected $id;
    protected $title;
    protected $imageUrl;
    
    public function __construct(array $data)
    {
        $this->id       = $data['id'];
        $this->title    = $data['title'];
        $this->imageUrl = $data['imageUrl'];
    }
    
    public function id()
    {
        return $this->id;
    }
    
    public function title()
    {
        return $this->title;
    }
    
    public function imageUrl()
    {
        return $this->imageUrl;
    }
    
    public function toApi($routeSet)
    {
        $json = $this->asJson();
        $json['showUrl'] = $routeSet->urlFor(['posts#show', 'id' => $this->id()]);
        return $json;
    }
    
    public function asJson()
    {
        return [
            'id'       => $this->id,
            'title'    => $this->title,
            'imageUrl' => $this->imageUrl,
        ];
    }
    
    public function toJson()
    {
        return json_encode($this->asJson());
    }
}
