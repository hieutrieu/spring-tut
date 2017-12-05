<?php
/**
 * Created by PhpStorm.
 * User: hieutrieu
 * Date: 11/27/2017
 * Time: 4:45 PM
 */

namespace App\Libraries;


class BackupFile
{
    private static $instance = null;
    var $source_dir;
    var $target_dir = 'backup';
    var $backup_dir = '';

    public function __construct($source_dir)
    {
        $this->source_dir = $source_dir;
        $this->backup_dir = $this->create_dir_if_exist();

    }

    public static function getInstance($source_dir)
    {
        if (self::$instance == null) {
            self::$instance = new BackupFile($source_dir);
        }
        return self::$instance;
    }

    public function backup_file($backup_file)
    {
        try {
            $sourceFile = $this->source_dir . '/' . $backup_file;
            $targetFile = $this->backup_dir . '/' . $backup_file;
            if (file_exists($sourceFile)) {
                copy($sourceFile, $targetFile);
            }
        } catch (\Exception $ex) {}
    }

    public function create_dir_if_exist()
    {
        $backup_dir = $this->source_dir . '/' . $this->target_dir;
        if (!file_exists($backup_dir)) {
            mkdir($backup_dir, 0777, true);
        }
        return $backup_dir;
    }

    public function zipData($source, $destination)
    {
        if (extension_loaded('zip')) {
            if (file_exists($source)) {
                $zip = new ZipArchive();
                if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
                    $source = realpath($source);
                    if (is_dir($source)) {
                        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
                        foreach ($files as $file) {
                            $file = realpath($file);
                            if (is_dir($file)) {
                                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                            } else if (is_file($file)) {
                                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                            }
                        }
                    } else if (is_file($source)) {
                        $zip->addFromString(basename($source), file_get_contents($source));
                    }
                }
                return $zip->close();
            }
        }
        return false;
    }
}