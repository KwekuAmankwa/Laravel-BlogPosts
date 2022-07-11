<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\BlogPost;

class PostTest extends TestCase
{

    use RefreshDatabase;

    public function test_NoBlogPostWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('');
    }

    public function test_See1BlogPostWhenThereIs1()
    {
        //Arrange
        $post = new BlogPost();
        $post->title ='New Title';
        $post->content = 'Content of blog post';
        $post->save();

        //Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText('New Title');

        $this->assertDatabaseHas('blog_posts',[
            'title' => 'New Title'
        ]);
    }
}
