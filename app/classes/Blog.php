<?php


namespace App\classes;


class Blog
{
    protected $title;
    protected $authorName;
    protected $description;
    protected $image;
    protected $imageName;
    protected $directory;
    protected $filename;
    protected $file;
    protected $data;
    protected $array;
    protected $array1;
    protected $array2;
public function __construct($post=null)
{
//    echo '<pre>';
//    print_r($post);
//    exit();
//    print_r($_FILES);
    if($post){
        $this->title =$post['title'];
        $this->authorName =$post['author_name'];
        $this->description =$post['description'];
    }

}
public function index()
{
    $this->image = $this->imageupload();
    $this->filename='db.txt';
    $this->file=fopen('db.txt','a');
    $this->data = "$this->title,$this->authorName,$this->description,$this->image$";
    fwrite($this->file, $this->data);
    fclose($this->file);
    return 'Data saved successfully';
}

protected function imageupload(){
    $this->imageName= $_FILES['image']['name'];
    $this->directory= 'assets/img/upload/'.$this->imageName;
    move_uploaded_file($_FILES['image']['tmp_name'], $this->directory);
    return $this->directory;
}
public function getAllBlogs()
    {
       $this->filename='db.txt';
       $this->data = file_get_contents($this->filename);
       $this->array = explode('$',$this->data);
       echo '<pre>';
       foreach ($this->array as $key => $value)
       {
          $this->array2 = explode(',',$value);
          if($this->array2[0])
          {
              $this->array1[$key]['title']=$this->array2[0];
              $this->array1[$key]['author']=$this->array2[1];
              $this->array1[$key]['description']=$this->array2[2];
              $this->array1[$key]['image']=$this->array2[3];
          }


       }
       return $this->array1;

    }

}