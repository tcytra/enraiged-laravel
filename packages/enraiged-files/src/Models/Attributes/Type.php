<?php

namespace Enraiged\Files\Models\Attributes;

trait Type
{
    /**
     *  @return void
     */
    public function initializeType()
    {
        $this->append('type');
    }

    /**
     *  @return string
     */
    public function getTypeAttribute()
    {
        return $this->getFileExtension();
    }

    /**
     *  @return string
     */
    protected function getFileExtension()
    {
        return strtoupper( substr($this->name, strrpos($this->name, '.') +1) );
    }
}
