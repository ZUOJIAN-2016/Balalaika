<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Facades\Session;
use App\Organization;

class OrganizationController extends Controller
{
	public function create(Request $request)
	{
		// Todo 使用用户授权策略断言用户能否创建组织

		// 验证输入字段
		if (!$request->has(Organization::REQUIRED_COLUMN) or !Organization::validate($request->input())) {
			abort(400, 'Bad Request!');
		}

		// 确保父级组织存在
		try {
			Organization::find($request->input('parent_organization'))->firstOrFail();
		} catch (ModelNotFoundException $e) {
			abort(400, 'Parent organization does not exist!');
		}
		
		$org = Organization::create($request->input());
		return $org;
	}

	public function list(Request $request)
	{
		// Todo 使用用户策略控制显示的组织类型

		$orgs = Organization::select(Organization::SUMMARY_COLUMN)
							->skip((int) $request->query('skip', 0))
							->take((int) $request->query('take', 15))
							->get();
		return $orgs;
	}

	public function view($id)
	{
		// Todo 使用用户策略控制

		try {
			$org = Organization::with('parent')->find($id)->firstOrFail();
		} catch (ModelNotFoundException $e) {
			abort(404, 'Not Found!');
		}

		// Todo 返回前根据用户策略进行修饰
		return $org;
	}
}
