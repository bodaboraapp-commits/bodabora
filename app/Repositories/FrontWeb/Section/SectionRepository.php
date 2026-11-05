<?php
namespace App\Repositories\FrontWeb\Section;

use App\Enums\SectionType;
use App\Models\Backend\FrontWeb\Section;
use App\Models\Backend\Upload;
use App\Repositories\FrontWeb\Section\SectionInterface;
use Illuminate\Support\Facades\File;

class SectionRepository implements SectionInterface{
    
    public function all(){
        $this->ensureGalleryDefaults();
        return Section::with('upload')->select('*')->groupBy('type')->orderBy('id','asc')->paginate(10);
    }
   
    public function getFind($type){
        if($type == SectionType::GALLERY):
            $this->ensureGalleryDefaults();
        endif;
        $sections = Section::where('type',$type)->get();
        $array = [];
        foreach ($sections as  $section) {
             $array[$section->key] = $section->value;
             if($this->isImageKey($section->key)):
                $array[$section->key.'_image'] = $section->image;
                if($section->key == 'banner'):
                    $array['banner_image'] = $section->image;
                endif;
             endif;
        } 
        return $array;
    }

    public function sectionType($type){
        switch ($type) {
            case SectionType::BANNER:
                return __('levels.banner');
            break;
            case SectionType::ACHIEVEMENT:
                return __('levels.happy_achievement');
            break;
            case SectionType::ABOUT:
                return __('levels.about_us');
            break;
            case SectionType::SUBSCRIBE:
                return __('levels.subscribe');
            break;
            case SectionType::APP_LINK:
                return __('levels.app_download_link');
            break;
            case SectionType::MAP_LINK:
                return __('levels.map_link');
            break; 
            case SectionType::GALLERY:
                return __('Gallery');
            break;
            default:
                return '';
            break;
        }
    
    }
 
    public function update($type,$request){
        try { 
            foreach ($request->data as $key => $value) {
                $section              = Section::where('type', $type)->where('key', $key)->first();
                if(!$section):
                    $section       = new Section();
                    $section->type = $type;
                    $section->key  = $key;
                endif;
                if($this->isImageKey($key)):
                    if(blank($value)):
                        continue;
                    endif;
                    $section->value = $this->imageStoreUpdate($section->value,$value);
                else:
                    $section->value   = $value;
                endif;
                $section->save();
            }
            return true;
        } catch (\Throwable $th) { 
            return false;
            
        }
    } 


    // Image Store in Upload Model 
    public function imageStoreUpdate($file_id, $file){
         
        try { 
            $file_name = '';
            if(!blank($file)){
                if(!File::exists(public_path('uploads/section'))):
                   File::makeDirectory(public_path('uploads/section'));
                endif;
                $destinationPath       = public_path('uploads/section');
                $img          = date('YmdHis') . '_' . uniqid() . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $img);
                $file_name            = 'uploads/section/'.$img;
            }

            if(blank($file_id)){
                $upload           = new Upload();
            }else{
                $upload           = Upload::find($file_id) ?? new Upload();
                if(!blank($upload->original) && file_exists(public_path($upload->original)))
                {
                   unlink(public_path($upload->original));
                }
            }
            $upload->original     = $file_name;
            $upload->save();
            return $upload->id;

        }
        catch (\Exception $e) {
            return null;
        } 
    }

    private function isImageKey($key)
    {
        return $key == 'banner' || strpos($key, 'banner_theme_') === 0 || strpos($key, 'gallery_image_') === 0;
    }

    private function ensureGalleryDefaults()
    {
        foreach ($this->galleryDefaults() as $key => $value) {
            $section = Section::where('type', SectionType::GALLERY)->where('key', $key)->first();
            if(!$section):
                $section        = new Section();
                $section->type  = SectionType::GALLERY;
                $section->key   = $key;
                $section->value = $value;
                $section->save();
            endif;
        }
    }

    private function galleryDefaults()
    {
        $defaults = [
            'gallery_badge'       => 'Gallery',
            'gallery_title'       => 'Our Delivery Gallery',
            'gallery_description' => 'Explore our successful deliveries, courier operations, and real shipment moments showcasing fast, secure, and reliable delivery services.',
        ];

        for ($i = 1; $i <= 7; $i++) {
            $defaults['gallery_image_'.$i] = null;
        }

        return $defaults;
    }


}