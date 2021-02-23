<?php

namespace App\Traits;

use Laravel\Jetstream\HasProfilePhoto;

trait HasProfilePhotoProject{
  use HasProfilePhoto;

    /**
     * Overwrite of the method in HasProfilePhoto trait
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($this->firstName).' '.urlencode($this->lastName).'&color=7F9CF5&background=EBF4FF';
    }
}
