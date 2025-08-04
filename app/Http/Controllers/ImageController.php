<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use File;

class ImageController extends Controller
{
    /**
     * Summary of compressProfileImages
     * @return string
     */
    public function compressProfileImages()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 1500);
        $sourcePath = public_path('storage/admins/'); // Add trailing slash to the source path
        $destinationPath = public_path('storage/admins/'); // Add trailing slash to the destination path

        // Create the destination directory if it doesn't exist
        File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

        $files = File::allFiles($sourcePath);
        $quantity='0';
        foreach ($files as $file) {
            $image = Image::make($file->getRealPath());

            // Adjust the compression settings as needed
            // $image->resize(null, 300, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });
            $image->heighten(300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            // $image->resizeCanvas(500, null);
            $compressedImageName = $destinationPath . $file->getBasename();
            $image->save($compressedImageName);
            $quantity++;
        }

        return 'Images compressed "'. $quantity.'" and saved at: ' . $destinationPath;
    }
    public function compressNidFrontImages()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 1500);
        $sourcePath = public_path('storage/studentNidFront/'); // Add trailing slash to the source path
        $destinationPath = public_path('storage/studentNidFront/'); // Add trailing slash to the destination path

        // Create the destination directory if it doesn't exist
        File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

        $files = File::allFiles($sourcePath);
        $quantity='0';

        foreach ($files as $file) {
            $image = Image::make($file->getRealPath());

            // Adjust the compression settings as needed
            $image->resize(1920, 1080, function ($constraint) {
                $constraint->aspectRatio();
            });
            $compressedImageName = $destinationPath . $file->getBasename();
            $image->save($compressedImageName);
            $quantity++;
        }

        return 'Images compressed "'. $quantity.'" and saved at: ' . $destinationPath;
    }
    public function compressNidBackImages()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 1500);
        $sourcePath = public_path('storage/studentNidBack/'); // Add trailing slash to the source path
        $destinationPath = public_path('storage/studentNidBack/'); // Add trailing slash to the destination path

        // Create the destination directory if it doesn't exist
        File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

        $files = File::allFiles($sourcePath);
        $quantity='0';

        foreach ($files as $file) {
            $image = Image::make($file->getRealPath());

            // Adjust the compression settings as needed
            $image->resize(1920, 1080, function ($constraint) {
                $constraint->aspectRatio();
            });
            $compressedImageName = $destinationPath . $file->getBasename();
            $image->save($compressedImageName);
            $quantity++;
        }

        return 'Images compressed "'. $quantity.'" and saved at: ' . $destinationPath;
    }
    public function compressSidFrontImages()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 1500);
        $sourcePath = public_path('storage/studentSidFront/'); // Add trailing slash to the source path
        $destinationPath = public_path('storage/studentSidFront/'); // Add trailing slash to the destination path

        // Create the destination directory if it doesn't exist
        File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

        $files = File::allFiles($sourcePath);
        $quantity='0';

        foreach ($files as $file) {
            $image = Image::make($file->getRealPath());

            // Adjust the compression settings as needed
            $image->resize(1920, 1080, function ($constraint) {
                $constraint->aspectRatio();
            });
            $compressedImageName = $destinationPath . $file->getBasename();
            $image->save($compressedImageName);
            $quantity++;
        }

        return 'Images compressed "'. $quantity.'" and saved at: ' . $destinationPath;
    }
    public function compressSidBackImages()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 1500);
        $sourcePath = public_path('storage/studentSidBack/'); // Add trailing slash to the source path
        $destinationPath = public_path('storage/studentSidBack/'); // Add trailing slash to the destination path

        // Create the destination directory if it doesn't exist
        File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

        $files = File::allFiles($sourcePath);
        $quantity='0';

        foreach ($files as $file) {
            $image = Image::make($file->getRealPath());

            // Adjust the compression settings as needed
            $image->resize(1920, 1080, function ($constraint) {
                $constraint->aspectRatio();
            });
            $compressedImageName = $destinationPath . $file->getBasename();
            $image->save($compressedImageName);
            $quantity++;
        }

        return 'Images compressed "'. $quantity.'" and saved at: ' . $destinationPath;
    }
}
