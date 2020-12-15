<?php

namespace Hexasoft\IP2LocationCountryBlockerModel\Config\Backend;

class DatabaseLocation extends \Magento\Framework\App\Config\Value
{
    public function beforeSave()
    {
		if ($this->getFieldsetDataValue('method') == 1) {
			if (!file_exists($this->getValue())) {
				throw new \Magento\Framework\Exception\ValidatorException(__('Binary database file is not found.'));
			}
			else{
				require_once BP . '/app/code/Hexasoft/IP2LocationCountryBlocker/lib/class.IP2Location.php';

				$geolocation = new \IP2Location\Database($this->getValue(), \IP2Location\Database::FILE_IO);
				$records = $geolocation->lookup('8.8.8.8', \IP2Location\Database::ALL);

				if ($records['countryCode'] != 'US') {
					throw new \Magento\Framework\Exception\ValidatorException(__('Binary database file is not valid or corrupted.'));
				}
			}
		}

        parent::beforeSave();
    }
}