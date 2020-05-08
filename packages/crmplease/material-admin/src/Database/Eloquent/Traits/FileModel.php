<?php namespace Crmplease\MaterialAdmin\Database\Eloquent\Traits;

use Crmplease\MaterialAdmin\Database\Eloquent\Traits\File\FileLocal;
use Crmplease\MaterialAdmin\Database\Eloquent\Traits\File\FileService;
use Illuminate\Http\UploadedFile;

/**
 * Class FileModel
 *
 * @package Crmplease\MaterialAdmin\Database\Eloquent\Traits
 */
trait FileModel
{
	public function getFileAttributeValue($key)
	{
		$fileService = new FileService();
		$fileService
			->setModel($this)
			->setAttribute($key);

		return $fileService->getFileFieldObject($this->getAttributeValue($key));
	}

	public function setFileAttributeValue($key, $value)
	{
		if (!isset($value)) {
			return false;
		}

		$fileService = new FileService();
		$fileService
			->setModel($this)
			->setAttribute($key);

		/**
		 * Если передан URL, то скачиваем файл
		 */
		if (is_url($value)) {

			$value = $fileService->downloadFile($key, $value)->toJson();

			$this->attributes[$key] = $value;

			return $this;
		}

		/**
		 * Если передана строка JSON, то присвоим её в неизменном виде
		 */
		if (is_json($value)) {

			$this->attributes[$key] = $value;

			return $this;
		}

		/**
		 * Если передан объект, то загрузим или скачаем
		 */
		if (is_object($value)) {

			switch (get_class($value)) {

				/**
				 * $model->file = Input::file('file');
				 */
				case UploadedFile::class:

					$value = $fileService->uploadFile($key, $value)->toJson();

					$this->attributes[$key] = $value;

					return $this;

					break;

				/**
				 * $model->file = $other->file;
				 */
				case FileLocal::class:

					$value = $fileService->copyFile($key, $value)->toJson();

					$this->attributes[$key] = $value;

					return $this;

					break;

			}
		}

		/**
		 * Если передан путь к файлу на диске
		 */
		if (is_readable($value)) {

			$value = $fileService->copyFile($key, $value)->toJson();

			$this->attributes[$key] = $value;

			return $this;
		}

		return false;
	}

	public static function bootFileModel()
	{
		static::updated(function ($model) {

			$attributes = $model->getAttributes();

			$dirty = $model->getDirty();

			$fileService = new FileService();
			$fileService->setModel($model);

			/**
			 * Пройдемся по всем файлам модели и посмотрим, были ли они изменены
			 */
			foreach ($model->files as $field) {

				if (empty($attributes[$field]) || empty($dirty[$field])) {
					continue;
				}

				$fileService->setAttribute($field);

				$fileObject = $fileService->getFileFieldObject($attributes[$field]);

				if ($fileObject) {

					$fileObject->delete();

				}
			}

		});

		static::deleted(function ($model) {

			/**
			 * Determine if the model have _not_ been modified.
			 */
			if (!count($model->getDirty())) {

				foreach ($model->files as $field) {
					$model->$field->delete();
				}
			}

		});

	}

}