<?php

namespace Modules\Role\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert(['key' => 'read-product', "title" => "مشاهده محصولات"]);
        DB::table('permissions')->insert(['key' => 'add-product', "title" => "افزودن محصولات"]);
        DB::table('permissions')->insert(['key' => 'edit-product', "title" => "ویرایش محصولات"]);
        DB::table('permissions')->insert(['key' => 'delete-product', "title" => "حذف محصولات"]);
        DB::table('permissions')->insert(['key' => 'read-role', "title" => "مشاهده نقش"]);
        DB::table('permissions')->insert(['key' => 'add-role', "title" => "افزودن نقش"]);
        DB::table('permissions')->insert(['key' => 'edit-role', "title" => "ویرایش نقش"]);
        DB::table('permissions')->insert(['key' => 'delete-role', "title" => "حذف نقش"]);
        DB::table('permissions')->insert(['key' => 'read-permission', "title" => "مشاهده دسترسی"]);
        DB::table('permissions')->insert(['key' => 'add-permission', "title" => "افزودن دسترسی"]);
        DB::table('permissions')->insert(['key' => 'edit-permission', "title" => "ویرایش دسترسی"]);
        DB::table('permissions')->insert(['key' => 'delete-permission', "title" => "حذف دسترسی"]);
        DB::table('permissions')->insert(['key' => 'read-admin', "title" => "مشاهده ادمین"]);
        DB::table('permissions')->insert(['key' => 'add-admin', "title" => "افزودن ادمین"]);
        DB::table('permissions')->insert(['key' => 'edit-admin', "title" => "ویرایش ادمین"]);
        DB::table('permissions')->insert(['key' => 'delete-admin', "title" => "حذف ادمین"]);
        DB::table('permissions')->insert(['key' => 'edit-adminRole', "title" => "نقش ادمین"]);
        DB::table('permissions')->insert(['key' => 'read-supplier', "title" => "مشاهده تامین کنندگان"]);
        DB::table('permissions')->insert(['key' => 'add-supplier', "title" => "افزودن تامین کنندگان"]);
        DB::table('permissions')->insert(['key' => 'edit-supplier', "title" => "ویرایش تامین کنندگان"]);
        DB::table('permissions')->insert(['key' => 'delete-supplier', "title" => "حذف تامین کنندگان"]);
        DB::table('permissions')->insert(['key' => 'read-supplierFactor', "title" => "مشاهده فاکتور تامین کنندگان"]);
        DB::table('permissions')->insert(['key' => 'add-supplierFactor', "title" => "افزودن فاکتور تامین کنندگان"]);
        DB::table('permissions')->insert(['key' => 'edit-supplierFactor', "title" => "ویرایش فاکتور تامین کنندگان"]);
        DB::table('permissions')->insert(['key' => 'delete-supplierFactor', "title" => "حذف فاکتور تامین کنندگان"]);
        DB::table('permissions')->insert(['key' => 'read-user', "title" => "مشاهده کاربران"]);
        DB::table('permissions')->insert(['key' => 'add-user', "title" => "افزودن کاربران"]);
        DB::table('permissions')->insert(['key' => 'edit-user', "title" => "ویرایش کاربران"]);
        DB::table('permissions')->insert(['key' => 'delete-user', "title" => "حذف کاربران"]);



        DB::table('permissions')->insert(['key' => 'read-order', "title" => "مشاهده سفارشات"]);
        DB::table('permissions')->insert(['key' => 'add-order', "title" => "افزودن سفارشات"]);
        DB::table('permissions')->insert(['key' => 'edit-order', "title" => "ویرایش سفارشات"]);
        DB::table('permissions')->insert(['key' => 'delete-order', "title" => "حذف سفارشات"]);

        DB::table('permissions')->insert(['key' => 'read-payment', "title" => "مشاهده پرداختی ها"]);
        DB::table('permissions')->insert(['key' => 'add-payment', "title" => "افزودن پرداختی ها"]);
        DB::table('permissions')->insert(['key' => 'edit-payment', "title" => "ویرایش پرداختی ها"]);
        DB::table('permissions')->insert(['key' => 'delete-payment', "title" => "حذف پرداختی ها"]);

        DB::table('permissions')->insert(['key' => 'read-ticket', "title" => "مشاهده تیکت"]);
        DB::table('permissions')->insert(['key' => 'add-ticket', "title" => "افزودن تیکت"]);
        DB::table('permissions')->insert(['key' => 'edit-ticket', "title" => "ویرایش تیکت"]);
        DB::table('permissions')->insert(['key' => 'delete-ticket', "title" => "حذف تیکت"]);

        DB::table('permissions')->insert(['key' => 'edit-about', "title" => "ویرایش درباره ما"]);
        DB::table('permissions')->insert(['key' => 'edit-term', "title" => "ویرایش قوانین"]);
        DB::table('permissions')->insert(['key' => 'edit-siteInfo', "title" => "ویرایش تنظیمات سایت "]);



        DB::table('permissions')->insert(['key' => 'add-blog', "title" => "افزودن بلاگ"]);
        DB::table('permissions')->insert(['key' => 'edit-blog', "title" => "ویرایش بلاگ"]);
        DB::table('permissions')->insert(['key' => 'delete-blog', "title" => "حذف بلاگ"]);


        DB::table('permissions')->insert(['key' => 'add-slider', "title" => "افزودن اسلایدر"]);
        DB::table('permissions')->insert(['key' => 'edit-slider', "title" => "ویرایش اسلایدر"]);
        DB::table('permissions')->insert(['key' => 'delete-slider', "title" => "حذف اسلایدر"]);


        DB::table('permissions')->insert(['key' => 'add-banner', "title" => "افزودن بنر"]);
        DB::table('permissions')->insert(['key' => 'edit-banner', "title" => "ویرایش بنر"]);
        DB::table('permissions')->insert(['key' => 'delete-banner', "title" => "حذف بنر"]);

        DB::table('permissions')->insert(['key' => 'read-transaction', "title" => "نمایش لیست پرداختی ها"]);


        DB::table('permissions')->insert(['key' => 'add-discount', "title" => "افزودن تخفیف"]);
        DB::table('permissions')->insert(['key' => 'edit-discount', "title" => "ویرایش تخفیف"]);
        DB::table('permissions')->insert(['key' => 'delete-discount', "title" => "حذف تخفیف"]);
        // DB::table('permissions')->insert(['key' => 'read-discount', "title" => "نمایش تخفیف"]);
    }
}
