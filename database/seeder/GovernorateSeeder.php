<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $governorates =[
                'القاهرة',
                'الجيزة',
                'الأسكندرية',
                'الدقهلية',
                'البحر الأحمر',
                'البحيرة',
                'الفيوم',
                'الغربيه',
                'الإسماعلية',
                'المنوفية',
                'المنيا',
                'القليوبية',
                'الوادي الجديد',
                'السويس',
                'اسوان',
                'اسيوط',
                'بني سويف',
                'بورسعيد',
                'دمياط',
                'الشرقية',
                'جنوب سيناء',
                'كفر الشيخ',
                'مطروح',
                'الأقصر',
                'قنا',
                'شمال سيناء',
                'سوهاج',
            ];
    foreach ($governorates as $governorate){
        \App\Starter\Governorates\Governorate::updateOrCreate(['name'=>$governorate]);

    }
    }
}
