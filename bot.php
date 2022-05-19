<?php
// =========================== Smoke Team ===========================
error_reporting(0);
// لگاسی سورس ارائه دهنده انواع سورس های ناب ربات تلگرامی است | @LegacySource !
date_default_timezone_set('Asia/Tehran');
use danog\MadelineProto\API;
// =========================== Include's & Create File ===========================
if (!file_exists('madeline.php'))
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
define("MADELINE_BRANCH", "5.1.34");
// لگاسی سورس ارائه دهنده انواع سورس های ناب ربات تلگرامی است | @LegacySource !
include 'madeline.php';
include('jdf.php');
// =========================== Create Photo ===========================
$jpg_image = imagecreatefromjpeg(rand(1,6).'.jpg'); // دریافت یک عکس رندوم
$color = imagecolorallocate($jpg_image, 245,239,248); // تنظیم رنگ
// لگاسی سورس ارائه دهنده انواع سورس های ناب ربات تلگرامی است | @LegacySource !
imagettftext($jpg_image, 120, 0, 155, 370, $color, 'LegacyFont.ttf', date('H:i')); // تنظیم ساعت روی عکس
imagejpeg($jpg_image, 'profile.jpg'); // ساخت و ذخیره عکس
// =========================== MadelineProto Api ===========================
$MadelineProto = new API('bot.madeline' , ['logger' => ['max_size' => 1 * 1024 * 1024]]);
$MadelineProto->async(true);
// لگاسی سورس ارائه دهنده انواع سورس های ناب ربات تلگرامی است | @LegacySource !
$MadelineProto->loop(function () use ($MadelineProto) {
	yield $MadelineProto->start();
// =========================== Codes ===========================
    try {
		$time = date('H:i'); // گرفتن تایم
        yield $MadelineProto->account->updateStatus(['offline'=> false]); // آنلاین نگه داشتن اکانت
        yield $MadelineProto->account->updateProfile(['about' => "• امروز ".jdate('Y/n/j')." و ساعت ".jdate('H:i')." | لگاسی سورس"]); // تنظیم تاریخ و ساعت در بیو
        yield $MadelineProto->account->updateProfile(['last_name' => $time]); // تنظیم ساعت در لست نیم
        if (file_exists('photo')){		
            $lastphoto = yield $MadelineProto->photos->getUserPhotos(['user_id' => 'me', 'offset' => 0, 'limit' => 1 , 'max_id' => 0])['photos']; // گرفتن عکس قبلی
	        yield $MadelineProto->photos->deletePhotos(['id' => $lastphoto]); // حذف عکس قبلی
		}else
		    touch('photo');	
		yield $MadelineProto->photos->updateProfilePhoto(['id' => 'profile.jpg']); // تنظیم عکس جدید
// =========================== Catch ===========================	
	} catch (\Throwable $e) { /*yield $MadelineProto->messages->sendMessage(['peer' => '@aquarvis', 'message' => $e->getMessage()]);*/ } // دریافت خطاها
});
// لگاسی سورس ارائه دهنده انواع سورس های ناب ربات تلگرامی است | @LegacySource !
?>