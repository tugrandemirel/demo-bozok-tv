<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ImageHelper
{
    // Resim Yükleme
    public static function uploadImage($image)
    {
        $folderPath = self::generateImagePath();
        $fileName = self::generateImageName($image);

        // Resmi belirlenen klasöre kaydet
        $path = $image->storeAs($folderPath, $fileName, 'public');
//dd($folderPath, $fileName, $path);
        // Görsel bilgilerini al ve array olarak döndür
        return self::getImageData($image, $path);
    }

    // Resim Güncelleme
    public static function updateImage($image, ?string $oldImagePath)
    {
        // Eski resmi sil
        if ($oldImagePath  && Storage::disk('public')->exists($oldImagePath)) {
            Storage::disk('public')->delete($oldImagePath);
        }

        // Yeni resmi yükle ve bilgilerini döndür
        return self::uploadImage($image);
    }

    // Resim Silme
    public static function deleteImage($imagePath)
    {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
            return true;
        }

        return false;
    }

    // Görsel bilgilerini döndüren method
    private static function getImageData($image, $path)
    {
        $size = $image->getSize(); // Görsel boyutu
        $mimeType = $image->getMimeType(); // MIME türü
        $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME); // Görsel adı
        $imageExt = $image->getClientOriginalExtension(); // Görsel uzantısı

        // Görselin genişlik ve yüksekliğini almak için yol kullanılıyor
        $absolutePath = Storage::disk('public')->path($path);

        list($width, $height) = getimagesize($absolutePath);

        return [
            'image_name' => $imageName,
            'image_ext' => $imageExt,
            'size' => $size,
            'path' => $path,
            'alt_text' => null, // Başlangıçta boş olabilir, isteğe göre güncellenir
            'width' => $width,
            'height' => $height,
            'mime_type' => $mimeType,
        ];
    }

    // Klasör yapısını oluşturma (Yıl/Ay/Gün/Saat/ID)
    private static function generateImagePath()
    {
        $now = Carbon::now();
        return $now->year . '/' . $now->month . '/' . $now->day . '/' . $now->hour;
    }

    // Benzersiz resim ismi oluşturma
    private static function generateImageName($image)
    {
        $image_extension = $image->getClientOriginalExtension();
        $hashed_name = str_replace(['/', '.'], '-', hash('sha256', Str::uuid()->toString()));
        return $hashed_name . '.' . $image_extension;
    }
}
