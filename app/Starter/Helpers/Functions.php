<?php

use App\Starter\Config\Config;
use Stevebauman\Purify\Facades\Purify;

function urlLang($url, $fromlang, $toLang)
{
    $currentUrl = str_replace('/' . $fromlang . '/', '/' . $toLang . '/', strtolower($url));
    return $currentUrl;
}

function getConfigs()
{
    if (\Cache::has('configs')) {
        return \Cache::get('configs');
    } else {
        if (\Schema::hasTable('configs')) {
            $configs = Config::get();
            $arr = [];
            if ($configs) {
                foreach ($configs as $c) {
                    $key = $c->field;
                    $arr[$key][$c->lang] = $c->value;
                }
            }
            Cache::put('configs', $arr, env('CACHE_TIME', now()->addSeconds(24 * 60 * 60)));
        }
    }
}

function appName()
{
    $configs = getConfigs();
    $appName = trans('app.questions-system') ?: env('APP_NAME');
    return $appName;
}

function welcomeMessage()
{
    $configs = getConfigs();
    $appName = (@$configs['welcome'][lang()]) ?: env('APP_NAME');
    return $appName;
}

function getListOfFiles($path)
{
    $out = [];
    $results = scandir($path);
    foreach ($results as $result) {
        if ($result === '.' or $result === '..') {
            continue;
        }
        if (is_dir($result)) {
            $out = array_merge($out, getListOfModel($path . '/' . $result));
        } else {
            $out[] = substr($result, 0, -4);
        }
    }
    return $out;
}

function hideEmail($email)
{
    return '****' . substr($email, 4);
}

function generateImage($text)
{
    $url = 'https://ui-avatars.com/api/?name=' . $text . '&size=100';
    $contents = @file_get_contents($url);
    if ($contents) {
        $filename = strtolower(str_random(10)) . time() . '.png';
        @file_put_contents(public_path() . '/uploads/small/' . $filename, $contents);
        return $filename;
    }
}

function export($data, $labels, $module)
{
    \Maatwebsite\Excel\Facades\Excel::create($module . "_" . date("Y-m-d H:i:s"), function ($excel) use ($data, $labels) {
        $excel->sheet('Sheetname', function ($sheet) use ($data, $labels) {
            $sheet->row(1, $labels);
            $sheet->rows($data);
            $sheet->row(1, function ($row) {
                // call cell manipulation methods
                $row->setFontWeight('bold');
            });
        });
    })->export('xls');
}

function getActivities($type = null)
{
    $rows['nap'] = trans('activities.Nap');
    $rows['meal'] = trans('activities.Meal');
    $rows['note'] = trans('activities.Note');
    $rows['incident'] = trans('activities.Incident');
    $rows['bottle'] = trans('activities.Bottle');
    $rows['mood'] = trans('activities.Mood');
    $rows['medication'] = trans('activities.Medication');
    $rows['bathroom'] = trans('activities.Bathroom');
    $rows['learning'] = trans('activities.Learning');
    $rows['temperature'] = trans('activities.Temperature');
    $rows['feedback'] = trans('activities.Feedback');
    $rows['check_in'] = trans('activities.Check in');
    $rows['check_out'] = trans('activities.Check out');
    $rows['image'] = trans('activities.Image');
    if ($type) {
        return @$rows[$type];
    }
    return $rows;
}

function encodeRequest($request)
{
    $array = [];
    foreach ($request as $k => $r) {
        if (is_array($r)) {
            $array[$k] = json_encode($r);
        } else {
            $array[$k] = $r;
        }
    }
    return $array;
}

function authorize($action)
{
    if (!can($action)) {
        return abort(403, 'Unauthorized action.');
    }
}

function can($action)
{
    if (auth()->user()->hasRole('super_admin')) {
        return true;
    }
    return auth()->user()->can($action);
}

function canWithMultipleAction($actionArr)
{
    $user = auth()->user();
    $data = [];
    if (!$user) {
        if (!request()->header('token')) {
            return false;
        }
        $user = \App\Starter\Users\User::active()->first();
    }
    if ($actionArr) {
        foreach ($actionArr as $key => $action) {
            if ($user || $user->role_id) {
                if ($user->super_admin || in_array($action, $user->role->permissions)) {
                    $data[$action] = true;
                }
            } else {
                $data[$action] = false;
            }
        }
        return $data;
    }
    return true;
}

function checkAllActions($actionArr)
{
    $user = auth()->user();
    if ($actionArr) {
        foreach ($actionArr as $key => $action) {
            if ($user || $user->role_id) {
                if ($user->super_admin || in_array($action, $user->role->permissions)) {
                    return true;
                }
            }
        }
    }
    return false;
}

function getDefaultLang()
{
    if (in_array(request()->segment(1), langs())) {
        return LaravelLocalization::setLocale(request()->segment(1));
    } else {
        if (request()->segment(1) == '') {
            LaravelLocalization::setLocale(lang());
            return LaravelLocalization::setLocale(lang());
        } else {
            return LaravelLocalization::setLocale();
        }
    }
}

function lang()
{
    return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
}

function langs()
{
    $languages = (array_keys(config('laravellocalization.supportedLocales'))) ?: [];
    return $languages;
}

function randString($length = 5)
{
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $randstring = '';
    for ($i = 0; $i < $length; $i++) {
        $randstring .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}

function code()
{
    return date('s') . date('m') . date('d') . date('y') . date('i') . date('H') . strtolower(str_random(2));
}

function languages()
{
    $languages = config('laravellocalization.supportedLocales');
    $langs = [];
    foreach ($languages as $key => $value) {
        $langs[$key] = $value['name'];
    }
    return $langs;
}

function transformValidation($errors)
{
    $temp = [];
    if ($errors) {
        foreach ($errors as $key => $value) {
            $temp[$key] = @$value[0];
        }
    }
    return $temp;
}

function image($img, $type, $folder = 'uploads')
{
    $src = app()->make("url")->to('/') . '/' . $folder . '/' . $type . '/' . $img;
    return $src;
}

function viewImage($img, $type, $folder = 'uploads', $attributes = null)
{
    if (!$folder) {
        $folder = 'uploads';
    }
    $width = 50;
    if ($attributes) {
        $width = @$attributes['width'];
        $class = @$attributes['class'];
        $id = @$attributes['id'];
    }
    $src = $folder . '/' . $type . '/' . $img;
    if (!file_exists($src) || !$img) {
        $src = 'https://via.placeholder.com/500x500';
    } else {
        $src = app()->make("url")->to('/') . '/' . $src;
    }
    return '<img  width="' . $width . '" src="' . $src . '" class="' . @$class . '" id="' . @$id . '" >';
}

function viewFile($file, $folder = 'uploads')
{
    $path = $folder . '/' . $file;
    if (!$file || !file_exists($path)) {
        return '';
    }
    return '<i class="fa fa-paperclip"></i> <a href="' . $path . '" >' . $file . '</a>';
}

function slug($str, $options = array())
{
    // Make sure string is in UTF-8 and strip invalid UTF-8 characters
    $str = mb_convert_encoding((string)$str, 'UTF-8');
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => false,
    );
    // Merge options
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A',
        '??' => 'AE', '??' => 'C',
        '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'I', '??' => 'I',
        '??' => 'I', '??' => 'I',
        '??' => 'D', '??' => 'N', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O',
        '??' => 'O', '??' => 'O',
        '??' => 'O', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U',
        '??' => 'Y', '??' => 'TH',
        '??' => 'ss',
        '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a',
        '??' => 'ae', '??' => 'c',
        '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'i', '??' => 'i',
        '??' => 'i', '??' => 'i',
        '??' => 'd', '??' => 'n', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o',
        '??' => 'o', '??' => 'o',
        '??' => 'o', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'u',
        '??' => 'y', '??' => 'th',
        '??' => 'y',
        // Latin symbols
        '??' => '(c)',
        // Greek
        '??' => 'A', '??' => 'B', '??' => 'G', '??' => 'D', '??' => 'E', '??' => 'Z',
        '??' => 'H', '??' => '8',
        '??' => 'I', '??' => 'K', '??' => 'L', '??' => 'M', '??' => 'N', '??' => '3',
        '??' => 'O', '??' => 'P',
        '??' => 'R', '??' => 'S', '??' => 'T', '??' => 'Y', '??' => 'F', '??' => 'X',
        '??' => 'PS', '??' => 'W',
        '??' => 'A', '??' => 'E', '??' => 'I', '??' => 'O', '??' => 'Y', '??' => 'H',
        '??' => 'W', '??' => 'I',
        '??' => 'Y',
        '??' => 'a', '??' => 'b', '??' => 'g', '??' => 'd', '??' => 'e', '??' => 'z',
        '??' => 'h', '??' => '8',
        '??' => 'i', '??' => 'k', '??' => 'l', '??' => 'm', '??' => 'n', '??' => '3',
        '??' => 'o', '??' => 'p',
        '??' => 'r', '??' => 's', '??' => 't', '??' => 'y', '??' => 'f', '??' => 'x',
        '??' => 'ps', '??' => 'w',
        '??' => 'a', '??' => 'e', '??' => 'i', '??' => 'o', '??' => 'y', '??' => 'h',
        '??' => 'w', '??' => 's',
        '??' => 'i', '??' => 'y', '??' => 'y', '??' => 'i',
        // Turkish
        '??' => 'S', '??' => 'I', '??' => 'C', '??' => 'U', '??' => 'O', '??' => 'G',
        '??' => 's', '??' => 'i', '??' => 'c', '??' => 'u', '??' => 'o', '??' => 'g',
        // Russian
        '??' => 'A', '??' => 'B', '??' => 'V', '??' => 'G', '??' => 'D', '??' => 'E',
        '??' => 'Yo', '??' => 'Zh',
        '??' => 'Z', '??' => 'I', '??' => 'J', '??' => 'K', '??' => 'L', '??' => 'M',
        '??' => 'N', '??' => 'O',
        '??' => 'P', '??' => 'R', '??' => 'S', '??' => 'T', '??' => 'U', '??' => 'F',
        '??' => 'H', '??' => 'C',
        '??' => 'Ch', '??' => 'Sh', '??' => 'Sh', '??' => '', '??' => 'Y', '??' => '',
        '??' => 'E', '??' => 'Yu',
        '??' => 'Ya',
        '??' => 'a', '??' => 'b', '??' => 'v', '??' => 'g', '??' => 'd', '??' => 'e',
        '??' => 'yo', '??' => 'zh',
        '??' => 'z', '??' => 'i', '??' => 'j', '??' => 'k', '??' => 'l', '??' => 'm',
        '??' => 'n', '??' => 'o',
        '??' => 'p', '??' => 'r', '??' => 's', '??' => 't', '??' => 'u', '??' => 'f',
        '??' => 'h', '??' => 'c',
        '??' => 'ch', '??' => 'sh', '??' => 'sh', '??' => '', '??' => 'y', '??' => '',
        '??' => 'e', '??' => 'yu',
        '??' => 'ya',
        // Ukrainian
        '??' => 'Ye', '??' => 'I', '??' => 'Yi', '??' => 'G',
        '??' => 'ye', '??' => 'i', '??' => 'yi', '??' => 'g',
        // Czech
        '??' => 'C', '??' => 'D', '??' => 'E', '??' => 'N', '??' => 'R', '??' => 'S',
        '??' => 'T', '??' => 'U',
        '??' => 'Z',
        '??' => 'c', '??' => 'd', '??' => 'e', '??' => 'n', '??' => 'r', '??' => 's',
        '??' => 't', '??' => 'u',
        '??' => 'z',
        // Polish
        '??' => 'A', '??' => 'C', '??' => 'e', '??' => 'L', '??' => 'N', '??' => 'o',
        '??' => 'S', '??' => 'Z',
        '??' => 'Z',
        '??' => 'a', '??' => 'c', '??' => 'e', '??' => 'l', '??' => 'n', '??' => 'o',
        '??' => 's', '??' => 'z',
        '??' => 'z',
        // Latvian
        '??' => 'A', '??' => 'C', '??' => 'E', '??' => 'G', '??' => 'i', '??' => 'k',
        '??' => 'L', '??' => 'N',
        '??' => 'S', '??' => 'u', '??' => 'Z',
        '??' => 'a', '??' => 'c', '??' => 'e', '??' => 'g', '??' => 'i', '??' => 'k',
        '??' => 'l', '??' => 'n',
        '??' => 's', '??' => 'u', '??' => 'z'
    );
    // Make custom replacements
    $str = preg_replace(
        array_keys($options['replacements']),
        $options['replacements'],
        $str
    );
    // Transliterate characters to ASCII
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    // Replace non-alphanumeric characters with our delimiter
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    // Remove duplicate delimiters
    $str = preg_replace(
        '/(' . preg_quote($options['delimiter'], '/') . '){2,}/',
        '$1',
        $str
    );
    // Truncate slug to max. characters
    $str = mb_substr(
        $str,
        0,
        ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')),
        'UTF-8'
    );
    // Remove delimiter from ends
    $str = trim($str, $options['delimiter']);

    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function pdf($html, $filename)
{
    // // or pure html
    $pdfarr = [
        'title' => $filename,
        'data' => $html, // render file blade with content html
        'header' => ['show' => false], // header content
        'footer' => ['show' => false], // Footer content
        'font' => 'aealarabiya', //  dejavusans, aefurat ,aealarabiya ,times
        'font-size' => 12, // font-size
        'text' => '', //Write
        'rtl' => (lang() == 'ar') ? true : false, //true or false
        // 'creator'=>'phpanonymous', // creator file - you can remove this key
        // 'keywords'=>'phpanonymous keywords', // keywords file - you can remove this key
        // 'subject'=>'phpanonymous subject', // subject file - you can remove this key
        'filename' => $filename . '.pdf', // filename example - invoice.pdf
        'display' => 'download', // stream , download , print
    ];
    return \PDFAnony::HTML($pdfarr);
}

function upload_image($img, $uploadPath = 'uploads')
{
    //TODO::to be enhanced
    $image = request()->file($img);
    $fileName = strtolower(Illuminate\Support\Str::random(10)) . time() . '.' . $image->getClientOriginalExtension();
//    dd($image , $uploadPath ,$fileName);
    request()->file($img)->move($uploadPath, $fileName);
    $filePath = $uploadPath . '/' . $fileName;
    if ($filePath) {
        $imageSizes = ['small' => 'resize,200x200', 'large' => 'resize,400x300'];
        foreach ($imageSizes as $key => $value) {
            $value = explode(',', $value);
            $type = $value[0];
            $dimensions = explode('x', $value[1]);
            if (!Illuminate\Support\Facades\File::exists($uploadPath . '/' . $key)) {
                @mkdir($uploadPath . '/' . $key);
                @chmod($uploadPath . '/' . $key, 0777);
            }
            $thumbPath = $uploadPath . '/' . $key . '/' . $fileName;
            $image = Intervention\Image\Facades\Image::make($filePath);
            if ($type == 'crop') {
                $image->fit($dimensions[0], $dimensions[1]);
            } else {
                $image->resize($dimensions[0], $dimensions[1], function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $image->save($thumbPath);
        }
        return $fileName;
    }
}

function nullArrayStringToNull(array $arr)
{
    foreach ($arr as $key => $element) {
        $arr[$key] = strtolower($element) == "null" ? null : $element;
    }

    return $arr;
}

function nullStringToNull(string $str)
{
    return strtolower($str) == "null" ? null : $str;
}

function formatArrayOfLatLong(array $array)
{
    return array_map(function ($item) {
        $item = explode(' ', $item);
        return ['lat' => floatval($item[0]), 'lng' => floatval($item[1])];
    }, $array);
}


function unauthorize()
{
    return response()->json(
        [
            'status' => '403',
            'title' => 'Permission Denied',
            'detail' => "You don't have permission"
        ],
        403
    );
}


function moveGarbageMedia(array $ids, Object $model, string $column, string $storagePath = 'uploads')
{
    $garbageMedias = \App\Starter\GarbageMedia\GarbageMedia::findOrFail($ids);
    foreach ($garbageMedias as $garbageMedia) {
        $model->{$column} = $storagePath . '/' . $garbageMedia->filename;
        $model->save();
        if (\File::exists(storage_path('/garbage_media/' . $garbageMedia->filename))) {
            \File::move(storage_path('garbage_media/' . $garbageMedia->filename), storage_path($storagePath . '/' . $garbageMedia->filename));
        }
    }
}

function createApiActionButtons($actions)
{
    $returnActions = [];
    foreach ($actions as $action) {
        $returnActions[] = [
            'endpoint_url' => $action['endpoint_url'],
            'target_screen' => $action['target_screen'],
            'label' => $action['label'],

        ];
    }
    return $returnActions;
}
/**
 * build Scope Route
 * @param $route , $param
 * @return route($route, $params)
 */
function buildScopeRoute($route, array $param = [])
{
    $params = [lang()];
    if (count($param) > 0) {
        $params = array_merge($params, $param);
    }
    return route($route, $params);
}

if (! function_exists('purify')) {
    /**
     * Purify in comming HTML using summernote editor
     * @param  string       $inputValue
     * @return string  clean HTML
     */
    function purify($inputValue)
    {
        $empty_values = ['<br>', '<p><br></p>', '<p dir="auto"><br></p>'];

        if (in_array($inputValue, $empty_values)) {
            return "";
        }

        $cleanBreaks = trim($inputValue, '<p><br></p>');

        return Purify::clean($cleanBreaks);
    }
}
