<?php
namespace App\Http\Requests\Api;

use App\Http\Requests\Request;
use App\Storage\LbtWp\WpConvetor;

/**
 * This request is for App\Http\Controllers\Api\CategoriesController@update
 */
class CategoryEditRequest extends Request {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        $wp_category_id = $this->wp_category_id;
        $wp             = new WpConvetor();

        $category_id = $wp->getId('category', $wp_category_id);
        // dd($category_id);
        // $name     = 'required|categories,name';
        // $slug     = 'required|slug|unique:categories,slug';
        $id = '';

        if ($category_id) {
            // $category = Category::find($category_id);
            // $id       = $category->id;
            $id = $category_id;

        } else {
            return [
                'access_token'   => 'required',
                'wp_category_id' => 'bail|required|integer|exists:categories,wp_category_id',
            ];
        }

        // return [
        //     'name'           => isset($this->name) ? $name : '',
        //     'wp_category_id' => 'required|integer|exists:categories,wp_category_id',
        //     'slug'           => isset($this->slug) ? $slug : '',
        // ];
        return [

            'name'           => 'required|unique:categories,name,' . $id,
            'slug'           => 'slug|unique:categories,slug,' . $id,
            'wp_category_id' => 'required|integer|unique:categories,wp_category_id,' . $id,

        ];
    }

    public function messages() {
        return [
            // 'name.required' => 'The brand name field is required.',
            // 'opid.required' => 'The Ontraport tag field is required',
            'slug.slug' => 'The Slug field is invalid',
        ];
    }

    /**
     * Response error message as json
     *
     * @param array $errors
     * @return mixed
     */
    public function response(array $errors) {

        return response()->json([
            'status'  => false,
            'code'    => config('responses.bad_request.status_code'),
            'data'    => null,
            'errors'  => $errors,
            'message' => config('responses.bad_request.status_message'),
        ],
            config('responses.bad_request.status_code')
        );
        // return Response::json($errors, config('responses.bad_request.status_code'));
    }
}
