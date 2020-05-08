<?php namespace Crmplease\MaterialAdmin\Database\Eloquent\Traits\Interfaces;

interface FileFieldInterface
{
	public function __toString();

	public function toJson();

	public function delete();
}
