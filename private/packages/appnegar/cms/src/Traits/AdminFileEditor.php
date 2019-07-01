<?php

namespace Appnegar\Cms\Traits;
use Storage;

trait AdminFileEditor{
    protected function saveImage($file, $config, $quality = 100)
    {
        $error_massages = [];
        $name = null;
        if ($file) {
            if (!$file->isValid()) {
                $error_massages[] = $file->getError();
            } else {
                if ($file->getClientSize() > $config['size'] * 1024) {
                    $error_massages[] = "اندازه عکس بیشتر از " . $config['size'] . ' کیلو بایت نمی تواند باشد.';
                }
                $photo_extension = explode(',', $config['extension']);
                foreach ($photo_extension as $key => $value) {
                    $photo_extension[$key] = trim($value);
                }
                if (!in_array($file->getClientOriginalExtension(), $photo_extension)) {
                    $error_massages[] = "فرمت عکس غیر مجاز است";
                }
            }

            if (count($error_massages) == 0) {
                $name = uniqid('img_') . '.' . $file->getClientOriginalExtension();
                $img = \Intervention\Image\Facades\Image::make($file->getPathname())
                    ->resize($config['width'], null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->fit($config['width'], $config['height']);
                $status = Storage::put($config['destination'] . $name, $img->encode($file->getClientOriginalExtension(), $quality), 'public');
                if ($status) {
                    return (['status' => $status, 'data' => $name]);
                } else {
                    return (['status' => $status, 'data' => ['خطایی در دخیره ی عکس بوجود امده است.']]);
                }

            } else {
                return (['status' => false, 'data' => $error_massages]);
            }
        }
        return (['status' => true, 'data' => $name]);
    }

    protected function saveFile($file, $config, $prefix = 'file_')
    {
        $error_massages = [];
        $name = null;
        if ($file) {
            if (!$file->isValid()) {
                $error_massages[] = $file->getError();
            } else {
                if ($file->getClientSize() > $config['size'] * 1024) {
                    $error_massages[] = 'اندازه فایل بیشتر از ' . $config['size'] . ' کیلو بایت نمی تواند باشد.';
                }
                $photo_extension = explode(',', $config['extension']);
                foreach ($photo_extension as $key => $value) {
                    $photo_extension[$key] = trim($value);
                }
                if (!in_array($file->getClientOriginalExtension(), $photo_extension)) {
                    $error_massages[] = "فرمت فایل غیر مجاز است";
                }
            }

            if (count($error_massages) === 0) {
                $name = uniqid($prefix) . '.' . $file->getClientOriginalExtension();
                $status = Storage::putFileAs($config['destination'], $file, $name, 'public');
                if ($status) {
                    return ['status' =>$status, 'data' => $name];
                } else {
                    return ['status' => $status, 'data' => ['خطایی در دخیره ی فایل بوجود امده است.']];
                }

            } else {
                return ['status' => false, 'data' => $error_massages];
            }
        }
        return ['status' => true, 'data' => $name];
    }

    /**
     * @param Request $request
     * @param array $images array of image_keys and image_file_names
     * @return array
     */
    protected function saveImages($request, $images)
    {

        $status = true;
        $errors = [];
        $image_names = [];
        $response = null;
        foreach ($images as $key => $image) {
            $file = $request->file($image);
            $image_status = $this->saveImage($file, $this->config[$key]);
            if ($image_status['status'] == false) {
                $errors[$key] = $image_status['data'];
                $status = false;
            } else {
                $image_names[$key] = $image_status['data'];
            }
        }

        if ($status == false) {
            $response['errors'] = $errors;
            $response['message'] = "The given data was invalid.";
            if (count($image_names) > 0) {
                foreach ($image_names as $key => $name) {
                    $this->deleteFile($this->config[$key]['destination'] . $name);
                }
            }

        }
        return [
            'status' => $status,
            'image_names' => $image_names,
            'response' => $response
        ];
    }

    protected function deleteFile($path)
    {
//        dd($path);
        $status = true;
        if ($path != null and strpos($path, 'default') == false) {
            $path = str_replace('/storage', "", $path);
            $status = Storage::delete($path);
        }
        return $status;
    }
}