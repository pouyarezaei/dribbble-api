<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();
        $array = ['Popular Tags', '2d', '3d', 'abstract', 'adobe', 'adobe illustrator', 'adobe xd', 'advertising', 'after effects', 'agency', 'android', 'animal', 'animals', 'animated', 'animation', 'app', 'app design', 'apparel', 'apple', 'application', 'architecture', 'art', 'art direction', 'artist', 'artwork', 'background', 'badge', 'banner', 'beer', 'bird', 'black', 'black and white', 'blog', 'blue', 'book', 'brand', 'brand design', 'brand identity', 'branding', 'branding design', 'brush', 'building', 'business', 'business card', 'button', 'c4d', 'calendar', 'calligraphy', 'car', 'card', 'cards', 'cartoon', 'cat', 'challenge', 'character', 'character design', 'chart', 'chat', 'christmas', 'cinema 4d', 'cinema4d', 'circle', 'city', 'clean', 'coffee', 'collage', 'color', 'colorful', 'colors', 'company', 'concept', 'corporate', 'cover', 'creative', 'custom', 'cute', 'daily', 'daily ui', 'dailyui', 'dark', 'dashboard', 'data', 'debut', 'design', 'designer', 'desktop', 'digital', 'digital art', 'digital illustration', 'digitalart', 'dog', 'doodle', 'download', 'draw', 'drawing', 'dribbble', 'ecommerce', 'editorial', 'education', 'elegant', 'event', 'face', 'fashion', 'figma', 'finance', 'fish', 'fitness', 'flat', 'flat design', 'flower', 'flowers', 'flyer', 'font', 'food', 'football', 'form', 'free', 'freebie', 'fun', 'game', 'gaming', 'geometric', 'gif', 'girl', 'gold', 'gradient', 'graphic', 'graphic design', 'graphic design', 'graphicdesign', 'graphics', 'green', 'grid', 'halloween', 'hand', 'hand drawn', 'hand lettering', 'handlettering', 'happy', 'health', 'heart', 'home', 'homepage', 'house', 'icon', 'iconography', 'icons', 'identity', 'illustraion', 'illustration', 'illustration art', 'illustrations', 'illustrator', 'infographic', 'ink', 'inspiration', 'instagram', 'interaction', 'interface', 'invitation', 'invite', 'ios', 'ipad', 'iphone', 'isometric', 'kids', 'label', 'landing', 'landing page', 'landingpage', 'landscape', 'layout', 'letter', 'lettering', 'letters', 'light', 'line', 'lines', 'login', 'logo', 'logo design', 'logodesign', 'logomark', 'logos', 'logotype', 'loop', 'love', 'magazine', 'man', 'map', 'mark', 'marketing', 'mascot', 'menu', 'minimal', 'minimalism', 'minimalist', 'mobile', 'mobile app', 'mobile ui', 'mockup', 'modern', 'money', 'monogram', 'moon', 'motion', 'motion design', 'motion graphics', 'mountain', 'movie', 'music', 'nature', 'navigation', 'night', 'orange', 'packaging', 'page', 'painting', 'paper', 'pattern', 'pencil', 'people', 'photo', 'photography', 'photoshop', 'pink', 'portfolio', 'portrait', 'poster', 'print', 'procreate', 'product', 'product design', 'profile', 'psd', 'purple', 'red', 'redesign', 'render', 'responsive', 'restaurant', 'retro', 'script', 'sea', 'search', 'shapes', 'shop', 'simple', 'site', 'sketch', 'skull', 'social', 'space', 'sport', 'sports', 'stars', 'sticker', 'store', 'summer', 'sun', 'symbol', 't-shirt', 'technology', 'template', 'texture', 'travel', 'tree', 'type', 'typeface', 'typography', 'ui', 'ui ux', 'ui design', 'uidesign', 'uiux', 'user experience', 'user interface', 'ux', 'ux design', 'uxdesign', 'vector', 'vector art', 'video', 'vintage', 'visual design', 'water', 'watercolor', 'web', 'web design', 'webdesign', 'website', 'website design', 'wedding', 'white', 'wip', 'woman', 'wood', 'wordpress', 'work', 'yellow'];
        foreach ($array as $ele) {
            Tag::create(['tag' => $ele, 'count' => 0]);
        }



    }
}
