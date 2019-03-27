<?php
use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        Category::truncate();
        Tag::truncate();

        $post = new Post;
        $post->title = "What is Lorem Ipsum?";
        $post->url = str_slug("What is Lorem Ipsum?");
        $post->except = "Lorem Ipsum is simply dummy text of the printing and ";
        $post->body = "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>";
        $post->published_at = Carbon::now()->subDays(1);
        $post->category_id = 1;
        $post->user_id = 1;

        // $post->tags()->attach(Tag::create(['name' => 'etiqueta 1']));

        $post->save();


        $post = new Post;
        $post->title = "What is Lorem dummy printing?";
        $post->url = str_slug("What is Lorem dummy printing?");
        $post->except = "Lorem Ipsum. Lorem Ipsum has been the industry's standard ";
        $post->body = "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>";
        $post->published_at = Carbon::now()->subDays(3);
        $post->category_id = 2;
        $post->user_id = 1;

        // $post->tags()->attach(Tag::create(['name' => 'etiqueta 1']));

        $post->save();


        $post = new Post;
        $post->title = "PageMaker including versions of Lorem Ipsum";
        $post->url = str_slug("PageMaker including versions of Lorem Ipsum");
        $post->except = "Industry's standard dummy text ever";
        $post->body = "<p>Lorem Ipsum is simply dummy text of Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>";
        $post->published_at = Carbon::now()->subDays(10);
        $post->category_id = 2;
        $post->user_id = 2;
        $post->save();

        $post = new Post;
        $post->title = "Including versions of Lorem dummy";
        $post->url = str_slug("PageMaker versions of Lorem Ipsum");
        $post->except = "Industry's dummy text ever";
        $post->body = "<p>Lorem Ipsum is simply dummy text of Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>";
        $post->published_at = Carbon::now()->subDays(5);
        $post->category_id = 1;
        $post->user_id = 2;
        $post->save();

        $categoria = new Category;
        $categoria->name = "Javascript";
        $categoria->save();

        $categoria = new Category;
        $categoria->name = "Wordpress";
        $categoria->save();

        $tag = new Tag;
        $tag->name = "PrimerTag";
        $tag->save();

        $tag = new Tag;
        $tag->name = "SegundoTag";
        $tag->save();

        $tag = new Tag;
        $tag->name = "TercerTag";
        $tag->save();
    }
}
