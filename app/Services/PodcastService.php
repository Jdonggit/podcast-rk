<?php

namespace App\Services;

use App\Repositories\PodcastRepository;
use Yish\Generators\Foundation\Service\Service;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class PodcastService extends Service
{
    protected $repository;

    protected $plats_url = [
        'apple' => 'https://chartable.com/charts/itunes/tw-all-podcasts-podcasts',
        'spotify' => 'https://chartable.com/charts/spotify/taiwan-top-podcasts'
    ];

    public function __construct(PodcastRepository $podcastRepo)
    {
        $this->repository = $podcastRepo;
    }

    public function get_podcast($plats = array('apple','spotify'))
    {
        $all_data = array();
        foreach ($plats as $id => $plat) {
            $res = Http::get($this->plats_url[$plat]); 

            $crawler = new Crawler($res->body());
            $data = array();
            // 排名
            $rankValues = $crawler->filter('td > .b')->each(function (Crawler $node, $i) {
                return $node->text();
            });

            foreach ($rankValues as $key => $value) {
                $data[$key]['rank'] =  $value;
                $data[$key]['plat'] =  $id;
                $data[$key]['date'] =  date('Y-m-d');
            }
            // 上下幅度
            $updownValues = $crawler->filter('td > .tc.mt1')->each(function (Crawler $node, $i) {
                return $node->text();
            });

            foreach ($updownValues as $key => $value) {
                $data[$key]['updown'] =  $value;
            }

            // 圖片
            // $imageValues = $crawler->filter('td > .tc > a > img')->each(function (Crawler $node, $i) {
            //     return ($node->attr('data-src')) ? $node->attr('data-src') : '' ;
            // });
            $imageValues = $crawler->filter('.v-top > .tc')->each(function (Crawler $node, $i){
            
                $a = $node->filter('a > img')->count();
                if($a == 1){
                    return $node->filter('a > img')->attr('data-src'); 
                }else{
                    return null; 
                }
            });
            foreach ($imageValues as $key => $value) {
                $data[$key]['img_src'] =  $value;
            }

            // podcast 名稱
            $podcastValues = $crawler->filter('td > .title')->each(function (Crawler $node, $i) {
                return $node->text();
            });

            foreach ($podcastValues as $key => $value) {
                $data[$key]['name'] =  $value;
            }

            // podcast 作者
            $authorValues = $crawler->filter('td > .b')->each(function (Crawler $node, $i) {
                $td = $node->closest('td')->nextAll();
                $a = $td->filter('.silver')->count();
                if($a == 1){
                    return $td->filter('.silver')->text(); 
                }else{
                    return null; 
                }
            });

            foreach ($authorValues as $key => $value) {
                $data[$key]['author'] =  $value;
            }
            $all_data[] = $data;
            
            $this->repository->insert($data);
        }
        

    }
}
