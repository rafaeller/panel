<?php

namespace Pterodactyl\Models;

use Illuminate\Database\Eloquent\Model;

class SubdomainRecord extends Model {
    protected $table = 'dns';
    public $timestamps = false;
    protected $fillable = ['serverid', 'recordid', 'subdomain'];
}
