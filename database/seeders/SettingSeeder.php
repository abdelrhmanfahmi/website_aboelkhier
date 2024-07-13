<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'key' => 'email_site',
            'value' => 'asmaa@gmail.com',
            'image' => '',
        ]);

        Setting::create([
            'key' => 'phone_site',
            'value' => '+201123635566',
            'image' => '',
        ]);

        Setting::create([
            'key' => 'facebook_link',
            'value' => '',
            'image' => '',
        ]);

        Setting::create([
            'key' => 'twitter_link',
            'value' => '',
            'image' => '',
        ]);

        Setting::create([
            'key' => 'instagram_link',
            'value' => '',
            'image' => '',
        ]);

        Setting::create([
            'key' => 'about_us',
            'value' => 'شركة ترجمة معتمدة متخصصة في تقديم خدمات الترجمة والتعريب ويقع مقرها الرئيسي بالقاهرة. تأسست ترست للترجمة عام 2010 لتفي باحتياجات عملاءها الكرام من مختلف الخدمات اللغوية. لم تكتفِ شركة ترست بتقديم خدمات ترجمة معتمدة ومتخصصة فحسب، ولكنها أستطاعت خلال مدة قصيرة الأجل أن تَبرز وسط زخم الكثير ممن يقدمون الخدمات ذاتها في سوق الترجمة وذلك بفضل جدارة مترجموها وخبراتهم الواسعة في مجالات الترجمة المختلفة ودرايتهم بثقافات كل لغة يترجمون منها أو إليها وهو ما يشهد به عملاؤنا الكرام. كما أن ترست دومًا ما تعمل وفقًا لمعايير منظمة الأيزو العالمية 17100 حيث أننا نتفهم أن ترجمة مستنداتك تتطلب حلًا مناسبًا ومخصصًا بنهج فردي ومعرفة متعمقة بمجال عملك مما يجعل الترجمة تتمتع بالموثوقية.',
            'image' => '',
        ]);

        Setting::create([
            'key' => 'about_us_image',
            'value' => '',
            'image' => '',
        ]);

        Setting::create([
            'key' => 'logo',
            'value' => '',
            'image' => '',
        ]);
    }
}
