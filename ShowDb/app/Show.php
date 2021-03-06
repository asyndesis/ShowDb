<?php

namespace ShowDb;

use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable;

class Show extends Model
{

    use Auditable;

    public function setlistItems() {
        return $this->hasMany('ShowDb\SetlistItem');
    }

    public function notes() {
        return $this->hasMany('ShowDb\ShowNote');
    }

    public function users() {
        return $this->belongsToMany('ShowDb\User');
    }

    public function creator() {
        return $this->belongsTo('ShowDb\User', 'user_id');
    }

}
