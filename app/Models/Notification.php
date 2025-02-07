<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

static public function getSingle($id)
{
return self::find($id);
}
static public function insertRecord($user_id, $url, $message)
{
$save = new Notification;
$save->user_id = $user_id;
$save->url = $url;
$save->message = $message;
$save->save();
}

static public function getunReadNotification()  {
    $return= Notification::select('notifications.*')
    ->where('notifications.is_read', '=', 0)
    ->orderBy('notifications.id', 'desc')
     ->get();
     return $return;
 }
 static public function updateReocrd($id)  {
    $getRecord =  Notification::getSingle($id);
    $getRecord->is_read=1;
    $getRecord->save();

 }
}
