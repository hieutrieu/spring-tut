<?php

namespace App\Controller\Admin;

use App\Libraries\File;
use App\Models\FileImporter;
use App\Models\FileScan;
use App\Libraries\BackupFile;
use App\Models\Logs;
use Exception;

class ScanController
{
	public function scanFolder()
	{
		$fileLib = new File();
		//$files = $fileLib->fileScanDirectory(__APP__.config('app.scanDir'),  '/.*\.csv$/');
		$files = $fileLib->fileScanDirectory(config('app.scanDir'), '/^(cdr_).*$/');
		$fileScanData = [];
		$fileNames = [];
		foreach ($files as $file) {
			$fileNames[] = $file->name;
			$fileScanData[$file->name] = ['path_file' => str_replace('\\', '/', $file->uri), 'filename' => $file->filename, 'name' => $file->name, 'created_at' => ['now()']];
		}
		if (count($fileNames)) {
			$status = FileScan::STATUS_FAILED;
			$conditionName = implode("','", $fileNames);
			$filesThread = FileScan::getInstance()->getObjectsByField(["name IN ('{$conditionName}') AND status != '{$status}'"]);
			// Remove the files has existing in thread
			if (count($filesThread)) {
				foreach ($filesThread as $fileThread) {
					if (isset($fileScanData[$fileThread['name']])) unset($fileScanData[$fileThread['name']]);
				}
			}
		}
		if (count($fileScanData)) {
			$fileScanData = array_values($fileScanData);
			FileScan::getInstance()->inserts(array_keys($fileScanData[0]), $fileScanData);
		}
	}

	public function importThread()
	{
		$file = FileScan::getInstance()->getOneObjectByField(array());
		$fileUri = str_replace('\\', '/', $file->path_file);
		if (($handle = fopen($fileUri, "r")) === false) {
			echo "readJobsFromFile: Failed to open file [$file]\n";
			die;
		}

		$header = true;
		$index = 0;
		while (($data = fgetcsv($handle, 0, ",")) !== false) {
			// ignore header
			if ($header == true) {
				$header = false;
				continue;
			}

			if ($data[0] == '' && $data[1] == '') //u have oly 2 fields
			{
				echo "readJobsFromFile: No more input entries\n";
				break;
			}
			$a = trim($data[0]);
			$b = trim($data[1]);
			$index++;
		}

		fclose($handle);
	}

	/**
	 * Import call history
	 */
	public function importFile()
	{
		try {
			$limit = config('app.limit_scan_file');
			$files = FileScan::getInstance()->getFileScaned($limit);
			foreach ($files as $file) {
				FileScan::getInstance()->update(array('status' => FileScan::STATUS_PROCESSING),array("id" => $file["id"]));
				$result = FileImporter::getInstance()->process($file);
				if ($result == true) {
					FileScan::getInstance()->delete(array("id" => $file["id"]));
					BackupFile::getInstance(config('app.scanDir'))->backup_file($file['filename']);
					unlink($file['path_file']);
				} else {
					FileScan::getInstance()->update(array('status' => FileScan::STATUS_FAILED),array("id" => $file["id"]));
				}
			}
		} catch (Exception $e) {
			debug($e);
			/*Logs::getInstance()->insert(array(
				'log_type' => Logs::EVENT_ERROR,
				'content' => (string)$e->getMessage(),
			));*/
		}

	}
	public function chmod_R($path, $filemode, $dirmode) {
		if (is_dir($path) ) {
			if (!chmod($path, $dirmode)) {
				$dirmode_str=decoct($dirmode);
				print "Failed applying filemode '$dirmode_str' on directory '$path'\n";
				print "  `-> the directory '$path' will be skipped from recursive chmod\n";
				return;
			}
			$dh = opendir($path);
			while (($file = readdir($dh)) !== false) {
				if($file != '.' && $file != '..') {  // skip self and parent pointing directories
					$fullpath = $path.'/'.$file;
					chmod_R($fullpath, $filemode,$dirmode);
				}
			}
			closedir($dh);
		} else {
			if (is_link($path)) {
				print "link '$path' is skipped\n";
				return;
			}
			if (!chmod($path, $filemode)) {
				$filemode_str=decoct($filemode);
				print "Failed applying filemode '$filemode_str' on file '$path'\n";
				return;
			}
		}
	}
}
