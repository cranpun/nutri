<?php

namespace App\U;


class U {
    public static function invokeErrorValidate($request, $message)
    {
        if($message != null) {
            $request->session()->flash("message-error", $message);
        }
        $validate = [
            "dummy" => "required"
        ];
        $request->validate($validate);
    }
    public static function toAssoc($rows, $clmid = "id", $clmname = "name")
    {
        // 連想配列に変換
        $ret = [];
        foreach($rows as $row) {
            $ret[$row[$clmid]] = $row[$clmname];
        }
        return $ret;
    }
    public static function query2array($q)
    {
        $ret = $q->get()->map(function($item) {
            return (array)$item;
        })->all();
        return $ret;
    }
    public static function getd($key, $array, $def) {
        $arr = (array)$array;
        $ret = array_key_exists($key, $arr) ? $arr[$key] : $def;
        return $ret;
    }
    public static function vald($val, $def) {
        $ret = $val ? $val : $def;
        return $ret;
    }
    /**
     * 配列nameを安全な内容に変更
     */
    public static function safeArrayname($name, $replace) {
        $ret = str_replace("[", $replace, str_replace("]", "", $name));
        return $ret;
    }
    public static function publicfiletimelink($filepath) {
        return asset($filepath) . '?v=' . filemtime(join(DIRECTORY_SEPARATOR, [public_path(), $filepath]));
    }
    public static function toSql(\Illuminate\Database\Eloquent\Builder $q)
    {
        return vsprintf(
            str_replace('?', '%s', $q->toSql()),
            collect($q->getBindings())->map(function ($binding) {
                return is_numeric($binding) ? $binding : "'{$binding}'";
            })->toArray()
        );
    }
    // public static function makeCsvWriterObj()
    // {
    //     $csv = \League\Csv\Writer::createFromStream(fopen("php://temp", "r+"));
    //     \League\Csv\CharsetConverter::addTo($csv, "UTF-8", "SJIS");
    //     $csv->setEnclosure('"');
    //     return $csv;
    // }

    // public static function makeCsvReaderObj($filepath)
    // {
    //     $csv = \League\Csv\Reader::createFromPath($filepath);
    //     $csv->addStreamFilter('convert.iconv.cp932/UTF-8');
    //     return $csv;
    // }
//     public static function sendMail($subject, $text, $tos, $ccs, $bccs)
//     {
//         $mail = \Illuminate\Support\Facades\Mail::raw($text, function($message) use ($subject, $tos, $ccs, $bccs) {
//             $message->to($tos);
//             if($ccs) {
//                 $message->cc($ccs);
//             }
//             if($bccs) {
//                 $message->bcc($bccs);
//             }
//             $message->from(config('myconf.email_contact'));
//             $message->subject($subject);
//         });

//         // ログ保存
//         $strtos = join(",", $tos);
//         $strccs = $ccs ? join(",", $ccs) : "null";
//         $strbccs = $bccs ? join(",", $bccs) : "null";
//         $log = <<< EOM

// subject: {$subject}
// to : {$strtos}
// cc : {$strccs}
// bcc: {$strbccs}
// body:
// {$text}

// EOM;
//         \Log::channel("mail")->info($log);
//     }
}