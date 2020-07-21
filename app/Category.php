<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
	protected $fillable = [
        'title', 'parent'
    ];
	
	
	public static function getParents($catid) {
		
		$parents = [];
		
               $parent = $catid;
		  
		  while($parent = self::where(['id'=> $parent])->first()->parent) {
			 $parents[] = $parent;
		  }
        
			return $parents;		
		
	}
	
	
	
	
	
}
