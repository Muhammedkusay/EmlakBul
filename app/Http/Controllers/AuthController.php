<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request) {

        // delete tmp images from database and folders
        function deleteTmpImage() {
            $temporaryImages = TemporaryFile::all();
            if($temporaryImages) {
                Storage::deleteDirectory('images/tmp');
                TemporaryFile::truncate();
            }
        }

        $request->validate([
            'kullanici_tipi' => 'required'
        ],
        [
            'kullanici_tipi.required' => 'Lütfen üyelik tipini seçiniz'
        ]);

        if($request->kullanici_tipi == 'bireysel') {
            $request->validate([
                'ad' => ['required'], 
                'soyad' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8', 'regex:/[0-9]/'],
                'confirm_password' => ['required', 'same:password'],
            ], 
            [
                'ad.required' => 'Ad alanını boş bırakmayın',
                'soyad.required' => 'Soyad alanını boş bırakmayın',
                'email.required' => 'E-posta alanını boş bırakmayın',
                'email.email' => 'Lütfen geçerli E-posta giriniz',
                'password.required' => 'Lütfen şifre alnını boş bırakmayın',
                'password.min' => 'Şifre en 8 karakter olmalıdır',
                'password.regex' => 'Şifre en az bir rakam içermelidir',
                'confirm_password.required' => 'Lütfen şifreyi tekrar giriniz',
                'confirm_password.same' => 'Şifre alanları uyuşmuyor, tekrar giriniz',
            ]);

            $user = User::where('email', $request->email)->first();

            if($user) {
                return to_route('user-register.get')->with('error', 'Girdiğiniz bilgiler başka kişi tarafından kullanılmaktadır');
            }

            $user = User::create([
                'ad' => $request->ad,
                'soyad' => $request->soyad,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'kullanici_tipi' => $request->kullanici_tipi,
            ]);

            if($user) return to_route('login.get')->with('success', 'Kayıt başarıyla gerçekleştirildi');
            else return to_route('user-register.get')->with('error', 'Kayıt işlemi esnasında bir hata oluştu');

        }
        
        else if($request->kullanici_tipi == 'kurum') {

            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8', 'regex:/[0-9]/'],
                'confirm_password' => ['required', 'same:password'],
                'il' => ['required'],
                'ilce' => ['required'],
                'kurum_adi' => ['required'],
                'tel' => ['required', 'min:10', 'max:11'],
                'image' => ['required'],
            ]);

            if($validator->fails()) deleteTmpImage();

            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8', 'regex:/[0-9]/'],
                'confirm_password' => ['required', 'same:password'],
                'il' => ['required'],
                'ilce' => ['required'],
                'kurum_adi' => ['required'],
                'tel' => ['required', 'min:10', 'max:11'],
                'image' => ['required'],
            ], 
            [
                'email.required' => 'E-posta alanını boş bırakmayın',
                'email.email' => 'Lütfen geçerli E-posta giriniz',
                'password.required' => 'Lütfen şifre alnını boş bırakmayın',
                'password.min' => 'Şifre en 8 karakter olmalıdır',
                'password.regex' => 'Şifre en az bir rakam içermelidir',
                'confirm_password.required' => 'Lütfen şifreyi tekrar giriniz',
                'confirm_password.same' => 'Şifre alanları uyuşmuyor, tekrar girin',
                'il.required' => 'İl lanını boş bırakmayınız',
                'ilce.required' => 'İlçe lanını boş bırakmayınız',
                'kurum_adi.required' => 'Lütfen kurum adı lanını boş bırakmayın',
                'tel.required' => 'Lütfen telefon numarasını giriniz',
                'tel.min' => 'Lütfen geçerli bir telefon numarasını girin',
                'tel.max' => 'Lütfen geçerli bir telefon numarasını girin',
                'image.required' => 'Lütfen kurum resmini yükleyin',
            ]);

            $user = User::where('email', $request->email)->first();

            if($user) {
                return to_route('user-register.get')->with('error', 'Girdiğiniz bilgiler başka kullanıcı tarafından kullanılmaktadır');
            }

            // store avatar
            $temporary_image = TemporaryFile::first();

            // Correctly copy the image to the public disk
            $destinationPath = 'post_images/' . $temporary_image->folder . '_' . $temporary_image->file;
            Storage::disk('public')->copy(
                'images/tmp/' . $temporary_image->folder . '/' . $temporary_image->file,
                $destinationPath
            );

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'kullanici_tipi' => $request->kullanici_tipi,
                'il' => $request->il,
                'ilce' => $request->ilce,
                'kurum_adi' => $request->kurum_adi,
                'tel' => $request->tel,
                'avatar' => $destinationPath
            ]);

            // Clean up the temporary files and directories
            Storage::deleteDirectory('images/tmp/' . $temporary_image->folder);
            $temporary_image->delete();

            if($user) return to_route('login.get')->with('success', 'Kayıt başarıyla gerçekleştirildi');
            else return to_route('user-register')->with('error', 'Kayıt işlemi esnasında bir hata oluştu');

        }

    }

    public function loginPost(Request $request) {

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], 
        [
            'email.required' => 'Lütfen e-posta adresinizi giriniz',
            'email.email' => 'Lütfen geçerli E-posta giriniz',
            'password.required' => 'Lütfen şifrenizi giriniz',
        ]);

        $user = User::where('email', $request->email)->first();

        if( !$user )
            return to_route('login.get')->with('error', 'Kullanıcı bulunmadı');

        if( !Hash::check($request->password, $user->password) )
            return to_route('login.get')->with('error', 'Hatalı şifre');

        Auth::login($user);

        return to_route('feed');
    }

    public function logoutPost() {

        Auth::logout();

        return to_route('feed');
    }

}
