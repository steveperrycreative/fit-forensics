<?php

namespace App\Models;

class FitAnalyser extends PhpFitFileAnalysis
{
    public function getMaxSpeed()
    {
        return $this->getData('session', 'max_speed');
    }


    public function getMaxHr()
    {
        return $this->getData('session', 'max_heart_rate');
    }


    public function getTotalElapsedTime()
    {
        return $this->getData('session', 'total_elapsed_time');
    }


    public function getTotalDistance()
    {
        return $this->getData('session', 'total_distance');
    }


    public function getEventTimestamp()
    {
        return $this->getData('event', 'timestamp');
    }


    public function getSerialNumber()
    {
        return $this->getData('file_id', 'serial_number');
    }


    public function getTimeCreated()
    {
        return $this->getData('file_id', 'time_created');
    }


    public function getSoftwareVersion()
    {
        return $this->getData('file_creator', 'software_version');
    }


    public function getType()
    {
        return $this->getEnumData('file', 'file_id', 'type');
    }


    public function getManufacturer()
    {
        $manufacturer = $this->getEnumData('manufacturer', 'device_info', 'manufacturer');

        if ($manufacturer == 'N/A') {
            $manufacturer = $this->getEnumData('manufacturer', 'file_id', 'manufacturer');
        }

        return $manufacturer;
    }


    public function getProduct()
    {
        $product = $this->getEnumData('product', 'device_info', 'product');

        if ($product == 'N/A') {
            $product = $this->getEnumData('product', 'file_id', 'product');
        }

        return $product;
    }


    public function getSport()
    {
        return $this->getEnumData('sport', 'session', 'sport');
    }


    public function getWeight()
    {
        return $this->getData('user_profile', 'weight');
    }

    public function getGender()
    {
        return $this->getEnumData('gender', 'user_profile', 'gender');
    }

    public function getAge()
    {
        return $this->getData('user_profile', 'age');
    }

    public function getHeight()
    {
        return $this->getData('user_profile', 'height');
    }

    public function getLanguage()
    {
        return $this->getEnumData('language', 'user_profile', 'language');
    }


    public function getMapData()
    {
        $coords = [];

        if ( ! key_exists('record', $this->data_mesgs)) return false;
        if ( ! key_exists('position_lat', $this->data_mesgs['record'])) return false;
        if ( ! key_exists('position_long', $this->data_mesgs['record'])) return false;

        $position_lat = $this->data_mesgs['record']['position_lat'];
        $position_long = $this->data_mesgs['record']['position_long'];

        foreach ($position_lat as $key => $value) {  // Assumes every lat has a corresponding long
            $coords[] = [$position_lat[$key], $position_long[$key]];
        }

        return $coords;
    }


    private function getData($key, $subkey)
    {
        if ( ! key_exists($key, $this->data_mesgs)) return 'N/A';
        if ( ! key_exists($subkey, $this->data_mesgs[$key])) return 'N/A';

        $tmp = $this->data_mesgs[$key][$subkey];

        return is_array($tmp) ? $tmp[0] : $tmp;
    }


    private function getEnumData($type, $key, $subkey)
    {
        if ( ! key_exists($key, $this->data_mesgs)) return 'N/A';
        if ( ! key_exists($subkey, $this->data_mesgs[$key])) return 'N/A';

        $tmp = $this->enumData($type, $this->data_mesgs[$key][$subkey]);

        return is_array($tmp) ? $tmp[0] : $tmp;
    }
}
