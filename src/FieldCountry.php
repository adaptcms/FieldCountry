<?php

namespace Adaptcms\FieldCountry;

use Adaptcms\Base\Models\Package;

class FieldCountry
{
  /**
  * On Install
  *
  * @return void
  */
  public function onInstall()
  {
    Package::syncPackageFolder(get_class());
  }
}
