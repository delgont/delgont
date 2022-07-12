<?php

namespace Delgont\Cms\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

use Delgont\Cms\Models\Page\Page;


class PageSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'page:sync {--fresh} {--key=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronise pages with the default content in data config file.';

    protected $pages;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->pages = config('data.pages', []);

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        if(count($this->pages)){
            if ($this->option('fresh')) {
                # code...
                Page::where('created_at', '<', now())->delete();
                $this->sync();
            } else {
                # code...
                if($this->option('key')){
                    $key = $this->option('key');
                    for ($i=0; $i < count($this->pages) ; $i++) { 
                        # code...
                        if($this->pages[$i]['page_key'] == $key){
                            Page::updateOrCreate([
                                'page_title' => (array_key_exists('page_title', $this->pages[$i])) ?  $this->pages[$i]['page_title'] : Str::random(10),
                                'page_key' => (array_key_exists('page_key', $this->pages[$i])) ?  str_replace(' ', '-', $this->pages[$i]['page_title']) : str_replace(' ', '-', $this->pages[$i]['page_title']),
                                'page_content' => (array_key_exists('page_content', $this->pages[$i])) ?  $this->pages[$i]['page_content'] : null,
                                'extract_text' => (array_key_exists('extract_text', $this->pages[$i])) ?  $this->pages[$i]['extract_text'] : null,
                                'post_type' => (array_key_exists('post_type', $this->pages[$i])) ?  $this->pages[$i]['post_type'] : 'post_type',
                                'page_featured_image' => (array_key_exists('page_featured_image', $this->pages[$i])) ?  $this->pages[$i]['page_featured_image'] : null,
                            ]);
                            $this->info('@# '.$this->pages[$i]['page_key'].' Page Sychronised Successfully .....');
                            return;
                        }else{
                            $this->info('That key was not found ....!');
                        }
                    }
                }else{
                    $this->sync();
                }
            }
            
            return;
        }
        $this->info('No options to sync');

    }

    private function sync()
    {
        for ($i=0; $i < count($this->pages) ; $i++) { 
            # code...
            Page::updateOrCreate([
                'page_title' => (array_key_exists('page_title', $this->pages[$i])) ?  $this->pages[$i]['page_title'] : Str::random(10),
                'page_key' => (array_key_exists('page_key', $this->pages[$i])) ?  str_replace(' ', '-', $this->pages[$i]['page_key']) : str_replace(' ', '-', $this->pages[$i]['page_key']),
                'page_content' => (array_key_exists('page_content', $this->pages[$i])) ?  $this->pages[$i]['page_content'] : null,
                'extract_text' => (array_key_exists('extract_text', $this->pages[$i])) ?  $this->pages[$i]['extract_text'] : null,
                'post_type' => (array_key_exists('post_type', $this->pages[$i])) ?  $this->pages[$i]['post_type'] : 'post_type',
                'page_featured_image' => (array_key_exists('page_featured_image', $this->pages[$i])) ?  $this->pages[$i]['page_featured_image'] : null,
            ]);
            $this->info('@# '.$this->pages[$i]['page_key'].' Page Sychronised Successfully .....');
            //(array_key_exists('post_icon', $data[$i])) ? $post->icon()->create(['icon' => $data[$i]['post_icon']]) : null;

        }
        $this->info('Pages sychronized successfully ....!');

    }

    
}
