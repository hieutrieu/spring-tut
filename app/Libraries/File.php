<?php
namespace App\Libraries;
/**
 * Created by PhpStorm.
 * User: HIEU TRIEU
 * Date: 9/14/15
 * Time: 10:03 AM
 */
class File
{
    public function fileScanDirectory($dir, $mask, $options = array(), $depth = 0)
    {
        // Merge in defaults.
        $options += array(
            'nomask' => '/(\.\.?|CVS)$/',
            'callback' => 0,
            'recurse' => TRUE,
            'key' => 'uri',
            'min_depth' => 0,
        );

        $options['key'] = in_array($options['key'], array('uri', 'filename', 'name')) ? $options['key'] : 'uri';
        $files = array();
        if (is_dir($dir) && $handle = opendir($dir)) {
            while (FALSE !== ($filename = readdir($handle))) {
                if (!preg_match($options['nomask'], $filename) && $filename[0] != '.') {
                    $uri = "$dir/$filename";
                    if (is_dir($uri) && $options['recurse']) {
                        // Give priority to files in this folder by merging them in after any subdirectory files.
                        $files = array_merge(self::fileScanDirectory($uri, $mask, $options, $depth + 1), $files);
                    } elseif ($depth >= $options['min_depth'] && preg_match($mask, $filename)) {
                        $file = new \stdClass();
                        $file->uri = $uri;
                        $file->filename = $filename;
                        $file->name = pathinfo($filename, PATHINFO_FILENAME);
                        $key = $options['key'];
                        $files[$file->$key] = $file;
                        if ($options['callback']) {
                            $options['callback']($uri);
                        }
                    }
                }
            }

            closedir($handle);
        }
        return $files;
    }

    public function directoryToArray($directory, $recursive) {
        $array_items = array();
        if ($handle = opendir($directory)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (is_dir($directory. "/" . $file)) {
                        if($recursive) {
                            $array_items = array_merge($array_items, self::directoryToArray($directory. "/" . $file, $recursive));
                        }
                        $file = $directory . "/" . $file;
                        $array_items[] = preg_replace("/\/\//si", "/", $file);
                    } else {
                        $file = $directory . "/" . $file;
                        $array_items[] = preg_replace("/\/\//si", "/", $file);
                    }
                }
            }
            closedir($handle);
        }
        return $array_items;
    }
}