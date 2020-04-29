<?php namespace Crmplease\MaterialAdmin\Database\Eloquent\Traits\File;

use File;
use Illuminate\Http\UploadedFile;

class FileService
{
	protected $model;

	protected $attribute;

	/**
	 * @param $model
	 * @return $this
	 */
	public function setModel($model)
	{
		$this->model = $model;

		return $this;
	}

	/**
	 * @param $attribute
	 * @return $this
	 */
	public function setAttribute($attribute)
	{
		$this->attribute = $attribute;

		return $this;
	}

	/**
	 * Get FileFieldLocal from json data
	 *
	 * @param null $jsonData
	 * @return FileField
	 */
	public function getFileFieldObject($json = null)
	{
		if (is_json($json)) {
			$attributes = json_decode($json, true);
		} else {
			$attributes = [];
		}

		return new FileField($attributes);
	}

	/**
	 * @param \SplFileInfo $file
	 * @return FileField
	 */
	public function createFileFieldObject(\SplFileInfo $file)
	{
		$fileField = new FileField();

		$fileField->file->url = $this->getRelativePath($file);
		$fileField->file->size = File::size($file->getPathname());

		return $fileField;
	}

	/**
	 * @param $key
	 * @param $value
	 * @return FileField
	 */
	public function copyFile($key, $value)
	{
		$original = new \SplFileInfo($value);

		$file = new \SplFileInfo($this->generateFileName($original->getExtension()));

		if (!File::isDirectory($file->getPath())) {
			File::makeDirectory($file->getPath(), 0777, true);
		}

		File::copy($original->getPathname(), $file->getPathname());

		$fileField = $this->createFileFieldObject($file);

		return $fileField;
	}

	/**
	 * @param $key
	 * @param UploadedFile $value
	 * @return FileField
	 */
	public function uploadFile($key, $value)
	{
		$original = $value;

		$file = new \SplFileInfo($this->generateFileName($original->getClientOriginalExtension()));

		if (!File::isDirectory($file->getPath())) {
			File::makeDirectory($file->getPath(), 0777, true);
		}

		$original->move($file->getPath(), $file->getFilename());

		$fileField = $this->createFileFieldObject($file);

		return $fileField;
	}

	/**
	 * @param $key
	 * @param $value
	 * @return FileField
	 */
	public function downloadFile($key, $value)
	{
		$original = new \SplFileInfo($value);

		$file = new \SplFileInfo($this->generateFileName($original->getExtension()));

		if (!File::isDirectory($file->getPath())) {
			File::makeDirectory($file->getPath(), 0777, true);
		}

		File::copy($original->getPathname(), $file->getPathname());

		$fileField = $this->createFileFieldObject($file);

		return $fileField;
	}

	/**
	 * @return string
	 */
	public function getStoragePath()
	{
		$compiled = str_replace(
			[
				'{model}',
				'{attribute}',
			],
			[
				$this->model->getTable(),
				$this->attribute
			],
			config('files.path')
		);

		return sprintf("%s/%s", public_path(), $compiled);
	}

	/**
	 * @return string
	 */
	public function getRelativePath(\SplFileInfo $file)
	{
		return str_replace(public_path(), '', $file->getPathname());
	}

	/**
	 * @param $extension
	 * @return string
	 */
	public function generateFileName($extension)
	{
		do {
			$fileName = sprintf("%s/%s.%s", $this->getStoragePath(), str_random(16), $extension);
		} while (File::exists($fileName));

		return $fileName;
	}
}