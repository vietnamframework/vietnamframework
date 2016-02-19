<?php

class File_lib
{

    public function FileList($filespec, $fill = '')
    {
        $list = array();
        
        try {
            // $filespec1 = new VARIANT($filespec, VT_BSTR, CP_UTF8);
            // $folderobject = $this->_file->GetFolder($filespec1);
            foreach ($this->toIterator($filespec) as $dir) {
                $folderobject = scandir($dir, 1);
                // print_r($folderobject);
                foreach ($folderobject as $f) {
                    // $tmp = mb_convert_encoding($f->Name, 'UTF-8', 'SJIS-win');
                    // $tmp = $f->Name;
                    if ($f != '.' && $f != '..') {
                        $tmp = $f;
                        if ($fill == '' || mb_strpos($tmp, $fill) !== FALSE) {
                            $list[] = $tmp;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            VNLog::write_file('FSO', sprintf('FileList(%s, %s):%s', $filespec, $fill, $e->getMessage()));
        }
        return $list;
    }

    public function FolderList($filespec, $fill = '')
    {
        $list = array();
        try {
            
            $folderobject = scandir($filespec, 1);
            foreach ($folderobject as $f) {
                if ($f != '.' && $f != '..') {
                    if (is_dir($filespec . '/' . $f)) {
                        $tmp = $f;
                        if ($fill == '' || mb_strpos($tmp, $fill) !== FALSE) {
                            $list[] = $tmp;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            VNLog::write_file('FSO', sprintf('FolderList(%s, %s):%s', $filespec, $fill, $e->getMessage()));
        }
        
        return $list;
    }

    public function FileFolderList($filespec, $sub = false, $fill = '', $ffill = '')
    {
        $list = array();
        $sublist = array();
        try {
            
            $folderobject = $filespec1 = scandir($filespec, 1);
            
            foreach ($folderobject as $f) {
                if ($f != '.' && $f != '..') {
                    // $tmp = mb_convert_encoding($f->Name, 'UTF-8', 'SJIS-win');
                    if (is_dir($filespec . '/' . $f)) { // is sub folder
                        $tmp = $f;
                        if ($ffill == '' || mb_strpos($tmp, $ffill) !== FALSE) {
                            $list[] = $tmp;
                            $sublist[] = $tmp;
                        }
                    } else { // is file
                        $tmp = $f;
                        if ($fill == '' || mb_strpos($tmp, $fill) !== FALSE) {
                            $list[] = $tmp;
                        }
                    }
                }
            }
            
            foreach ($sublist as $s) {
                $subpath = $filespec . '/' . $s; // $this->BuildPath($filespec, $s);
                $list['/' . $s] = $this->FileFolderList($subpath, $sub, $fill, $ffill);
            }
        } catch (Exception $e) {
            VNLog::write_file('FSO', sprintf('FileFolderList(%s, %d, %s, %s):%s', $filespec, $sub, $fill, $ffill, $e->getMessage()));
        }
        
        return $list;
    }

    public function FolderExists($folderspec)
    {
        try {
            // $folderspec1 = new VARIANT($folderspec, VT_BSTR, CP_UTF8);
            // return $this->_file->FolderExists($folderspec1) === true;
            return is_dir($folderspec);
        } catch (Exception $e) {
            VNLog::write_file('FSO', sprintf('FolderExists(%s):%s', $folderspec, $e->getMessage()));
            throw $e;
        }
        
        return FALSE;
    }

    public function MoveFile($source, $destination)
    {
        try {
            $this->CopyFile($source, $destination);
            $this->DeleteFile($source);
            return TRUE;
        } catch (Exception $e) {
            VNLog::write_file('FSO', sprintf('MoveFile(%s,%s):%s', $source, $destination, $e->getMessage()));
        }
        return FALSE;
    }

    public function MoveFolder($source, $destination)
    {
        try {
            $this->CopyFolder($source, $destination);
            $this->DeleteFolder($source);
            return TRUE;
        } catch (Exception $e) {
            VNLog::write_file('FSO', sprintf('MoveFolder(%s,%s):%s', $source, $destination, $e->getMessage()));
        }
        return FALSE;
    }

    public function DeleteFile($filespec, $force = false)
    {
        try {
            return $this->remove($filespec);
        } catch (Exception $e) {
            VNLog::write_file('FSO', sprintf('CreateFolder(%s):%s', $filespec, $e->getMessage()));
        }
        return FALSE;
    }

    public function DeleteFolder($folderspec, $force = false)
    {
        try {
            return $this->remove($folderspec);
        } catch (Exception $e) {
            VNLog::write_file('FSO', sprintf('DeleteFolder(%s, %d):%s', $folderspec, $force, $e->getMessage()));
        }
        return FALSE;
    }

    public function CopyFile($originFile, $targetFile, $override = false)
    {
        try {
            
            if (stream_is_local($originFile) && ! is_file($originFile)) {
                // throw new FileNotFoundException(sprintf('Failed to copy "%s" because file does not exist.', $originFile), 0, null, $originFile);
                return FALSE;
            }
            
            $this->CreateFolder(dirname($targetFile));
            
            if (! $override && is_file($targetFile) && null === parse_url($originFile, PHP_URL_HOST)) {
                $doCopy = filemtime($originFile) > filemtime($targetFile);
            } else {
                $doCopy = true;
            }
            
            if ($doCopy) {
                
                $source = fopen($originFile, 'r');
                $target = fopen($targetFile, 'w');
                stream_copy_to_stream($source, $target);
                fclose($source);
                fclose($target);
                unset($source, $target);
                
                if (! is_file($targetFile)) {
                    // throw new IOException(sprintf('Failed to copy "%s" to "%s".', $originFile, $targetFile), 0, null, $originFile);
                    return FALSE;
                }
            }
            return TRUE;
        } catch (Exception $e) {
            VNLog::write_file('FSO', sprintf('CopyFile(%s,%s,%d):%s', $originFile, $targetFile, $override, $e->getMessage()));
        }
        return FALSE;
    }

    public function CreateFolder($dirs, $mode = 0777)
    {
        try {
            foreach ($this->toIterator($dirs) as $dir) {
                if (is_dir($dir)) {
                    continue;
                }
                
                if (true == @mkdir($dir, $mode, true)) {
                    // throw new IOException(sprintf('Failed to create "%s".', $dir), 0, null, $dir);
                    return true;
                }
            }
        } catch (Exception $e) {
            VNLog::write_file('FSO', sprintf('CreateFolder(%s):%s', $dirs, $e->getMessage()));
        }
        return false;
    }

    public function FileExists($files)
    {
        foreach ($this->toIterator($files) as $file) {
            if (! file_exists($file)) {
                return false;
            }
        }
        
        return true;
    }

    public function remove($files)
    {
        $files = iterator_to_array($this->toIterator($files));
        $files = array_reverse($files);
        foreach ($files as $file) {
            if (! file_exists($file) && ! is_link($file)) {
                continue;
            }
            
            if (is_dir($file) && ! is_link($file)) {
                $this->remove(new \FilesystemIterator($file));
                
                if (true !== @rmdir($file)) {
                    // throw new ioexception(sprintf('Failed to remove directory "%s".', $file), 0, null, $file);
                    return false;
                }
            } else {
                
                if (defined('PHP_WINDOWS_VERSION_MAJOR') && is_dir($file)) {
                    if (true !== @rmdir($file)) {
                        // throw new ioexception(sprintf('Failed to remove file "%s".', $file), 0, null, $file);
                        return false;
                    }
                } else {
                    if (true !== @unlink($file)) {
                        // throw new ioexception(sprintf('Failed to remove file "%s".', $file), 0, null, $file);
                        return false;
                    }
                }
            }
        }
        return TRUE;
    }

    public function CopyFolder($directory, $destination, $overwrite = true)
    {
        try {
            // If no directory to copy return false
            if (! is_dir($directory)) {
                return false;
            } else {
                // Create a FilesystemIterator instance
                $FilesystemIterator = new FilesystemIterator($directory, FilesystemIterator::SKIP_DOTS);
                // If destination directory not exists
                if (! is_dir($destination)) {
                    // Create a destination directory
                    mkdir($destination, 0777, true);
                } elseif ($overwrite === true) {
                    $this->DeleteFolder($destination);
                }
                // Loop files and directories
                foreach ($FilesystemIterator as $Iterator) {
                    // If directory
                    if ($Iterator->isDir()) {
                        // Copy directory or return false
                        $path_source = $Iterator->getPathname();
                        $fname = $Iterator->getFilename();
                        $path_copy = $destination . DIRECTORY_SEPARATOR . $fname;
                        if (false === $this->CopyFolder($path_source, $path_copy))
                            return false;
                    } else { // Else if file
                             // Copy file or return false
                        $path_source = $Iterator->getPathname();
                        $fname = $Iterator->getFilename();
                        $path_copy = $destination . DIRECTORY_SEPARATOR . $fname;
                        if (false === copy($path_source, $path_copy))
                            return false;
                    }
                }
                // If copying finished without any failure return true
                return true;
            }
        } catch (Exception $e) {
            VNLog::write_file('FSO', sprintf('CopyFolder(%s,%s,%d):%s', $directory, $destination, $overwrite, $e->getMessage()));
        }
        return FALSE;
    }
}