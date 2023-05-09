<?php

namespace App\Controllers;

class Profileimage extends BaseController
{
    public function edit()
    {
		return view('Profileimage/edit');
    }

    //--------------------------------------
    
    public function update()
    {
        $user = service('auth')->getCurrentUser();
        $file = $this->request->getFile('image');
        //$path = ROOTPATH . 'public/uploads/profile_images/' . $user->profile_image;
        $path = WRITEPATH . 'uploads/profile_images/' . $user->profile_image;
        
        if ( ! $file->isValid()) {
            
            $error_code = $file->getError();
            
            if ($error_code == UPLOAD_ERR_NO_FILE) {
                
                return redirect()->back()
                                 ->with('warning', 'No file selected');
            }
            
            throw new \RuntimeException($file->getErrorString() . " " . $error_code);
        }
        
        $size = $file->getSizeByUnit('mb');
        
        if ($size > 2) {
            
            return redirect()->back()
                             ->with('warning', 'File too large (max 2MB)');
        }
        
        $type = $file->getMimeType();
        
        if ( ! in_array($type, ['image/png', 'image/jpeg', 'image/gif'])) {
            
            return redirect()->back()
                             ->with('warning', 'Invalid file format (PNG or JPEG or GIF only)');
        }

        if (is_file($path)) {
            unlink($path);
        }


            $newName = $file->getRandomName();
            $uploadPath = WRITEPATH . 'uploads/profile_images/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            if ($file->getMimeType() !== 'png') {
                service('image')
                    ->withFile($file)
                    ->convert(IMAGETYPE_PNG)
                    ->save($uploadPath . $newName, 80);
            } else {
                $file->move($uploadPath, $newName);
            }
            service('image')
                ->fit(200, 200, 'center')
                ->save($uploadPath . $newName, 80);

        
        $user->profile_image = $newName;
        
        $model = new \App\Models\UsersModel;
        
        $model->protect(false)
              ->save($user);
              
        return redirect()->to('dashboard/profile')
                         ->with('info', 'Image uploaded successfully');
    }


    public function delete()
    {
            
            $user = service('auth')->getCurrentUser();
            
            $path = WRITEPATH . 'uploads/profile_images/' . $user->profile_image;
            
            if (is_file($path)) {
            
                unlink($path);
            }
            
            $user->profile_image = null;
            
            $model = new \App\Models\UsersModel;
            
            $model->protect(false)
                  ->save($user);
                  
            return redirect()->to('dashboard/profile')
                             ->with('info', 'Image deleted');

    }

}