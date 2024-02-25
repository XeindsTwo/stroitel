<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function generateCaptcha(): void
    {
        $characters = '0123456789abcdefhjkmnpqrstuvwxyz';
        $captchaText = substr(str_shuffle($characters), 0, 7);
        session(['captcha' => $captchaText]);

        $image = imagecreatetruecolor(120, 40);
        $bgColor = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);

        $textColor = imagecolorallocate($image, 0, 0, 0);
        $fontPath = public_path('static/fonts/Inter-Medium.woff');
        imagettftext($image, 20, 0, 10, 30, $textColor, $fontPath, $captchaText);

        for ($i = 0; $i < 1000; $i++) {
            imagesetpixel($image, rand(0, 120), rand(0, 40), $textColor);
        }

        imagefilter($image, IMG_FILTER_SMOOTH, 5);
        imagefilter($image, IMG_FILTER_CONTRAST, -10);

        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
    }

    public function validateCaptcha(Request $request): JsonResponse
    {
        $userCaptcha = $request->input('captcha');
        $captchaText = session('captcha');

        if ($userCaptcha === $captchaText) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
