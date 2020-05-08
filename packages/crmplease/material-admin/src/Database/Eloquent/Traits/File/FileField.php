<?php namespace Crmplease\MaterialAdmin\Database\Eloquent\Traits\File;

use Crmplease\MaterialAdmin\Database\Eloquent\Traits\Interfaces\FileFieldInterface;
use Illuminate\Support\Facades\File;

class FileField implements FileFieldInterface
{
	public $file;

	public function __construct(array $json = [])
	{
		if (empty($json)) {

			$this->file = new FileLocal();

			return $this;
		}

		foreach ($json as $key => $value) {

			$this->$key = new FileLocal();
			$this->$key->url = isset($value['url']) ? $value['url'] : null;
			$this->$key->size = isset($value['size']) ? $value['size'] : null;
		}
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return (string)$this->file->url;
	}

	public function toJson()
	{
		return json_encode($this);
	}

	/**
	 * @return boolean
	 */
	public function delete()
	{
		File::delete((string)$this->file->url);

		return true;
	}
}
