<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';

    protected $fillable = [
    	'name', 'type', 'parent_organization', 'instruction', 'description', 'info'
    ];

    protected $hidden = [
    	'opt1', 'opt2', 'opt3'
    ];

    // 定义组织间的层级关系
    public function parent()
    {
    	return $this->belongsTo('App\Organization', 'parent_organization');
    }

    // 定义组织间的层级关系
    public function children()
    {
    	return $this->hasMany('App\Organization', 'parent_organization');
    }

    // 定义组织与用户之间的多对多关系
    public function members()
    {
    	return $this->belongsToMany('App\User', 'users_organizations', 'organizations_id', 'users_id')
    				->withTimestamps()
    				->withPivot('relation');
    }

    // 定义组织与活动之间的多对多关系
    public function activities()
    {
    	return $this->belongsToMany('App\Activity', 'activities_organizations', 'organizations_id', 'activities_id')
    				->withPivot('relation');
    }
}
