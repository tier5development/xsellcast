<?php
namespace App\Storage\LbtWp;

class WpConvetor
{

	/**
     * Single
     *
     * Get a brand by ID.
     *
     * @param      string   module type
     * @param      Integer  $wp_id  The brand identifier
     *
     * @return     Response model id
     */
	public function getId($type,$wp_id){
		$id=null;
		switch ($type) {
			case 'brand':
				$brand=\App\Storage\Brand\Brand::where('wp_brand_id',$wp_id)->first();
				$id=$brand->id;

				break;
			case 'category':
				$category=\App\Storage\Category\Category::where('wp_category_id',$wp_id)->first();
				$id=$category->id;

				break;

			default:
				// code...
				break;
		}
		return $id;
	}


}

?>