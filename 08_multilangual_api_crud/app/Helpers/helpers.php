<?php 

if(!function_exists("getLocalizedField")){
 function getLocalizedField($model ,$fieldBaseName){
  $locale = request()->header('Accept-Language');
  if(!$locale || !in_array($locale, config('app.available_locales'))){
   $data = [];
   foreach (config('app.available_locales') as $locale) {
    $data[$locale] = $model->{$fieldBaseName."_".$locale};
   }
   return $data;
  }else{
    $field_locale = $fieldBaseName."_{$locale}";
    return $model->$field_locale;
   }
 }
}